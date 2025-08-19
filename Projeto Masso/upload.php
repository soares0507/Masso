<?php
include 'conexao.php';
session_start();

date_default_timezone_set('America/Sao_Paulo');

$nivel = $_POST['nivel'];
$observacao = $_POST['observacao'];
$volume = $_POST['volume'];
$transbordo = $_POST['transbordo'];
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;

$diretorio = "uploads/";
if (!is_dir($diretorio)) {
    mkdir($diretorio, 0777, true);
}

foreach ($_FILES['imagens']['tmp_name'] as $key => $tmp_name) {
    $nome_arquivo = basename($_FILES['imagens']['name'][$key]);
    $caminho_completo = $diretorio . uniqid() . "_" . $nome_arquivo;

    $nivel_val = isset($nivel[$key]) ? $nivel[$key] : '';
    $observacao_val = isset($observacao[$key]) ? $observacao[$key] : '';
    $volume_val = isset($volume[$key]) ? $volume[$key] : '';
    $transbordo_val = isset($transbordo[$key]) ? $transbordo[$key] : '';
    $data_envio = date('Y-m-d H:i:s');

    if (move_uploaded_file($tmp_name, $caminho_completo)) {
        $stmt = $conn->prepare("INSERT INTO uploads (imagem, nivel, observacao, volume, transbordo, data_envio, usuario_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $caminho_completo, $nivel_val, $observacao_val, $volume_val, $transbordo_val, $data_envio, $usuario_id);
        $stmt->execute();
    }
}

header('Location: index.php?sucesso=1');
exit;
?>
