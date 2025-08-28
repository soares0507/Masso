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
    <title>Sistema de Inspeções</title>
    <link rel="shortcut icon" type="image/x-icon" href="logo.ico">
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
            width: 100%;
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
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
            gap: 20px;
        }

        .form-container, .preview-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            width: 45%;
            max-width: 500px;
        }

        .preview-container {
            width: 45%;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .form-group {
            position: relative;
            padding-bottom: 20px;
            border-bottom: 2px solid #ddd;
            margin-bottom: 20px;
        }
        
        .form-group:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .form-group h2 {
            margin: 0 0 10px;
            color: #1a237e;
            font-size: 20px;
        }
        
        .form-group .close-button {
            position: absolute;
            top: 0;
            right: 0;
            font-size: 24px;
            cursor: pointer;
            color: #c00;
        }

        .form-group input[type="text"], .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 5px;
        }
        
        .form-group .file-input-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .form-group .file-input-group input[type="file"] {
            display: none;
        }

        .form-group .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 8px 12px;
            cursor: pointer;
            background-color: #f0f0f0;
            border-radius: 4px;
        }
        
        .form-group .remove-button {
            background-color: #c00;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group .add-more-images {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 8px 12px;
            cursor: pointer;
            background-color: #f0f0f0;
            border-radius: 4px;
            margin-top: 8px;
        }

        .form-group .add-more-images:hover {
            background-color: #e0e0e0;
        }

        .preview-image {
            width: 100%;
            max-width: 400px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .preview-buttons {
            display: flex;
            gap: 10px;
            width: 100%;
            justify-content: center;
        }

        .preview-buttons button, .preview-buttons input[type="submit"] {
            background-color: #1a237e;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            flex-grow: 1;
        }
        
        .preview-buttons .add-button {
            background-color: #1a237e; 
        }

        .preview-buttons .send-button {
            background-color: #1a237e; 
        }

        .preview-buttons button:hover, .preview-buttons input[type="submit"]:hover {
            background-color: #0d124f;
        }

        .success-message {
            background:#d4edda;
            color:#155724;
            padding:15px;
            border-radius:5px;
            margin: 20px;
            border:1px solid #c3e6cb;
            text-align:center;
            font-weight:bold;
        }

        .ver-imagens-link {
            text-align: right;
            margin: 10px 20px 0 0;
        }

        .ver-imagens-link a {
            color: #1a237e;
            text-decoration: none;
            font-weight: bold;
        }
        
        .ver-imagens-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
                align-items: center;
            }
            .form-container, .preview-container {
                width: 90%;
            }
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
    let contador = 0;
    function adicionarCampos() {
        contador++;
        const container = document.getElementById('grupos');
        const div = document.createElement('div');
        div.className = 'form-group';
        div.innerHTML = `
            <h2>${contador}. Local:</h2>
            <span class="close-button" onclick="removerCampos(this)">&times;</span>
            <input type="text" name="local[]" required>
            <h3>Observações:</h3>
            <textarea name="observacao[]" required rows="3"></textarea>
            <h3>Selecione a imagem:</h3>
            <div class="imagens-container">
                <div class="file-input-group">
                    <label class="custom-file-upload">
                        <input type="file" name="imagens[${contador - 1}][]" multiple required onchange="atualizarPreview(this)">
                        Escolher arquivo
                    </label>
                    <button type="button" class="remove-button" onclick="limparImagem(this)">Excluir</button>
                </div>
            </div>
            <button type="button" class="add-more-images" onclick="adicionarMaisImagens(this, ${contador - 1})">Adicionar mais imagens</button>
        `;
        container.appendChild(div);
    }

    function adicionarMaisImagens(botao, grupoIndex) {
        const imagensContainer = botao.parentNode.querySelector('.imagens-container');
        const div = document.createElement('div');
        div.className = 'file-input-group';
        div.innerHTML = `
            <label class="custom-file-upload">
                <input type="file" name="imagens[${grupoIndex}][]" multiple onchange="atualizarPreview(this)">
                Escolher arquivo
            </label>
            <button type="button" class="remove-button" onclick="limparImagem(this)">Excluir</button>
        `;
        imagensContainer.appendChild(div);
    }

    function limparImagem(botao) {
        const fileInput = botao.closest('.file-input-group').querySelector('input[type="file"]');
        if (fileInput) {
            fileInput.value = '';
            const preview = document.querySelector('.preview-image');
            if (preview) preview.removeAttribute('src');
        }
    }

    function atualizarPreview(input) {
        if (input && input.files && input.files[0]) {
            const preview = document.querySelector('.preview-image');
            if (preview) {
                // Show first image as preview
                const reader = new FileReader();
                reader.onload = function(ev) {
                    preview.src = ev.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    }
    
    function removerCampos(botao) {
        let parent = botao.closest('.form-group');
        parent.remove();
        atualizarContador();
    }
    
    function atualizarContador() {
        const grupos = document.querySelectorAll('.form-group');
        contador = grupos.length;
        grupos.forEach((grupo, index) => {
            const h2 = grupo.querySelector('h2');
            h2.textContent = `${index + 1}. Local:`;
        });
    }

    window.onload = function() {
        adicionarCampos();
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
        // Preview da imagem selecionada
        document.body.addEventListener('change', function(e) {
            if (e.target && e.target.type === 'file' && e.target.name === 'imagens[]' && e.target.files && e.target.files[0]) {
                atualizarPreview(e.target);
            }
        });
    }
    </script>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="logo2.png" alt="MASSO Serviços Especializados">
           
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
    
    <div class="ver-imagens-link">
        <a href="mostrar_imagens.php">Ver Imagens</a>
    </div>

    <?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1): ?>
        <div class="success-message">
            Imagens enviadas com sucesso!
        </div>
    <?php endif; ?>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="main-content">
            <div class="form-container">
                <div id="grupos"></div>
            </div>
            
            <div class="preview-container">
                <img   class="preview-image">
                <div class="preview-buttons">
                    <button type="button" class="add-button" onclick="adicionarCampos()">Adicionar</button>
                    <input type="submit" value="Enviar" class="send-button">
                </div>
            </div>
        </div>
    </form>
</body>
</html>