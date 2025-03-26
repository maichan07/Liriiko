<?php
session_start();
include '../includes/config.php'; // Ensure this defines $conn

// Check if user is logged in
if (!isset($_SESSION['userId'])) {
    header("Location: ../index.php");
    exit();
}

$userId = $_SESSION['userId'];

// Fetch songs
$query = "SELECT * FROM songs WHERE userId = ? ORDER BY songId DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

// Handle song addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_song'])) {
    $title = trim($_POST['title']);
    $artist = trim($_POST['artist']);
    $lyrics = trim($_POST['lyrics']);

    if (!empty($title) && !empty($artist) && !empty($lyrics)) {
        $query = "INSERT INTO songs (title, artist, lyrics, userId) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $title, $artist, $lyrics, $userId);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Song added successfully!";
            $_SESSION['code'] = "success";
        } else {
            $_SESSION['message'] = "Error adding song!";
            $_SESSION['code'] = "danger";
        }
    } else {
        $_SESSION['message'] = "All fields are required!";
        $_SESSION['code'] = "warning";
    }
    
    header("Location: index.php");
    exit();
}
?>
