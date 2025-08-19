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
    <title>Enviar Imagens</title>
    <link rel="shortcut icon" type="image/x-icon" href="logo.ico">
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        
        .container {
            width: 100%;
            max-width: 600px;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        
        .logo {
            display: block;
            margin: 0 auto 20px auto;
            max-width: 150px;
            height: auto;
        }

       
        h1 {
            text-align: center;
            color: #1A237E; 
            margin-bottom: 20px;
        }

        
        form {
            display: flex;
            flex-direction: column;
        }

        
        fieldset {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            padding: 15px;
            background-color: #fafafa;
        }

        legend {
            font-weight: bold;
            color: #1A237E;
            padding: 0 10px;
        }

        
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }

        
        input[type="text"],
        input[type="file"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        
        button,
        input[type="submit"] {
            background-color: #4CAF50; 
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        button:hover,
        input[type="submit"]:hover {
            background-color: #388E3C; 
        }

        
        button[type="button"] {
            background-color: #FF9800; 
        }

        button[type="button"]:hover {
            background-color: #FB8C00; 
        }

        
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #1A237E;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #007BFF;
            text-decoration: underline;
        }

        
        .grupo-campos {
            margin-bottom: 20px;
        }
    </style>
    <script>
    let contador = 0;
    function adicionarCampos() {
        contador++;
        const container = document.getElementById('grupos');
        const div = document.createElement('div');
        div.className = 'grupo-campos';
        div.style.marginBottom = '20px';
        div.innerHTML = `
            <fieldset style='padding:10px;'>
                <legend>Imagem ${contador}</legend>
                <label>Local:</label>
                <input type="text" name="local[]" required><br><br>
                <label>Nível:</label>
                <select name="nivel[]" required>
                    <option value="">Selecione</option>
                    <option value="Baixo">Baixo</option>
                    <option value="Médio">Médio</option>
                    <option value="Alto">Alto</option>
                </select><br><br>
                <label>Observação:</label>
                <input type="text" name="observacao[]" required><br><br>
                <label>Transbordo:</label>
                <select name="transbordo[]" required>
                <option value="Sim">Sim</option>
                <option value="Não">Não</option>
                </select><br><br>
                <label>Selecione a imagem:</label>
                <input type="file" name="imagens[]" required><br><br>
                <button type="button" onclick="removerCampos(this)">Remover</button>
            </fieldset>
        `;
        container.appendChild(div);
    }
    function removerCampos(botao) {
        botao.parentElement.parentElement.remove();
    }
    window.onload = function() {
        adicionarCampos(); 
    }
    </script>
</head>
<body>
    <div class="container">
        <img src="logo.jpg" alt="Logotipo da Marca MASSO" class="logo">
        <?php if ($usuario_nome): ?>
            <div style="text-align:right;margin-bottom:10px;">
                Olá, <b><?php echo htmlspecialchars($usuario_nome); ?></b> 
                <a href="logout.php" style="color:#c00;">Sair</a>
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1): ?>
            <div style="background:#d4edda;color:#155724;padding:15px;border-radius:5px;margin-bottom:20px;border:1px solid #c3e6cb;text-align:center;font-weight:bold;">
                Imagens enviadas com sucesso!
            </div>
        <?php endif; ?>
        <h1>Envio de Imagens</h1>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div id="grupos"></div>
            <button type="button" onclick="adicionarCampos()">Adicionar nova imagem</button><br><br>
            <input type="submit" value="Enviar ">
        </form>
        <br>
        <a href="mostrar_imagens.php">Ver imagens enviadas</a>
    </div>
</body>
</html>