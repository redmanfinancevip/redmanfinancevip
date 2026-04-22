<?php
session_start();
include "../db.php";
include "../config.php";

$msg = "";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_SESSION['email'])){
    $email = $link->real_escape_string($_SESSION['email']);
    $sql1 = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($link, $sql1);
    if(mysqli_num_rows($result) > 0){
        $row1 = mysqli_fetch_assoc($result);
        $ubalance = round($row1['walletbalance'],2);
        $uprofit = round($row1['profit'],2);
    } else {
        header("location: ../login.php");
    }
} else {
    header('location: ../login.php');
    die();
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="../public/REDMAN FINANCE.svg">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>My Investments | Redman Finance</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Tailwind CSS CDN with custom colors -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#f4d35e',
                        darkbg: '#0D1627',
                        cardbg: '#1A2639',
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #0D1627;
            color: #ffffff;
        }
        .sidebar {
            background-color: #1A2639;
        }
        .nav li a {
            color: #ffffff;
        }
        .nav li a:hover {
            background-color: rgba(244, 211, 94, 0.1);
        }
        .nav li.active a {
            background-color: #f4d35e;
            color: #0D1627;
        }
        .navbar {
            background-color: #1A2639 !important;
        }
        .card {
            background-color: #1A2639;
            border: 1px solid #2a3a56;
            border-radius: 0.5rem;
        }
        .footer {
            background-color: #1A2639;
            color: #ffffff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #2a3a56;
        }
        th {
            background-color: #1A2639;
            color: #f4d35e;
        }
        tr:hover {
            background-color: rgba(244, 211, 94, 0.05);
        }
        .status-active {
            color: #4CAF50;
        }
        .status-completed {
            color: #f4d35e;
        }
    </style>
</head>
<body class="min-h-screen flex">

    <!-- Sidebar -->
    <div class="w-64 fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition duration-200 ease-in-out z-50 bg-[#0D1627]">
        <div class="h-full flex flex-col">
            <div class="p-4 flex items-center justify-center">
                <a href="../" class="flex items-center space-x-3">
                    <img src="../public/REDMAN FINANCE.svg" alt="Redman Finance Logo" class="h-10">
                </a>
            </div>
            
            <nav class="flex-1 px-2 space-y-1">
                <a href="./" class="flex items-center px-4 py-3 text-sm font-medium rounded-md text-gray-300 hover:bg-gray-800">
                    <i class="fas fa-chart-line mr-3"></i>
                    Dashboard
                </a>
                
                <a href="packages.php" class="flex items-center px-4 py-3 text-sm font-medium rounded-md text-gray-300 hover:bg-gray-800">
                    <i class="fas fa-boxes mr-3"></i>
                    Investment Plans
                </a>
                
                <a href="mypackages.php" class="flex items-center px-4 py-3 text-sm font-medium rounded-md bg-primary text-darkbg">
                    <i class="fas fa-wallet mr-3"></i>
                    My Investments
                </a>
                
                <a href="withdrawal.php" class="flex items-center px-4 py-3 text-sm font-medium rounded-md text-gray-300 hover:bg-gray-800">
                    <i class="fas fa-money-bill-wave mr-3"></i>
                    Withdrawal
                </a>
                
                <a href="profile.php" class="flex items-center px-4 py-3 text-sm font-medium rounded-md text-gray-300 hover:bg-gray-800">
                    <i class="fas fa-user mr-3"></i>
                    User Profile
                </a>
                
                <a href="password.php" class="flex items-center px-4 py-3 text-sm font-medium rounded-md text-gray-300 hover:bg-gray-800">
                    <i class="fas fa-key mr-3"></i>
                    Change Password
                </a>
                
                <a href="logout.php" class="flex items-center px-4 py-3 text-sm font-medium rounded-md text-gray-300 hover:bg-gray-800">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Logout
                </a>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 md:ml-64">
        <!-- Top Navigation -->
        <header class="bg-cardbg shadow-sm">
            <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <h1 class="text-xl font-semibold text-gray-100">My Investments</h1>
                <div class="flex items-center space-x-4">
                    <!-- Mobile menu button -->
                    <button class="md:hidden text-gray-400 hover:text-white focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
            <div class="card p-6 mb-6">
                <h2 class="text-xl font-bold text-primary mb-4 text-center">My Investment Portfolio</h2>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th>Daily Profit</th>
                                <th>Total Profit</th>
                                <th>Activation Date</th>
                                <th>End Date</th>
                                <th>Days To End</th>
                                <th>Amount Invested</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sql = "SELECT * FROM investment WHERE email='$email' ORDER BY id DESC";
                            $result = mysqli_query($link,$sql);
                            $is_yes = 0;
                            
                            if(mysqli_num_rows($result) > 0){
                                $is_yes = 1;
                                while($row = mysqli_fetch_assoc($result)){   
                                    $pdate = $row['pdate'];
                                    $duration = $row['duration'];
                                    $increase = $row['increase'];
                                    $usd = $row['usd'];
                                    $uid = $row['id'];
                                    
                                    $date = $row['pdate'];
                                    $payday = $row['payday'];
                                    $lprofit = $row['lprofit'];
                                    $paypackage = new DateTime($payday);
                                    $payday = $paypackage->format('Y/m/d');
                                    
                                    if(isset($row['pdate']) && $row['pdate'] != '0' && isset($row['duration']) && isset($row['increase']) && isset($row['usd'])){
                                        if($row['activate'] == 0){
                                            $endpackage = new DateTime($pdate);
                                            $endpackage->modify('+ '.$duration.' day');
                                            $Date2 = $endpackage->format('Y/m/d');
                                            $days = 0;
                                        } else {
                                            $endpackage = new DateTime($pdate);
                                            $endpackage->modify('+ '.$duration.' day');
                                            $Date2 = $endpackage->format('Y/m/d');
                                            $current = date("Y/m/d");
                                            
                                            $diff = abs(strtotime($Date2) - strtotime($current));
                                            $one = 1;
                                            
                                            $date3 = new DateTime($Date2);
                                            $date3->modify('+'. $one.'day');
                                            $date4 = $date3->format('Y/m/d');
                                            
                                            $days = floor($diff / (60*60*24));
                                            $daily = $duration - $days;
                                            
                                            $one = 1;
                                            $f = date('Y-m-d', strtotime($Date2 . ' + '. $one.'day'));
                                            
                                            if(isset($days) && $days == 0 || $Date2 == (date("Y/m/d")) || (date("Y/m/d")) >= $Date2){
                                                $percentage = ($increase/100) * $duration * $usd;
                                                $allprofit = $percentage - $lprofit;
                                                $pp = $allprofit;   
                                                $ppr = $pp + $usd;
                                                
                                                $_SESSION['pprofit'] = $percentage;
                                                $sql = "UPDATE users SET walletbalance = walletbalance + $ppr, profit = profit + $pp WHERE email='$email'";
                                                $sql13 = "UPDATE investment SET activate = '0', profit = '$percentage', payday = '$current' WHERE email='$email' AND id = '$uid'";
                                                
                                                if(mysqli_query($link, $sql)){
                                                    mysqli_query($link, $sql13);
                                                    $percentage = $pp = 0;
                                                    $Date2 = 0;
                                                    $current = 0;
                                                    $duration = 0;
                                                    $days = 0;
                                                }
                                            } else {
                                                if($payday != $current){
                                                    $percentage = ($increase/100) * $daily * $usd;
                                                    $allprofit = $percentage - $lprofit;
                                                    $sql131 = "UPDATE investment SET profit = '$percentage', payday = '$current', lprofit = '$percentage' WHERE email='$email' AND id = '$uid'";
                                                    $sql21 = "UPDATE users SET walletbalance = walletbalance + $allprofit, profit = profit + $allprofit WHERE email='$email'";
                                                    mysqli_query($link, $sql131);
                                                    mysqli_query($link, $sql21);
                                                }
                                            }
                                        }
                                    }
                                    
                                    if(isset($_SESSION['pprofit'])){
                                        $profit = $_SESSION['pprofit'];
                                    } else {
                                        $profit = "";
                                    }
                                    
                                    $sql40 = "SELECT * FROM investment WHERE email='$email' AND id = '$uid'";
                                    $result40 = mysqli_fetch_assoc(mysqli_query($link,$sql40));
                                    $percentage = $result40['profit'];
                                    
                                    if(isset($result40['activate']) && $result40['activate'] == '1'){
                                        $mim = 1;
                                        $sec = '<span class="status-active"><i class="fas fa-sync-alt mr-1"></i> Active</span>';
                                    } else {
                                        $mim = 0;
                                        $sec = '<span class="status-completed"><i class="fas fa-check-circle mr-1"></i> Completed</span>';
                                    }
                            ?>
                            <tr>
                                <td><?php echo $row['increase']; ?>%</td>
                                <td>$<?php echo $percentage; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo $Date2; ?></td>
                                <td><?php echo $days; ?></td>
                                <td>$<?php echo $usd; ?></td>
                                <td><?php echo $sec; ?></td>
                            </tr>
                            <?php
                                }
                            } else {
                                $is_yes = 0;
                            }
                            ?>
                        </tbody>
                    </table>
                    
                    <?php if($is_yes == 0): ?>
                        <div class="text-center py-8 text-gray-400">
                            <i class="fas fa-wallet text-4xl mb-4"></i>
                            <p class="text-lg">You have no active investments</p>
                            <a href="packages.php" class="mt-4 inline-block px-6 py-2 bg-primary text-darkbg rounded hover:bg-yellow-600 transition">
                                Explore Investment Plans
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-cardbg py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-400 text-sm">
                &copy; 2013 - <?php echo date("Y"); ?> | Redman Finance All Rights Reserved
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.querySelector('.md\\:hidden').addEventListener('click', function() {
            document.querySelector('.fixed.inset-y-0').classList.toggle('-translate-x-full');
        });
    </script>
</body>
</html>