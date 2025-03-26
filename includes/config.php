<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link rel="icon" href="assets/img/favicon.png" type="image/png">




<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = null; // Default to null if not set
}

// Database Configuration
$host = "localhost";  
$dbname = "bombeo_boneo";
$username = "root";  
$password = "";  

$conn = mysqli_connect($host, $username, $password, $dbname);

// Check Connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}?>
