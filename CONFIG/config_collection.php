<?php
$server = "server10.indevfinite-server.com";
$user = "fina_collection";
$password = "^fe0a!PlVg4aEjRPa";
$dbname = "fina_collectiondb";

// Create connection
$conn = new mysqli($server, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>