<?php
session_start();
require_once "../config.php";
require_once "../db.php";


$email = $_GET['email'] ?? '';
$error = "";
$success = "";

// If user is already verified or logged in, redirect to dashboard
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION["is_verified"]) && $_SESSION["is_verified"] == 1){
    header("location: dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = trim($_POST["code"]);
    $email = trim($_POST["email"]);

    if(empty($code)){
        $error = "Please enter the 6-digit verification code.";
    } else {
        $sql = "SELECT id FROM users WHERE email = ? AND verify_code = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_code);
            $param_email = $email;
            $param_code = $code;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Code matches! Update user status
                    $update_sql = "UPDATE users SET is_verified = 1, verify_code = '' WHERE email = ?";
                    if($update_stmt = mysqli_prepare($link, $update_sql)){
                        mysqli_stmt_bind_param($update_stmt, "s", $param_email);
                        if(mysqli_stmt_execute($update_stmt)){
                            $success = "Account verified successfully! Redirecting to login...";
                            header("refresh:3;url=login.php?verified=1");
                        }
                    }
                } else {
                    $error = "The verification code is incorrect or has expired.";
                }
            }
            mysqli_stmt_close($stmt);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Account | Redman Finance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0b132b; }
        .glass-card { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <h1 class="text-[#f9c74f] text-3xl font-bold tracking-tighter">REDMAN FINANCE</h1>
            <p class="text-gray-400 text-sm uppercase tracking-widest">Security Verification</p>
        </div>

        <div class="bg-white rounded-2xl p-8 shadow-2xl">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Check your email</h2>
            <p class="text-gray-500 mb-6">We've sent a 6-digit verification code to <span class="text-indigo-600 font-semibold"><?php echo htmlspecialchars($email); ?></span></p>

            <?php if($error): ?>
                <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <?php if($success): ?>
                <div class="mb-4 p-3 bg-green-50 border-l-4 border-green-500 text-green-700 text-sm">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <form action="verify.php" method="POST" class="space-y-6">
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                
                <div>
                    <input type="text" name="code" maxlength="6" required 
                           class="w-full text-center text-3xl font-bold tracking-[0.5em] py-4 border-2 border-gray-200 rounded-xl focus:border-[#f9c74f] focus:outline-none transition-all"
                           placeholder="000000">
                </div>

                <button type="submit" class="w-full bg-[#0b132b] text-white font-bold py-4 rounded-xl hover:bg-[#1c2541] transform transition active:scale-95 shadow-lg">
                    Verify Account
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-gray-500 text-sm">Didn't receive the code?</p>
                <a href="resend_code.php?email=<?php echo $_GET['email']; ?>">Resend Code</a>
            </div>
        </div>
        
        <p class="text-center text-gray-500 text-xs mt-8">
            &copy; 2026 Redman Finance | Institutional Asset Management
        </p>
    </div>
</body>
</html>
