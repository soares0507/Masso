<?php
require('fpdf.php');
include 'conexao.php';

$ano    = $_POST['ano'] ?? '';
$mes    = $_POST['mes'] ?? '';
$semana = $_POST['semana'] ?? '';

if (!$ano || !$mes || !$semana) {
    die('Filtro inválido.');
}

// Consulta locais filtrados
$sql = "SELECT l.*, u.nome as nome_usuario FROM upload_locais l LEFT JOIN usuarios u ON l.usuario_id = u.id WHERE YEAR(l.data_envio) = ? AND MONTH(l.data_envio) = ? AND CEIL(DAY(l.data_envio)/7) = ? ORDER BY l.data_envio DESC, l.id DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iii', $ano, $mes, $semana);
$stmt->execute();
$result = $stmt->get_result();

$pdf = new FPDF('L'); // Modo paisagem


function tmpPathLike($origPath) {
    $ext = strtolower(pathinfo($origPath, PATHINFO_EXTENSION));
    if ($ext === '') $ext = 'jpg';
    return rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR .
           'pdfimg_' . uniqid('', true) . '.' . $ext;
}


 
function prepararImagemParaPDF($arquivo) {
    if (!function_exists('exif_read_data') || !function_exists('imagecreatefromjpeg')) {
        return $arquivo;
    }
    $type = @exif_imagetype($arquivo);
    if ($type !== IMAGETYPE_JPEG) {
        return $arquivo;
    }
    $exif = @exif_read_data($arquivo);
    $orientation = isset($exif['Orientation']) ? (int)$exif['Orientation'] : 1;
    if ($orientation === 1) {
        return $arquivo;
    }
    $image = @imagecreatefromjpeg($arquivo);
    if ($image === false) {
        return $arquivo;
    }
    $hasFlip = function_exists('imageflip');
    switch ($orientation) {
        case 2: // Horizontal flip
            if ($hasFlip) imageflip($image, IMG_FLIP_HORIZONTAL);
            break;
        case 3: // 180
            $image = imagerotate($image, 180, 0);
            break;
        case 4: // Vertical flip
            if ($hasFlip) imageflip($image, IMG_FLIP_VERTICAL);
            break;
        case 5: // -90 + horizontal flip
            $image = imagerotate($image, -90, 0);
            if ($hasFlip) imageflip($image, IMG_FLIP_HORIZONTAL);
            break;
        case 6: // -90
            $image = imagerotate($image, -90, 0);
            break;
        case 7: // +90 + horizontal flip
            $image = imagerotate($image, 90, 0);
            if ($hasFlip) imageflip($image, IMG_FLIP_HORIZONTAL);
            break;
        case 8: // +90
            $image = imagerotate($image, 90, 0);
            break;
        default:
            // Não faz nada
            break;
    }
    $tmp = tmpPathLike($arquivo);
    imagejpeg($image, $tmp, 90);
    imagedestroy($image);
    return $tmp;
}

function adicionarLogos($pdf) {
    $logoY   = $pdf->GetY();
    $centerX = $pdf->GetPageWidth() / 2;
    $logoW = 18; $logoH = 20;
    $sideW = 24; $sideH = 20;
    $gap   = 28;
    $pdf->Image('ene.jpg',  $centerX - $logoW/2 - $gap - $sideW, $logoY, $sideW, $sideH);
    $pdf->Image('logo.jpg', $centerX - $logoW/2,                $logoY, $logoW, $logoH);
    $pdf->Image('va2.jpg',   $centerX + $logoW/2 + $gap,         $logoY, $sideW, $sideH);
    $pdf->Ln($sideH + 2);
}

$maxPorPagina = 2;
$contador = 0;
$tempGerados = [];

$enviosSimples = [];
$enviosComplexos = [];
while ($row = $result->fetch_assoc()) {
    // Busca todas as imagens do local
    $sqlImg = "SELECT imagem FROM upload_imagens WHERE local_id = ?";
    $stmtImg = $conn->prepare($sqlImg);
    $stmtImg->bind_param('i', $row['id']);
    $stmtImg->execute();
    $resImg = $stmtImg->get_result();
    $imgs = [];
    while ($imgRow = $resImg->fetch_assoc()) {
        $imgs[] = $imgRow['imagem'];
    }
    $stmtImg->close();
    if (count($imgs) < 2) {
        $enviosSimples[] = ['row' => $row, 'imgs' => $imgs];
    } else {
        $enviosComplexos[] = ['row' => $row, 'imgs' => $imgs];
    }
}
// Exibe envios complexos (2+ imagens, cada um em página própria)
foreach ($enviosComplexos as $envio) {
    $row = $envio['row'];
    $imgs = $envio['imgs'];
    $pdf->AddPage();
    adicionarLogos($pdf);
    // Centraliza as tabelas
    $tableW = 270;
    $pageW = $pdf->GetPageWidth();
    $startX = ($pageW - $tableW) / 2;
    $pdf->SetX($startX);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(0,51,102);
    $pdf->SetTextColor(255);
    $pdf->Cell(100,10,'Local',1,0,'C',true);
    $pdf->Cell(170,10,utf8_decode('Observação'),1,1,'C',true);
    $pdf->SetX($startX);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(227,240,250);
    $pdf->SetTextColor(0);
    $pdf->Cell(100,15,utf8_decode($row['local']),1,0,'C',true);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(170,15,utf8_decode($row['observacao']),1,1,'C',true);
    $pdf->Ln(2);
    $pdf->SetX($startX);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(0,51,102);
    $pdf->SetTextColor(255);
    $pdf->Cell(270,10,utf8_decode('Evidências'),1,1,'C',true);
    if (count($imgs) > 0) {
        $pdf->SetX($startX);
        $pdf->SetTextColor(0);
        $pdf->SetFillColor(227,240,250);
        $pdf->Cell(270,110,'',1,1,'C',true);
        $maxH = 105;
        $maxWTotal = 270;
        $imgH = $maxH;
        $cellY = $pdf->GetY() - 110;
        $espaco = 10; // espaçamento entre imagens
        $padding = 15; // margem interna nas laterais de cada célula
        $numImgsValidas = 0;
        foreach ($imgs as $imgPath) {
            if (!empty($imgPath) && file_exists($imgPath)) {
                $numImgsValidas++;
            }
        }
        $totalEspaco = ($numImgsValidas - 1) * $espaco;
        $imgW = $numImgsValidas > 0 ? ($maxWTotal - 2 * $padding - $totalEspaco) / $numImgsValidas : $maxWTotal - 2 * $padding;
        $curX = $startX + $padding;
        foreach ($imgs as $imgPath) {
            if (!empty($imgPath) && file_exists($imgPath)) {
                $imgPDFPath = prepararImagemParaPDF($imgPath);
                if ($imgPDFPath !== $imgPath) {
                    $tempGerados[] = $imgPDFPath;
                }
                $imgInfo = @getimagesize($imgPDFPath);
                if ($imgInfo && $imgInfo[0] > 0 && $imgInfo[1] > 0) {
                    // Padroniza tamanho das imagens para envios complexos (3 ou mais imagens)
                    $maxImgsPorLinha = $numImgsValidas;
                    $maxImgW = ($maxWTotal - 2 * $padding - ($maxImgsPorLinha - 1) * $espaco) / $maxImgsPorLinha;
                    $drawW = min(120, $maxImgW);
                    $drawH = 90;
                    $curX = $startX + $padding;
                    foreach ($imgs as $imgPath) {
                        if (!empty($imgPath) && file_exists($imgPath)) {
                            $imgPDFPath = prepararImagemParaPDF($imgPath);
                            if ($imgPDFPath !== $imgPath) {
                                $tempGerados[] = $imgPDFPath;
                            }
                            $imgInfo = @getimagesize($imgPDFPath);
                            if ($imgInfo && $imgInfo[0] > 0 && $imgInfo[1] > 0) {
                                $yImg = $cellY + ($imgH - $drawH) / 2;
                                $xImg = $curX + ($maxImgW - $drawW) / 2;
                                $pdf->SetFillColor(227,240,250);
                                $pdf->Rect($curX, $cellY, $maxImgW, $imgH, 'F');
                                $pdf->Image($imgPDFPath, $xImg, $yImg, $drawW, $drawH);
                                $curX += $maxImgW + $espaco;
                            }
                        }
                    }
                }
            }
        }
        $pdf->Ln(10);
    } else {
        $pdf->SetX($startX);
        $pdf->SetTextColor(0);
        $pdf->SetFillColor(227,240,250);
        $pdf->Cell(270,110,'Sem imagem',1,1,'C',true);
        $pdf->Ln(10);
    }
}
// Exibe envios simples (menos de 2 imagens, até 2 por página)
for ($i = 0; $i < count($enviosSimples); $i += 2) {
    $pdf->AddPage();
    adicionarLogos($pdf);
    $tableW = 130;
    $pageW = $pdf->GetPageWidth();
    $startX = ($pageW - 2 * $tableW - 10) / 2;
    $yBase = $pdf->GetY() + 15;
    $maxTableHeight = 0;
    $tableHeights = [0, 0];
    for ($j = 0; $j < 2; $j++) {
        if (isset($enviosSimples[$i + $j])) {
            $tableHeights[$j] = 10 + 15 + 10 + 95 + 10;
        }
    }
    $maxTableHeight = max($tableHeights);
    for ($j = 0; $j < 2; $j++) {
        if (isset($enviosSimples[$i + $j])) {
            $row = $enviosSimples[$i + $j]['row'];
            $imgs = $enviosSimples[$i + $j]['imgs'];
            $pdf->SetXY($startX + $j * ($tableW + 10), $yBase);
            $pdf->SetFont('Arial','B',10);
            $pdf->SetFillColor(0,51,102);
            $pdf->SetTextColor(255);
            $pdf->Cell(55,10,'Local',1,0,'C',true);
            $pdf->Cell(75,10,utf8_decode('Observação'),1,1,'C',true);
            $pdf->SetX($startX + $j * ($tableW + 10));
            $pdf->SetFont('Arial','B',10);
            $pdf->SetFillColor(227,240,250);
            $pdf->SetTextColor(0);
            $pdf->Cell(55,15,utf8_decode($row['local']),1,0,'C',true);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(75,15,utf8_decode($row['observacao']),1,1,'C',true);
            $pdf->SetX($startX + $j * ($tableW + 10));
            $pdf->SetFont('Arial','B',10);
            $pdf->SetFillColor(0,51,102);
            $pdf->SetTextColor(255);
            $pdf->Cell(130,10,utf8_decode('Evidências'),1,1,'C',true);
            $pdf->SetX($startX + $j * ($tableW + 10));
            $pdf->SetTextColor(0);
            $pdf->SetFillColor(227,240,250);
            $pdf->Cell(130,95,'',1,1,'C',true);
            $maxH = 90;
            $maxWTotal = 130;
            $imgH = $maxH;
            $cellY = $yBase + 10 + 15 + 10;
            $espaco = 10;
            $padding = 10;
            $numImgsValidas = 0;
            foreach ($imgs as $imgPath) {
                if (!empty($imgPath) && file_exists($imgPath)) {
                    $numImgsValidas++;
                }
            }
            $totalEspaco = ($numImgsValidas - 1) * $espaco;
            $imgW = $numImgsValidas > 0 ? ($maxWTotal - 2 * $padding - $totalEspaco) / ($numImgsValidas ?: 1) : $maxWTotal - 2 * $padding;
            $curX = $startX + $j * ($tableW + 10) + $padding;
            foreach ($imgs as $imgPath) {
                if (!empty($imgPath) && file_exists($imgPath)) {
                    $imgPDFPath = prepararImagemParaPDF($imgPath);
                    if ($imgPDFPath !== $imgPath) {
                        $tempGerados[] = $imgPDFPath;
                    }
                    $imgInfo = @getimagesize($imgPDFPath);
                    if ($imgInfo && $imgInfo[0] > 0 && $imgInfo[1] > 0) {
                        // Padroniza tamanho das imagens para envios lado a lado
                        $drawW = 100;
                        $drawH = 70;
                        $yImg = $cellY + ($imgH - $drawH) / 2;
                        $xImg = $curX + ($imgW - $drawW) / 2;
                        $pdf->SetFillColor(227,240,250);
                        $pdf->Rect($curX, $cellY, $imgW, $imgH, 'F');
                        $pdf->Image($imgPDFPath, $xImg, $yImg, $drawW, $drawH);
                        $curX += $imgW + $espaco;
                    }
                }
            }
            if ($numImgsValidas == 0) {
                $pdf->SetXY($startX + $j * ($tableW + 10), $cellY);
                $pdf->SetTextColor(0);
                $pdf->SetFillColor(227,240,250);
                $pdf->Cell(130,95,'Sem imagem',1,1,'C',true);
            }
        }
    }
    $pdf->SetY($yBase + $maxTableHeight);
    $pdf->Ln(10);
}

$pdf->Output('I', 'relatorio_imagens.pdf');

// Limpa temporários
foreach ($tempGerados as $tmp) {
    @unlink($tmp);
}
exit;
