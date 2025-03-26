<?php
session_start();
include '../includes/config.php';

if (!isset($_SESSION['userId'])) {
    echo json_encode(["status" => "error", "message" => "Not logged in"]);
    exit();
}

$userId = $_SESSION['userId'];
$songId = $_POST['songId'];

// Check if the song is already favorited
$checkQuery = "SELECT * FROM favorites WHERE userId = ? AND songId = ?";
$stmt = $conn->prepare($checkQuery);
$stmt->bind_param("ii", $userId, $songId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Remove from favorites
    $deleteQuery = "DELETE FROM favorites WHERE userId = ? AND songId = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("ii", $userId, $songId);
    $stmt->execute();

    echo json_encode(["status" => "success", "favorited" => false]);
} else {
    // Add to favorites
    $insertQuery = "INSERT INTO favorites (userId, songId) VALUES (?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ii", $userId, $songId);
    $stmt->execute();

    echo json_encode(["status" => "success", "favorited" => true]);
}
?>
