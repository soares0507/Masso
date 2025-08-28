<?php
include 'conexao.php';
session_start();


date_default_timezone_set('America/Sao_Paulo');

$nivel = $_POST['nivel'];
$observacao = $_POST['observacao'];
$volume = $_POST['volume'];
$transbordo = $_POST['transbordo'];
$local = $_POST['local'];
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;

$diretorio = "uploads/";
if (!is_dir($diretorio)) {
    mkdir($diretorio, 0777, true);
}

foreach ($_POST['local'] as $key => $local_val) {
    $nivel_val = isset($nivel[$key]) ? $nivel[$key] : '';
    $observacao_val = isset($observacao[$key]) ? $observacao[$key] : '';
    $volume_val = isset($volume[$key]) ? $volume[$key] : '';
    $transbordo_val = isset($transbordo[$key]) ? $transbordo[$key] : '';
    $data_envio = date('Y-m-d H:i:s');

    // Insere o local/observação
    $stmt = $conn->prepare("INSERT INTO upload_locais (nivel, observacao, volume, transbordo, data_envio, usuario_id, local) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssis", $nivel_val, $observacao_val, $volume_val, $transbordo_val, $data_envio, $usuario_id, $local_val);
    $stmt->execute();
    $local_id = $stmt->insert_id;
    $stmt->close();

    // Salva as imagens associadas
    if (isset($_FILES['imagens']['name'][$key])) {
        foreach ($_FILES['imagens']['tmp_name'][$key] as $img_key => $tmp_name) {
            $nome_arquivo = basename($_FILES['imagens']['name'][$key][$img_key]);
            $caminho_completo = $diretorio . uniqid() . "_" . $nome_arquivo;
            if (move_uploaded_file($tmp_name, $caminho_completo)) {
                $stmt_img = $conn->prepare("INSERT INTO upload_imagens (local_id, imagem) VALUES (?, ?)");
                $stmt_img->bind_param("is", $local_id, $caminho_completo);
                $stmt_img->execute();
                $stmt_img->close();
            }
        }
    }
}

header('Location: index.php?sucesso=1');
exit;
?>
