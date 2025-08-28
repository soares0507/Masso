<?php
include 'conexao.php';
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
$usuario_nome = '';
if (isset($_SESSION['usuario_id'])) {
    $id = $_SESSION['usuario_id'];
    $sql = "SELECT nome FROM usuarios WHERE id = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($usuario_nome);
    $stmt->fetch();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagens Enviadas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #1a237e;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .logo {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .header .logo img {
            height: 100px;
            margin-right: 20px;
        }

        .header .logo .titulo-sistema {
            font-family: 'Clear Sans', Arial, sans-serif;
            font-size: 1rem;
            font-weight: bold;
            letter-spacing: 2px;
            flex: 1;
            text-align: left;
            width: 150%;
            white-space: nowrap;
        }

        @font-face {
            font-family: 'Clear Sans';
            src: url('ClearSans-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        .header .user-info {
            display: flex;
            align-items: center;
        }

        .header .user-info img {
            height: 30px;
            border-radius: 50%;
            margin-left: 10px;
        }

        .main-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .controls {
            width: 100%;
            max-width: 900px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .controls a {
            color: #1a237e;
            text-decoration: none;
            font-weight: bold;
        }
        
        .controls .year-selector {
            display: flex;
            align-items: center;
            font-size: 20px;
            font-weight: bold;
            color: #1a237e;
            cursor: pointer;
            margin-top: 10px;
            position: relative;
        }
        .year-dropdown {
            position: absolute;
            top: 35px;
            left: 0;
            background: #fff;
            border: 1px solid #1a237e;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
            z-index: 100;
            min-width: 120px;
            display: none;
        }
        .year-dropdown button {
            background: none;
            border: none;
            color: #1a237e;
            font-size: 18px;
            padding: 8px 16px;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }
        .year-dropdown button:hover {
            background: #e0e0e0;
        }
        
        .month-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        @media (max-width: 600px) {
            body {
                background: #f0f9f4;
                padding: 0;
            }
            .main-content {
                padding: 10px 0;
            }
            .controls {
                width: 98vw !important;
                max-width: 98vw !important;
                padding: 0 8px;
            }
            .month-buttons {
                width: 100% !important;
                max-width: 100vw !important;
                gap: 8px !important;
                flex-wrap: wrap;
                justify-content: flex-start;
            }
            .month-btn, .pdf-btn, .semana-btn {
                font-size: 1em !important;
                padding: 12px 0 !important;
                border-radius: 12px !important;
                width: 100%;
                margin: 0 0 8px 0 !important;
                box-shadow: 0 2px 8px rgba(40,160,96,0.07);
            }
            .image-grid {
                flex-direction: column !important;
                gap: 0 !important;
                align-items: center !important;
                width: 100% !important;
            }
            .image-grid > div {
                width: 100% !important;
                max-width: 100vw !important;
                margin: 0 auto 18px auto !important;
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                justify-content: center !important;
            }
            .cards-row {
                flex-direction: column !important;
                gap: 0 !important;
                width: 100% !important;
                align-items: center !important;
            }
            .image-card-container, .image-card-container.larga {
                width: 100% !important;
                max-width: 100vw !important;
                min-width: 0 !important;
                margin-bottom: 18px !important;
                height: auto !important;
            }
            .custom-table, .custom-table.evidence-table {
                width: 100% !important;
                max-width: 100vw !important;
                min-width: 0 !important;
                margin-bottom: 8px !important;
                height: auto !important;
            }
            .custom-table th, .custom-table td {
                padding: 8px !important;
                font-size: 0.95em !important;
            }
            .evidence-table img {
                display: block !important;
                margin: 10px auto !important;
                max-width: 95vw !important;
                max-height: 180px !important;
            }
            .evidence-table td > div {
                flex-direction: column !important;
                align-items: center !important;
                gap: 0 !important;
            }
            hr {
                margin: 18px 0 !important;
            }
        }

        .month-btn, .pdf-btn {
            background-color: #1a237e;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        
        .month-btn:hover, .pdf-btn:hover {
            background-color: #0d124f;
        }
        
        .pdf-btn {
            background-color: #f7b731;
        }

        .image-display-area {
            width: 100%;
            max-width: 900px;
        }
        
        .semana-btn {
            background: #388E3C;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 6px 12px;
            margin: 5px 5px 5px 0;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.2s;
        }
        
        .semana-btn:hover {
            background: #2e7031;
        }

        .image-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            align-items: center;
        }

        .image-card-container {
            width: 400px;
            max-width: 400px;
            min-width: 400px;
            height: 340px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .image-card-container.larga {
            width: 820px;
            max-width: 820px;
            min-width: 820px;
            height: 340px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .cards-row {
            display: flex;
            gap: 0;
            justify-content: center;
            align-items: stretch;
            width: 100%;
        }

        .custom-table {
            border-collapse: collapse;
            border: 1px solid #000;
            box-sizing: border-box;
        }
        .custom-table.evidence-table {
            width: 100%;
            max-width: 400px;
            min-width: 400px;
            height: 170px;
            margin-bottom: 5px;
        }
        .image-card-container .custom-table,
        .image-card-container .custom-table.evidence-table {
            width: 100%;
            max-width: 400px;
            min-width: 400px;
            height: 170px;
        }
        .image-card-container.larga .custom-table,
        .image-card-container.larga .custom-table.evidence-table {
            width: 100%;
            max-width: 820px;
            min-width: 820px;
            height: 170px;
        }
        .custom-table th, .custom-table td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
            height: 40px;
        }
        .custom-table th {
            background-color: #1a237e;
            color: white;
            font-weight: normal;
        }
        .custom-table.evidence-table th {
            background-color: #1a237e;
            color: white;
        }
        .custom-table.evidence-table td {
            background-color: white;
        }

        .image-card img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .evidence-table img {
            max-width: 200px;
            max-height: 140px;
            width: auto;
            height: auto;
            display: block;
            margin: 0 auto;
            object-fit: contain;
            box-sizing: border-box;
        }
        .evidence-table td {
            overflow: hidden;
            padding: 0;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            justify-content: center;
            align-items: center;
        }
        
        .modal img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 8px;
            box-shadow: 0 0 20px #000;
        }

        .user-img-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }
        .logout-link {
            color: #1a237e;
            text-decoration: none;
            margin-top: 5px;
            display: none;
            position: absolute;
            top: 35px;
            left: 50%;
            transform: translateX(-50%);
            background: #fff;
            padding: 5px 16px;
            border-radius: 4px;
            z-index: 20;
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
            font-weight: bold;
            border: 1px solid #1a237e;
            cursor: pointer;
        }
    </style>
    <script>
    let filtroAtual = {ano: '', mes: '', semana: ''};
    function mostrarImagens(mesAnoId) {
        document.querySelectorAll('.mes-imagens').forEach(function(div) {
            div.style.display = 'none';
        });
        document.querySelectorAll('.semana-btn-group').forEach(function(div) {
            div.style.display = 'none';
        });
        
        var el = document.getElementById(mesAnoId);
        if (el) el.style.display = 'block';

        const partes = mesAnoId.split('_');
        filtroAtual.ano = partes[1];
        filtroAtual.mes = partes[2];
        filtroAtual.semana = '';
        
        const semanaBtnGroup = document.getElementById('semana_' + filtroAtual.ano + '_' + filtroAtual.mes + '_buttons');
        if (semanaBtnGroup) {
            semanaBtnGroup.style.display = 'flex';
        }
        document.getElementById('btnPDF').style.display = 'none';
    }

    function mostrarSemana(semanaId) {
        document.querySelectorAll('.semana-imagens').forEach(function(div) {
            div.style.display = 'none';
        });
        var el = document.getElementById(semanaId);
        if (el) el.style.display = 'block';

        const partes = semanaId.split('_');
        filtroAtual.ano = partes[1];
        filtroAtual.mes = partes[2];
        filtroAtual.semana = partes[3];
        document.getElementById('btnPDF').style.display = 'inline-block';
    }
    
    function abrirModal(src) {
        var modal = document.getElementById('modal-imagem');
        var img = document.getElementById('modal-img');
        img.src = src;
        modal.style.display = 'flex';
    }
    function fecharModal() {
        document.getElementById('modal-imagem').style.display = 'none';
    }
    function enviarPDF() {
        document.getElementById('pdfAno').value = filtroAtual.ano;
        document.getElementById('pdfMes').value = filtroAtual.mes;
        document.getElementById('pdfSemana').value = filtroAtual.semana;
        document.getElementById('pdfForm').submit();
    }
    </script>
</head>
<body>
    <div class="header">
        <div class="logo">
          <a href="index.php" > <img src="logo2.png" alt="MASSO Serviços Especializados"></a>
           
        </div>
        <?php if ($usuario_nome): ?>
            <div class="user-info" style="flex-direction:column; align-items:center; position:relative;">
                <div class="user-img-container" style="display:flex; flex-direction:column; align-items:center; position:relative;">
                    <img src="user.png" alt="User Icon" style="cursor:pointer;">
                    <a href="logout.php" class="logout-link">Sair</a>
                </div>
                <span style="margin-top:5px; color:white;">Olá, <b><?php echo htmlspecialchars($usuario_nome); ?></b></span>
            </div>
        <?php endif; ?>
    </div>

    <div class="main-content">
        <div class="controls">
            <a href="index.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            </a>
            
            <?php
            $sql = "SELECT l.*, GROUP_CONCAT(i.imagem) AS imagens, u.nome as nome_usuario FROM upload_locais l LEFT JOIN upload_imagens i ON l.id = i.local_id LEFT JOIN usuarios u ON l.usuario_id = u.id GROUP BY l.id ORDER BY l.data_envio DESC, l.id DESC";
            $result = $conn->query($sql);

            $meses = array(
                '01' => 'Janeiro', '02' => 'Fevereiro', '03' => 'Março', '04' => 'Abril',
                '05' => 'Maio', '06' => 'Junho', '07' => 'Julho', '08' => 'Agosto',
                '09' => 'Setembro', '10' => 'Outubro', '11' => 'Novembro', '12' => 'Dezembro'
            );

            $imagens_ano_mes_semana = array();
            $anos = array();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $imagens = $row['imagens'] ? explode(',', $row['imagens']) : [];
                    $data = strtotime($row['data_envio']);
                    $mes = date('m', $data);
                    $ano = date('Y', $data);
                    $dia = date('d', $data);
                    $semana = ceil($dia / 7);
                    $anos[$ano] = true;
                    $imagens_ano_mes_semana[$ano][$mes][$semana][] = [
                        'local' => $row['local'],
                        'observacao' => $row['observacao'],
                        'imagens' => $imagens
                    ];
                }
                krsort($anos);
                
                // Gera lista de anos do intervalo desejado
                $anoMin = 2022;
                $anoMax = (int)date('Y');
                $anosArray = [];
                for ($a = $anoMax; $a >= $anoMin; $a--) {
                    $anosArray[] = $a;
                }
                $anoSelecionado = $anosArray[0];
                echo '<div class="custom-table" style="margin-bottom:20px; padding:10px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.08); background:#fff;">';
                echo '<div class="year-selector" id="yearSelector">';
                echo '<span id="triangle" style="margin-right:8px; cursor:pointer;">▼</span>';
                echo '<span id="selectedYear" style="cursor:pointer;">' . $anoSelecionado . '</span>';
                echo '<div class="year-dropdown" id="yearDropdown">';
                foreach ($anosArray as $ano) {
                    echo '<button type="button" onclick="selecionarAno(\''.$ano.'\')">' . $ano . '</button>';
                }
                echo '</div>';
                echo '</div>';
                echo '<div class="month-buttons" id="monthButtons" style="display:none;">';
                foreach ($meses as $num => $nome) {
                    $btn_id = "mes_" . $anoSelecionado . "_{$num}";
                    echo '<button class="month-btn" onclick="mostrarImagens(\''.$btn_id.'\')">' . $nome . '</button>';
                }
                echo '<button class="pdf-btn" id="btnPDF" style="display:none;" onclick="enviarPDF()">Gerar PDF</button>';
                echo '</div>';
                echo '</div>';
                
            } else {
                echo '<p>Nenhuma imagem enviada ainda.</p>';
            }
            ?>
        </div>
        
        <div class="image-display-area" id="imageDisplayArea">
            <?php
            $anosTodos = [];
            for ($a = $anoMax; $a >= $anoMin; $a--) {
                $anosTodos[] = $a;
            }
            foreach ($anosTodos as $ano) {
                foreach ($meses as $num => $nome) {
                    $btn_id = "mes_{$ano}_{$num}";
                    echo '<div class="mes-imagens" id="'.$btn_id.'" style="display:none;">';
                    if (isset($imagens_ano_mes_semana[$ano][$num])) {
                        $semanas = array_keys($imagens_ano_mes_semana[$ano][$num]);
                        sort($semanas);
                        echo '<div class="semana-btn-group" id="semana_'.$ano.'_'.$num.'_buttons" style="display:none; margin-top: 10px; margin-bottom: 20px;">';
                        foreach ($semanas as $semana) {
                            $semana_id = "semana_{$ano}_{$num}_{$semana}";
                            echo '<button class="semana-btn" onclick="mostrarSemana(\''.$semana_id.'\')">' . $semana . 'ª semana</button>';
                        }
                        echo '</div>';
                        foreach ($semanas as $semana) {
                            $semana_id = "semana_{$ano}_{$num}_{$semana}";
                            echo '<div class="semana-imagens" id="'.$semana_id.'" style="display:none;">';
                            echo '<div class="image-grid">';
                            $total = count($imagens_ano_mes_semana[$ano][$num][$semana]);
                            $idx = 0;
                            while ($idx < $total) {
                                $row = $imagens_ano_mes_semana[$ano][$num][$semana][$idx];
                                $qtdImgs = count($row['imagens']);
                                $containerClass = $qtdImgs > 2 ? 'image-card-container larga' : 'image-card-container';
                                if ($qtdImgs > 2) {
                                    // Card largo, isolado
                                    echo '<div class="' . $containerClass . '" style="margin:0 auto;">';
                                    echo '<table class="custom-table">';
                                    echo '<thead><tr><th style="width:40%;">Local</th><th style="width:60%;">Observação</th></tr></thead>';
                                    echo '<tbody><tr>';
                                    echo '<td style="font-weight:bold;">' . htmlspecialchars($row['local'] ?? '') . '</td>';
                                    echo '<td>' . nl2br(htmlspecialchars($row['observacao'])) . '</td>';
                                    echo '</tr></tbody>';
                                    echo '</table>';
                                    echo '<table class="custom-table evidence-table">';
                                    echo '<thead><tr><th>Evidências</th></tr></thead>';
                                    echo '<tbody><tr><td>';
                                    echo '<div style="display:flex; gap:10px; justify-content:center; align-items:center; flex-wrap:nowrap; overflow:hidden;">';
                                    foreach ($row['imagens'] as $img) {
                                        echo '<img src="' . htmlspecialchars($img) . '" alt="Imagem enviada" onclick="abrirModal(this.src)">';
                                    }
                                    echo '</div>';
                                    echo '</td></tr></tbody>';
                                    echo '</table>';
                                    echo '</div>';
                                    $idx++;
                                } else {
                                    // Cards lado a lado, no máximo 2 por linha (desktop)
                                    echo '<div class="cards-row" style="display:flex; gap:0; justify-content:center; align-items:stretch; width:100%;">';
                                    for ($col=0; $col<2 && $idx<$total; $col++) {
                                        $row = $imagens_ano_mes_semana[$ano][$num][$semana][$idx];
                                        $qtdImgs = count($row['imagens']);
                                        if ($qtdImgs > 2) break;
                                        echo '<div class="' . $containerClass . " image-card-container" . '" style="margin:0 auto;">';
                                        echo '<table class="custom-table">';
                                        echo '<thead><tr><th style="width:40%;">Local</th><th style="width:60%;">Observação</th></tr></thead>';
                                        echo '<tbody><tr>';
                                        echo '<td style="font-weight:bold;">' . htmlspecialchars($row['local'] ?? '') . '</td>';
                                        echo '<td>' . nl2br(htmlspecialchars($row['observacao'])) . '</td>';
                                        echo '</tr></tbody>';
                                        echo '</table>';
                                        echo '<table class="custom-table evidence-table">';
                                        echo '<thead><tr><th>Evidências</th></tr></thead>';
                                        echo '<tbody><tr><td>';
                                        echo '<div style="display:flex; gap:10px; justify-content:center; align-items:center; flex-wrap:nowrap; overflow:hidden;">';
                                        foreach ($row['imagens'] as $img) {
                                            echo '<img src="' . htmlspecialchars($img) . '" alt="Imagem enviada" onclick="abrirModal(this.src)">';
                                        }
                                        echo '</div>';
                                        echo '</td></tr></tbody>';
                                        echo '</table>';
                                        echo '</div>';
                                        $idx++;
                                    }
                                    echo '</div>';
                                }
                            }
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div style="text-align:center;color:#888;">Nenhuma imagem enviada neste mês.</div>';
                    }
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
    
    <div class="modal" id="modal-imagem" onclick="fecharModal()">
        <img id="modal-img" src="" alt="Imagem ampliada">
    </div>

    <form id="pdfForm" method="post" action="gerar_pdf.php" target="_blank" style="display:none;">
        <input type="hidden" name="ano" id="pdfAno">
        <input type="hidden" name="mes" id="pdfMes">
        <input type="hidden" name="semana" id="pdfSemana">
    </form>
    <script>
    window.onload = function() {
        // Exibir/ocultar logout-link com atraso
        const userImgContainer = document.querySelector('.user-img-container');
        const logoutLink = document.querySelector('.logout-link');
        let hideTimeout;
        if (userImgContainer && logoutLink) {
            userImgContainer.addEventListener('mouseenter', function() {
                clearTimeout(hideTimeout);
                logoutLink.style.display = 'block';
            });
            userImgContainer.addEventListener('mouseleave', function() {
                hideTimeout = setTimeout(function() {
                    logoutLink.style.display = 'none';
                }, 200);
            });
            logoutLink.addEventListener('mouseenter', function() {
                clearTimeout(hideTimeout);
                logoutLink.style.display = 'block';
            });
            logoutLink.addEventListener('mouseleave', function() {
                hideTimeout = setTimeout(function() {
                    logoutLink.style.display = 'none';
                }, 200);
            });
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        var triangle = document.getElementById('triangle');
        var selectedYear = document.getElementById('selectedYear');
        var yearDropdown = document.getElementById('yearDropdown');
        var monthButtons = document.getElementById('monthButtons');
        triangle.addEventListener('click', function(e) {
            e.stopPropagation();
            yearDropdown.style.display = yearDropdown.style.display === 'block' ? 'none' : 'block';
        });
        selectedYear.addEventListener('click', function(e) {
            e.stopPropagation();
            if (monthButtons.innerHTML.trim() !== '') {
                monthButtons.style.display = monthButtons.style.display === 'flex' ? 'none' : 'flex';
            }
        });
        document.addEventListener('click', function() {
            yearDropdown.style.display = 'none';
            monthButtons.style.display = 'none';
        });
        window.selecionarAno = function(ano) {
            selectedYear.textContent = ano;
            yearDropdown.style.display = 'none';
            // Atualiza os botões dos meses para o ano selecionado
            var meses = [
                {num: '01', nome: 'Janeiro'},
                {num: '02', nome: 'Fevereiro'},
                {num: '03', nome: 'Março'},
                {num: '04', nome: 'Abril'},
                {num: '05', nome: 'Maio'},
                {num: '06', nome: 'Junho'},
                {num: '07', nome: 'Julho'},
                {num: '08', nome: 'Agosto'},
                {num: '09', nome: 'Setembro'},
                {num: '10', nome: 'Outubro'},
                {num: '11', nome: 'Novembro'},
                {num: '12', nome: 'Dezembro'}
            ];
            var html = '';
            for (var i = 0; i < meses.length; i++) {
                var btn_id = 'mes_' + ano + '_' + meses[i].num;
                html += '<button class="month-btn" onclick="mostrarImagens(\''+btn_id+'\')">' + meses[i].nome + '</button>';
            }
            html += '<button class="pdf-btn" id="btnPDF" style="display:none;" onclick="enviarPDF()">Gerar PDF</button>';
            monthButtons.innerHTML = html;
            monthButtons.style.display = 'none'; // Só mostra ao clicar no ano
        }
        selectedYear.addEventListener('click', function(e) {
            e.stopPropagation();
            // Só mostra os meses se já estiverem carregados
            if (monthButtons.innerHTML.trim() !== '') {
                monthButtons.style.display = 'flex';
                yearDropdown.style.display = 'none';
            }
        });
    });
    </script>
</body>
</html>