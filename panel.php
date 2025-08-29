<?php
include "../SETTINGS/config.php";

// Restrict access if not logged in
if (!isset($_SESSION["id"])) {
    header("Location: ../index.php");
    exit();
}

// Fetch role name from the database
$role_id = $_SESSION["role_id"];
$sql = "SELECT role_name FROM roles WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $role_id);
$stmt->execute();
$result = $stmt->get_result();
$role_name = ($result->num_rows > 0) ? $result->fetch_assoc()['role_name'] : "Unknown";

// Fetch username
$id = $_SESSION["id"];
$sql = "SELECT username FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$username = ($result->num_rows > 0) ? $result->fetch_assoc()['username'] : "Unknown";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image" href="../ASSETS/img/ILEARN LOGO.png">
    <link rel="stylesheet" href="../ASSETS/css/dashboards.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .nav-list::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
        <img src="../ASSETS/img/ILEARN LOGO.png" alt="Logo" class="icon">
            <div class="logo_name"><?= htmlspecialchars($role_name) ?> Panel</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list" style="overflow-y: auto; max-height: 80vh; scrollbar-width: none; -ms-overflow-style: none;">
            <li style="display: <?= ($role_id == 1 || $role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 5) ? 'block' : 'none' ?>;">
            <a href="dashboard.php">
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
            </li>
            <li style="display: <?= ($role_id == 1 || $role_id == 2) ? 'block' : 'none' ?>;">
            <a href="users.php">
                <i class='bx bx-user'></i>
                <span class="links_name">Users</span>
            </a>
            <span class="tooltip">Users</span>
            </li>
            <li style="display: <?= ($role_id == 1 || $role_id == 2) ? 'block' : 'none' ?>;">
            <a href="program.php">
                <i class='bx bxs-graduation'></i>
                <span class="links_name">Programs</span>
            </a>
            <span class="tooltip">Programs</span>
            </li>
            <li style="display: <?= ($role_id == 4 || $role_id == 5) ? 'block' : 'none' ?>;">
            <a href="profile.php">
                <i class='bx bx-user'></i>
                <span class="links_name">Profile</span>
            </a>
            <span class="tooltip">Profile</span>
            </li>
            <li style="display: <?= ($role_id == 1 || $role_id == 2 || $role_id == 4) ? 'block' : 'none' ?>;">
            <a href="section.php">
                <i class='bx bx-book-alt'></i>
                <span class="links_name">Sections</span>
            </a>
            <span class="tooltip">Sections</span>
            </li>
            <li style="display: <?= ($role_id == 1 || $role_id == 2) ? 'block' : 'none' ?>;">
            <a href="courses.php">
                <i class='bx bx-book'></i>
                <span class="links_name">Courses</span>
            </a>
            <span class="tooltip">Courses</span>
            </li>
            <li style="display: <?= ($role_id == 4) ? 'block' : 'none' ?>;">
            <a href="courses-i.php">
                <i class='bx bx-book'></i>
                <span class="links_name">Courses</span>
            </a>
            <span class="tooltip">Courses</span>
            </li>
            <li style="display: <?= ($role_id == 1 || $role_id == 5) ? 'block' : 'none' ?>;">
            <a href="enrollment.php">
                <i class='bx bx-user-pin'></i>
                <span class="links_name">Enrollment</span>
            </a>
            <span class="tooltip">Enrollment</span>
            </li>
            <li style="display: <?= ($role_id == 1 || $role_id == 2 || $role_id == 3) ? 'block' : 'none' ?>;">
            <a href="stud_list.php">
                <i class='bx bx-user-circle'></i>
                <span class="links_name">Student List</span>
            </a>
            <span class="tooltip">Student List</span>
            </li>
            <li style="display: <?= ($role_id == 1 || $role_id == 3) ? 'block' : 'none' ?>;">
            <a href="transaction.php">
                <i class='bx bx-wallet-alt'></i>
                <span class="links_name">Transactions</span>
            </a>
            <span class="tooltip">Transactions</span>
            </li>
            <li style="display: <?= ($role_id == 5) ? 'block' : 'none' ?>;">
            <a href="acc_statement.php">
                <i class='bx bx-wallet'></i>
                <span class="links_name">Account Statement</span>
            </a>
            <span class="tooltip">Account Statement</span>
            </li>
            <li style="display: <?= ($role_id == 5) ? 'block' : 'none' ?>;">
            <a href="permit.php">
                <i class='bx bx-receipt'></i>
                <span class="links_name">Permit</span>
            </a>
            <span class="tooltip">Permit</span>
            </li>
            <li style="display: <?= ($role_id == 1 || $role_id == 5) ? 'block' : 'none' ?>;">
            <a href="module_grant.php">
                <i class='bx bx-file'></i>
                <span class="links_name">Module Grant</span>
            </a>
            <span class="tooltip">Module Grant</span>
            </li>
            <li style="display: <?= ($role_id == 5) ? 'block' : 'none' ?>;">
            <a href="courses-s.php">
                <i class='bx bx-book'></i>
                <span class="links_name">Courses</span>
            </a>
            <span class="tooltip">Courses</span>
            </li>
            <li style="display: <?= ($role_id == 1 || $role_id == 5) ? 'block' : 'none' ?>;">
            <a href="lms_subjects.php">
                <i class='bx bx-folder'></i>
                <span class="links_name">LMS Subjects</span>
            </a>
            <span class="tooltip">LMS Subjects</span>
            </li>
            <li style="display: <?= ($role_id == 1 || $role_id == 5) ? 'block' : 'none' ?>;">
            <a href="sem_grades.php">
                <i class='bx bx-folder-open'></i>
                <span class="links_name">Semestral Grade</span>
            </a>
            <span class="tooltip">Semestral Grade</span>
            </li>
            <li class="profile">
            <div class="profile-details">
                <img src="../ASSETS/img/profile.jpg" alt="profileImg">
                <div class="name_job">
                <div class="name"><?= htmlspecialchars($username) ?></div>
                <div class="job"><?= htmlspecialchars($role_name) ?></div>
                </div>
            </div>
            <a href="../SETTINGS/logout.php"><i class='bx bx-log-out' id="log_out"></i></a>
            </li>
        </ul>
    </div>
    <script src="../ASSETS/js/dashboard.js"></script>
</body>
</html>