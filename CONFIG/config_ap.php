<?php
$server = "server10.indevfinite-server.com";
$user = "fina_ap";
$password = "!jxE*qimcyMFe#NS";
$dbname = "fina_apdb";

// Create connection
$conn = new mysqli($server, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>