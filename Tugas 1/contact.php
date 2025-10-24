<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo 'Method not allowed'; exit; }
$name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
$email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL) : false;
$phone = isset($_POST['phone']) ? strip_tags(trim($_POST['phone'])) : '';
$message = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';
$errors = [];
if (!$name) $errors[] = 'Nama diperlukan.';
if (!$email) $errors[] = 'Email tidak valid atau kosong.';
if (!$message) $errors[] = 'Pesan tidak boleh kosong.';
if (!empty($errors)) { http_response_code(422); foreach ($errors as $err) { echo "<p style='color:#b94141;'>• " . htmlspecialchars($err) . "</p>"; } exit; }
$logDir = __DIR__ . '/logs'; if (!is_dir($logDir)) mkdir($logDir, 0755, true);
$entry = sprintf("[%s] %s <%s> (%s)\n%s\n\n", date('Y-m-d H:i:s'), $name, $email, $phone, $message);
file_put_contents($logDir . '/contacts.txt', $entry, FILE_APPEND | LOCK_EX);
echo "<p style='color:#186f35;'>Terima kasih, " . htmlspecialchars($name) . ". Pesan Anda telah diterima. Kami akan menghubungi lewat: " . htmlspecialchars($email) . "</p>";
?>