<?php
session_start();
if (isset($_SESSION["id"])) {
    header("Location: NAV/dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <link rel="icon" type="image" href="ASSETS/img/ILEARN LOGO.png">
    <link rel="stylesheet" href="ASSETS/css/indexs.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<script>alert("' . htmlspecialchars($_SESSION['message']) . '");</script>';
        unset($_SESSION['message']); }
    ?>  
        <div class="container">
            <div class="left">
                <img src="ASSETS/img/BCP LOGO.png" alt="Logo" class="logo">
                <h2>Sign in</h2>
                <?php if (isset($_SESSION['error'])) {
                    echo '<div class="error-message">' . htmlspecialchars($_SESSION['error']) . '</div>';
                    unset($_SESSION['error']); } ?> 
                <form method="POST" action="SETTINGS/login.php">
                    <label for="username">Username *</label>
                    <input type="text" id="username" name="username" required>
                    <label for="password">Password *</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" required>
                        <span class="toggle-password">
                            <img src="https://img.icons8.com/ios-filled/50/000000/hide.png" alt="Toggle Password Visibility">
                        </span>
                    </div>
                    <a href="SETTINGS/forgot_pass.php" class="forgot-password">Forgot Password?</a>
                    <button type="submit">Sign in</button>
                </form>
            </div>
            <div class="right">
                <img src="ASSETS/img/ILEARN LOGO.png" alt="Logo" class="logo1">
                <div class="h2t"><h2>Integrating LMS and SMS:</h2>
                <h3>Optimizing Education Management</h3></div><br>
                <a href="https://bcp-admissions.elearningcommons.com/online-admission">Student admission click here</a>
            </div>
        </div>
        <script src="ASSETS/script.js"></script>
</body>
</html>