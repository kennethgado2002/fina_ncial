<?php
session_start();
include "../SETTINGS/config.php";
include "panel.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../ASSETS/css/users.css">
</head>
<body>
    <section class="home-section">
        <div class="text"><?= htmlspecialchars($role_name) ?> Dashboard</div>
        <div class="dashboard-content">
            <div class="row">
                <div class="column">
                    <div class="card">
                        <h3>Total of Registrar Accounts:</h3>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <h3>Total of Cashier Accounts:</h3>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <h3>Total of Instructor Accounts:</h3>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <h3>Total of Students Accounts:</h3>
                    </div>
                </div>                
            </div>
            <div class="info-section">
                <h3>Announcements:</h3>
            </div>
            
        </div>
    </section>
</body>
</html>