<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

include("connections.php");

$Email = $password1 = "";
$EmailErr = $password1Err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["email"])) {
        header("Location: loginwithotp.php?email_empty=true");
        exit();
    } else {
        $Email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            header("Location: loginwithotp.php?email_error=true");
            exit();
        }
    }

    if (empty($_POST["password"])) {
        header("Location: loginwithotp.php?password_empty=true");
        exit();
    } else {
        $password1 = $_POST["password"];
    }

    // Process login
    if ($Email && $password1) {
        $stmt = $connections->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $db_password1 = $row["password"];
            $userID = $row["id"];

            // Check password
            if (password_verify($password1, $db_password1)) {

                // Generate OTP
                $otp = random_int(10000, 99999);

                // Save OTP and OTP timestamp
                $sqlOTP = "UPDATE users SET otp = $otp WHERE email = '$Email' ";
                $otpResult = mysqli_query($connections, $sqlOTP);

              

                // Save basic session
                $_SESSION['user_id'] = $userID;
                $_SESSION['email'] = $Email;
                

                // Send OTP
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'restandfeast577@gmail.com';
                    $mail->Password = 'svafpbpttbfjeuzd';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    $mail->setFrom('restandfeast577@gmail.com', 'Reast And Feast');
                    $mail->addAddress($Email);
                    $mail->isHTML(true);
                    $mail->Subject = 'Your OTP Code';
                    $mail->Body = "
                        <h2>OTP Verification For Rest And Feast</h2>
                        <p>Your One-Time Password (OTP) is:</p>
                        <h1 style='background:#e0f2fe; padding:10px; text-align:center;'>$otp</h1>
                        <p>It expires in 5 minutes.</p>
                    ";

                    $mail->send();
                     $_SESSION['email'] = $Email;
                    header("Location: loginotp.php?otp_send=true");
                    exit();
                } catch (Exception $e) {
                    error_log("Mail error: " . $mail->ErrorInfo);
                    header("Location: loginwithotp.php?mail_error=true");
                    exit();
                }

            } else {
                header("Location: loginwithotp.php?password_error=true");
                exit();
            }

        } else {
            header("Location: loginwithotp.php?email_error=true");
            exit();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <title>Login</title>
</head>
<body>

<section class="w-full min-h-screen flex justify-center items-center bg-blue-950 p-4">
    <div class="bg-slate-200 shadow-md max-md:w-full w-1/2 min-h-96 rounded-lg flex max-md:flex-col">
        <!-- left side -->
        <div class="w-1/3 max-md:rounded-none max-md:p-4 max-md:w-full bg-sky-900 p-2 flex justify-center items-center flex-col gap-4">
            <img class="rounded-md w-40 h-40 shadow-md" src="images/logo.png" alt="Logo">
            <h1 class="font-bold text-lg text-white max-md:text-2xl">FINANCIAL</h1>
        </div>

        <!-- right side -->
        <div class="flex-1 flex justify-center items-center flex-col max-md:w-full">
            <div class="text-center max-md:mt-5">
                <h1 class="font-bold text-2xl text-black">Sign - In</h1>
            </div>
            
            <?php if (isset($_GET['mail_error']) && $_GET['mail_error'] == 'true'): ?>
            <div id="error-alert" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 w-full max-w-md" role="alert">
                Failed to send OTP email. Please try again later.
            </div>
            <script>
                setTimeout(() => {
                    document.getElementById('error-alert').style.display = 'none';
                }, 5000);
            </script>
            <?php endif; ?>
            
            <?php if (isset($_GET['db_error']) && $_GET['db_error'] == 'true'): ?>
            <div id="db-error-alert" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 w-full max-w-md" role="alert">
                Database error occurred. Please try again later.
            </div>
            <script>
                setTimeout(() => {
                    document.getElementById('db-error-alert').style.display = 'none';
                }, 5000);
            </script>
            <?php endif; ?>
            
            <form autocomplete="off" class="p-4 w-full" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="relative z-0 w-full mb-2 group">
                    <input type="email" name="email" id="floating_email"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-black peer"
                        placeholder=" " value="<?php echo htmlspecialchars($Email); ?>" required />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-sm text-black duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Email address
                    </label>
                    <?php if (!empty($EmailErr)) echo "<p class='text-red-500 text-sm mt-1'>$EmailErr</p>"; ?>
                </div>

                <div class="relative z-0 w-full mb-2 group">
                    <input type="text" name="password" id="floating_password"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-black peer"
                        placeholder=" " required />
                    <label for="floating_password"
                        class="peer-focus:font-medium absolute text-sm text-black duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Password
                    </label>
                    <?php if (!empty($password1Err)) echo "<p class='text-red-500 text-sm mt-1'>$password1Err</p>"; ?>
                </div>

                <div class="mb-5">
                    <a href="register.php" class="text-sm underline">Don't Have An Account?</a>
                </div>
                <div class="w-full">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                        Sign - In
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>