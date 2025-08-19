<?php
include 'conexao.php';
session_start();

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
    if ($email && $senha) {
        $stmt = $conn->prepare('SELECT id, senha FROM usuarios WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $senha_bd);
            $stmt->fetch();
            if ($senha === $senha_bd) { 
                $_SESSION['usuario_id'] = $id;
                $_SESSION['usuario_email'] = $email;
                header('Location: index.php');
                exit;
            } else {
                $erro = 'Senha incorreta.';
            }
        } else {
            $erro = 'Usuário não encontrado.';
        }
        $stmt->close();
    } else {
        $erro = 'Preencha todos os campos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            background: #eee;
            font-family: Arial;
        }
        .login-container {
           width: 100%;
            max-width: 600px;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            margin-left: 30%;
            margin-top: 13%;
        }
        h2 {
            text-align: center;
            color: #1A237E;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: rgba(99, 87, 87, 1);
        }
        input[type="email"], input[type="password"] {
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
            padding: 12px 220px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
            transition: background-color 0.3s ease;
            margin-left: 30px;
        }   
        .erro {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .logo {
            display: block;
            margin: 10px auto 20px auto;
            max-width: 130px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="logo.jpg" alt="Logotipo da Marca MASSO" class="logo">
        <h2>Login</h2>
        <?php if ($erro): ?>
            <div class="erro"><?php echo $erro; ?></div>
        <?php endif; ?>
        <form method="post">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>