<?php
session_start();
include '../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_lyrics'])) {
    $songId = $_POST['songId'];
    $updatedLyrics = trim($_POST['lyrics']);

    if (!empty($songId) && !empty($updatedLyrics)) {
        $query = "UPDATE songs SET lyrics = ? WHERE songId = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $updatedLyrics, $songId);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Lyrics updated successfully!";
            $_SESSION['code'] = "success";
        } else {
            $_SESSION['message'] = "Error updating lyrics!";
            $_SESSION['code'] = "danger";
        }
    } else {
        $_SESSION['message'] = "Lyrics cannot be empty!";
        $_SESSION['code'] = "warning";
    }
}
header("Location: index.php");
exit();
?>
