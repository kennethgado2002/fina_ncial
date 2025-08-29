<?php
$server = "server10.indevfinite-server.com";
$user = "fina_generalledger";
$password = "D!5#vBQYaeaJju@A";
$dbname = "fina_generalledgerdb";

// Create connection
$conn = new mysqli($server, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>