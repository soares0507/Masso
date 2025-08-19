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
    <title>Imagens Enviadas</title>
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
            flex-direction: column;
        }

        
        .container {
            width: 100%;
            max-width: 800px;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        
        h2 {
            text-align: center;
            color: #1A237E; 
            margin-bottom: 20px;
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

        
        .image-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #fafafa;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .image-card img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: box-shadow 0.2s;
        }
        .image-card img:hover {
            box-shadow: 0 0 10px #1A237E;
        }
        
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.7);
            justify-content: center;
            align-items: center;
        }
        .modal img {
            max-width: 90vw;
            max-height: 90vh;
            border-radius: 8px;
            box-shadow: 0 0 20px #000;
        }

        
        .logo {
            display: block;
            margin: 0 auto 20px auto;
            max-width: 150px;
            height: auto;
        }

        .mes-btn {
            background: #1A237E;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            margin: 5px 5px 5px 0;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.2s;
        }
        .mes-btn:hover {
            background: #3949ab;
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
        .ano-title {
            color: #388E3C;
            margin-top: 30px;
        }
        .mes-imagens, .semana-imagens { display: none; margin-bottom: 30px; }
    </style>
    <script>
    function mostrarImagens(mesAnoId) {
        
        document.querySelectorAll('.mes-imagens').forEach(function(div) {
            div.style.display = 'none';
        });
       
        var el = document.getElementById(mesAnoId);
        if (el) el.style.display = 'block';
    }
    function mostrarSemana(semanaId) {
        document.querySelectorAll('.semana-imagens').forEach(function(div) {
            div.style.display = 'none';
        });
        var el = document.getElementById(semanaId);
        if (el) el.style.display = 'block';
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
    </script>
</head>
<body>
    <div class="container">
        <img src="logo.jpg" alt="Logotipo da Marca MASSO" class="logo">
        <?php if ($usuario_nome): ?>
            <div style="text-align:right;margin-bottom:10px;">
                Olá, <b><?php echo htmlspecialchars($usuario_nome); ?></b> 
            </div>
        <?php endif; ?>
<?php
$sql = "SELECT uploads.*, usuarios.nome as nome_usuario FROM uploads LEFT JOIN usuarios ON uploads.usuario_id = usuarios.id ORDER BY data_envio DESC, uploads.id DESC";
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
        $data = strtotime($row['data_envio']);
        $mes = date('m', $data);
        $ano = date('Y', $data);
        $dia = date('d', $data);
        $semana = ceil($dia / 7);
        $anos[$ano] = true;
        $imagens_ano_mes_semana[$ano][$mes][$semana][] = $row;
    }
    krsort($anos);
    echo '<h2>Imagens enviadas</h2>';
    echo '<a href="index.php">Voltar</a><br><br>';
    foreach ($anos as $ano => $_) {
        echo '<div class="ano-title">' . $ano . '</div>';
        foreach ($meses as $num => $nome) {
            $btn_id = "mes_{$ano}_{$num}";
            echo '<button class="mes-btn" onclick="mostrarImagens(\''.$btn_id.'\')">' . $nome . '</button>';
        }
        foreach ($meses as $num => $nome) {
            $btn_id = "mes_{$ano}_{$num}";
            echo '<div class="mes-imagens" id="'.$btn_id.'">';
            if (isset($imagens_ano_mes_semana[$ano][$num])) {
                $semanas = array_keys($imagens_ano_mes_semana[$ano][$num]);
                sort($semanas);
                foreach ($semanas as $semana) {
                    $semana_id = "semana_{$ano}_{$num}_{$semana}";
                    echo '<button class="semana-btn" onclick="mostrarSemana(\''.$semana_id.'\')">' . $semana . 'ª semana</button>';
                }
                foreach ($semanas as $semana) {
                    $semana_id = "semana_{$ano}_{$num}_{$semana}";
                    echo '<div class="semana-imagens" id="'.$semana_id.'">';
                    foreach ($imagens_ano_mes_semana[$ano][$num][$semana] as $row) {
                        echo '<div class="image-card">';
                        echo '<b>Local:</b> ' . htmlspecialchars($row['local'] ?? '') . '<br>';

                        echo '<img src="' . htmlspecialchars($row['imagem']) . '" alt="Imagem enviada" width="200" onclick="abrirModal(this.src)"><br>';
                        if(isset($row['nivel'])) echo 'Nível: ' . htmlspecialchars($row['nivel']) . '<br>';
                        echo 'Observação: ' . htmlspecialchars($row['observacao']) . '<br>';
                        echo 'Transbordo: ' . htmlspecialchars($row['transbordo']) . '<br>';
                        if(isset($row['data_envio'])) echo '<b>Data de envio:</b> ' . date('d/m/Y H:i:s', strtotime($row['data_envio'])) . '<br>';
                        echo '<b>Enviado por:</b> ' . htmlspecialchars($row['nome_usuario'] ?? 'Desconhecido') . '<br>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
            } else {
                echo '<div style="text-align:center;color:#888;">Nenhuma imagem enviada neste mês.</div>';
            }
            echo '</div>';
        }
    }
} else {
    echo '<p>Nenhuma imagem enviada ainda.</p>';
}
?>
    </div>
    <div class="modal" id="modal-imagem" onclick="fecharModal()">
        <img id="modal-img" src="" alt="Imagem ampliada">
    </div>
</body>
</html>