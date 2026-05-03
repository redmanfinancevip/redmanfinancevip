<?php
// 1. Setup and Security
ini_set('max_execution_time', '300'); 
include "../db.php";
include "../config.php";

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Use filter_var to ensure the email is valid before processing
$email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);

if (!$email) {
    header("location: verify.php?msg=invalid_email");
    exit();
}

$new_code = rand(100000, 999999);

// 2. Update Database with the new code
$stmt = $conn->prepare("UPDATE users SET verify_code = ? WHERE email = ?");
$stmt->bind_param("is", $new_code, $email);
$stmt->execute();

// 3. The Professional HTML Template
$message = "
<!DOCTYPE html>
<html>
<head>
    <style>
        .wrapper { background-color: #0f111a; padding: 40px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .container { max-width: 500px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .header { background: linear-gradient(135deg, #1a1a1a 0%, #333333 100%); padding: 30px; text-align: center; }
        .content { padding: 40px; text-align: center; color: #333333; }
        .code-box { background: #f4f7ff; border: 2px dashed #007bff; border-radius: 8px; padding: 20px; margin: 25px 0; font-size: 36px; font-weight: bold; letter-spacing: 8px; color: #007bff; }
        .footer { background: #f9f9f9; padding: 20px; text-align: center; font-size: 12px; color: #999999; }
        .btn { display: inline-block; padding: 12px 24px; background-color: #007bff; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold; }
    </style>
</head>
<body>
    <div class='wrapper'>
        <div class='container'>
            <div class='header'>
                <h1 style='color: #ffffff; margin: 0; font-size: 24px; text-transform: uppercase;'>Redman Finance</h1>
            </div>
            <div class='content'>
                <h2 style='margin-top: 0;'>New Security Code</h2>
                <p>You requested a new verification code. Please use the 6-digit number below to verify your account.</p>
                <div class='code-box'>$new_code</div>
                <p style='font-size: 14px; color: #666;'>If you didn't request this, you can safely ignore this email.</p>
            </div>
            <div class='footer'>
                &copy; 2026 Redman Finance VIP. Secure Trading Infrastructure.
            </div>
        </div>
    </div>
</body>
</html>
";

// 4. Send the Advanced Email
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'redmanfinancevip@gmail.com';
    $mail->Password   = 'ytxysdclkfdmvyan'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('redmanfinancevip@gmail.com', 'Redman Finance Security');
    $mail->addAddress($email);

    // Content
    $mail->isHTML(true);
    $mail->Subject = "$new_code is your Redman Finance code";
    $mail->Body    = $message;
    $mail->AltBody = "Your new verification code is: $new_code";

    $mail->send();
    header("location: verify.php?email=" . urlencode($email) . "&msg=sent");
} catch (Exception $e) {
    // If it fails, we still want to know why locally
    header("location: verify.php?email=" . urlencode($email) . "&msg=error");
}
exit();