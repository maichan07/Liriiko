<?php
session_start();
include("../includes/config.php"); // Ensure this contains your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure user is logged in
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error'] = "You must be logged in to submit lyrics.";
        header("Location: index.php"); // Redirect to login page
        exit();
    }

    $user_id = $_SESSION['user_id']; // Get logged-in user ID
    $artist = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['artist']));
    $songTitle = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['songTitle']));
    $lyrics = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['lyrics']));

    // Insert into database
    $query = "INSERT INTO lyrics (user_id, title, artist, lyrics) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "isss", $user_id, $songTitle, $artist, $lyrics);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            $_SESSION['message'] = "Lyrics added successfully!";
            header("Location: homepage.php"); // Redirect to display lyrics page
            exit();
        } else {
            $_SESSION['error'] = "Error adding lyrics. Please try again.";
            header("Location: lyrics.php"); // Redirect back to form
            exit();
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['error'] = "Database error. Please try again.";
        header("Location: lyrics.php"); // Redirect back to form
        exit();
    }

    mysqli_close($conn);
} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: lyrics.php"); // Redirect back to form
    exit();
}
?>
