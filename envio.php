<?php
// checa e inclui o autoload do Composer de forma segura
$autoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoload)) {
	require_once $autoload;
} else {
	http_response_code(500);
	error_log('Composer autoload não encontrado: ' . $autoload);
	echo 'Erro interno: dependências não instaladas. Execute "composer install" no diretório do projeto.';
	exit;
}

// Adiciona cabeçalho de resposta JSON
header('Content-Type: application/json; charset=utf-8');

header('Content-Type: application/json; charset=utf-8');

// Recebe JSON do fetch ou dados de form como fallback
$raw = file_get_contents('php://input');
$input = json_decode($raw, true);
if (!is_array($input)) {
    $input = $_POST;
}

// Campos esperados
$name = isset($input['name']) ? trim($input['name']) : '';
$email = isset($input['email']) ? trim($input['email']) : '';
$subject = isset($input['subject']) ? trim($input['subject']) : 'Contato pelo site';
$message = isset($input['message']) ? trim($input['message']) : '';

// Validações básicas
if (!$name || !$email || !$message) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Nome, e-mail e mensagem são obrigatórios.']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'E-mail inválido.']);
    exit;
}
// Evita header injection
foreach ([$name, $email, $subject] as $v) {
    if (preg_match("/[\r\n]/", $v)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Dados inválidos.']);
        exit;
    }
}

// Sanitiza mensagem
$safe_name = strip_tags($name);
$safe_email = filter_var($email, FILTER_SANITIZE_EMAIL);
$safe_subject = strip_tags($subject);
$safe_message = strip_tags($message);

// Configurações de SMTP - EDITE COM SEUS DADOS
$smtpHost = 'smtp.gmail.com'; // ex: smtp.sendgrid.net ou smtp.gmail.com
$smtpUser = 'masso.conta2@gmail.com'; // Seu e-mail Gmail
$smtpPass = 'qnqj ifez wxpc dita'; // Sua senha de app do Gmail
$smtpPort = 587; // 587 para TLS, 465 para SSL
$smtpSecure = 'tls'; // tls ou ssl

// E-mail da empresa que receberá a mensagem
$companyEmail = 'masso.conta2@gmail.com'; // E-mail que receberá as mensagens
$companyName = 'Masso';

try {
    // 1) Envia e-mail para a empresa com a mensagem do usuário
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $smtpHost;
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUser;
    $mail->Password = $smtpPass;
    $mail->SMTPSecure = $smtpSecure;
    $mail->Port = $smtpPort;

    $mail->setFrom($companyEmail, $companyName);
    $mail->addAddress($companyEmail, $companyName); // enviar para a caixa comercial
    $mail->addReplyTo($safe_email, $safe_name); // assim ao responder chega no usuário

    $mail->Subject = '[Site] ' . $safe_subject;
    // Corpo HTML e texto simples
    $bodyHtml = "
      <h2>Nova mensagem pelo site</h2>
      <p><strong>Nome:</strong> {$safe_name}</p>
      <p><strong>E-mail:</strong> {$safe_email}</p>
      <p><strong>Assunto:</strong> {$safe_subject}</p>
      <p><strong>Mensagem:</strong><br />" . nl2br($safe_message) . "</p>
    ";
    $mail->isHTML(true);
    $mail->Body = $bodyHtml;
    $mail->AltBody = "Nome: {$safe_name}\nE-mail: {$safe_email}\nAssunto: {$safe_subject}\nMensagem:\n{$safe_message}";

    // garantir codificação correta
    $mail->CharSet = 'UTF-8';

    $mail->send();

    // 2) Envia e-mail de confirmação para o usuário
    $confirm = new \PHPMailer\PHPMailer\PHPMailer(true);
    $confirm->isSMTP();
    $confirm->Host = $smtpHost;
    $confirm->SMTPAuth = true;
    $confirm->Username = $smtpUser;
    $confirm->Password = $smtpPass;
    $confirm->SMTPSecure = $smtpSecure;
    $confirm->Port = $smtpPort;

    $confirm->setFrom($companyEmail, $companyName);
    $confirm->addAddress($safe_email, $safe_name);
    $confirm->addReplyTo($companyEmail, $companyName);

    $confirm->Subject = 'Recebemos sua mensagem';
    $confirmHtml = "
      <p>Olá {$safe_name},</p>
      <p>Recebemos sua mensagem e agradecemos o contato. Em breve nossa equipe responderá.</p>
      <hr />
      <p>Atenciosamente,<br />{$companyName}</p>
    ";
    $confirm->isHTML(true);
    $confirm->Body = $confirmHtml;
    $confirm->AltBody = "Olá {$safe_name},\n\nRecebemos sua mensagem e agradecemos o contato. Em breve nossa equipe responderá.\n\nAtenciosamente,\n{$companyName}";

    // garantir codificação correta
    $confirm->CharSet = 'UTF-8';

    $confirm->send();

    // Responder com JSON de sucesso
    http_response_code(200);
    echo json_encode(['success' => true, 'message' => 'Mensagem enviada com sucesso! Um e-mail de confirmação foi enviado para você.']);
} catch (\Exception $e) {
    // Logue o erro em arquivo ou sistema de logging
    error_log('Erro no envio: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Falha ao enviar e-mail: ' . $e->getMessage()]);
}
exit;
?>
