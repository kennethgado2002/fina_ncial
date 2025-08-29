<?php
$server = "server10.indevfinite-server.com";
$user = "fina_ncial";
$password = "o5z!dtAeU3y6H@xD";
$dbname = "fina_ncialdb";

// Create connection
$conn = new mysqli($server, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>