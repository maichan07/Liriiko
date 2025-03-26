<?php
session_start();
include '../includes/config.php';
include '../includes/sidebar.php';
include '../includes/toast.php';

if (!isset($_SESSION['userId']) || $_SESSION['userRole'] !== 'Admin') {
    header("Location: ../index.php");
    exit();
}

// Handle feedback deletion
if (isset($_GET['delete'])) {
    $feedbackId = intval($_GET['delete']);
    $conn->query("DELETE FROM feedback WHERE feedbackId = $feedbackId");
    $_SESSION['message'] = "Feedback deleted successfully!";
    $_SESSION['code'] = "success";
    header("Location: ../feedback.php");
    exit();
}

// Handle status update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $feedbackId = intval($_POST['feedbackId']);
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE feedback SET status = ? WHERE feedbackId = ?");
    $stmt->bind_param("si", $status, $feedbackId);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Feedback status updated!";
        $_SESSION['code'] = "success";
    } else {
        $_SESSION['message'] = "Failed to update feedback status.";
        $_SESSION['code'] = "danger";
    }

    $stmt->close();
    header("Location: feedback.php");
    exit();
}

// Fetch feedback with status
$result = $conn->query("SELECT feedback.feedbackId, users.firstName, feedback.message, feedback.created_at, feedback.status 
                        FROM feedback 
                        JOIN users ON feedback.userId = users.userId 
                        ORDER BY feedback.created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: url('../assets/img/bg.jpg') no-repeat center center fixed; background-size: cover;">

<div class="container mt-5">
    <div class="card shadow-lg bg-dark text-white">
        <div class="card-header text-center">
            <h2>User Feedback</h2>
        </div>
        <div class="card-body">
            <table class="table table-dark table-hover text-center">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['firstName']); ?></td>
                            <td><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
                            <td><?php echo date("F j, Y, g:i A", strtotime($row['created_at'])); ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="feedbackId" value="<?php echo $row['feedbackId']; ?>">
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="New" <?php if ($row['status'] == 'New') echo 'selected'; ?>>New</option>
                                        <option value="Reviewed" <?php if ($row['status'] == 'Reviewed') echo 'selected'; ?>>Reviewed</option>
                                        <option value="Resolved" <?php if ($row['status'] == 'Resolved') echo 'selected'; ?>>Resolved</option>
                                    </select>
                                    <input type="hidden" name="update_status" value="1">
                                </form>
                            </td>
                            <td>
                                <a href="?delete=<?php echo $row['feedbackId']; ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Are you sure you want to delete this feedback?');">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
