<?php
session_start();
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check credentials in the users table
    $sql = "SELECT id, username, password, role_id, emp_id FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($password === $row["password"]) { // Password is NOT hashed
            $_SESSION["id"] = $row["id"];
            $_SESSION["role_id"] = $row["role_id"];
            $_SESSION["emp_id"] = $row["role_id"];

            // Redirect to a unified dashboard
            $_SESSION['message'] = "Succesfully logged in.";
            header("Location: ../PANEL/");
            exit();
        } else {
            $_SESSION['error'] = "Invalid username or password.";
            header("Location: ../");
            exit();
        }
    } else {
        $_SESSION['error'] = "User not found.";
        header("Location: ../");
            exit();
    }
}
?>