<?php
session_start();
include '../includes/config.php';
include '../includes/sidebar.php';
include '../includes/toast.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    $userId = $_SESSION['userId'];
    $message = trim($_POST['message']);

    if (!empty($message)) {
        $stmt = $conn->prepare("INSERT INTO feedback (userId, message) VALUES (?, ?)");
        $stmt->bind_param("is", $userId, $message);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Feedback submitted successfully!";
            $_SESSION['code'] = "success";
        } else {
            $_SESSION['message'] = "Failed to submit feedback.";
            $_SESSION['code'] = "danger";
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = "Feedback cannot be empty!";
        $_SESSION['code'] = "warning";
    }

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Feedback</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('../assets/img/bg.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .feedback-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 15px;
            max-width: 500px;
        }
        .mid-container{
            margin-top: 10%;
        }
    </style>
</head>
<body>

    <div class="container text-center mid-container">
        <div class="feedback-container mx-auto">
            <h2 class="mb-4">Submit Feedback</h2>
            <form method="POST">
                <div class="mb-3">
                    <textarea name="message" class="form-control" rows="5" placeholder="Write your feedback here..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">Submit</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
