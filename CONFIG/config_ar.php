<?php
$server = "server10.indevfinite-server.com";
$user = "fina_ar";
$password = "IlAFtAVt^VlefkeX";
$dbname = "fina_ardb";

// Create connection
$conn = new mysqli($server, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>