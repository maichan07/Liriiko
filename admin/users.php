<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CJ's Online Shop - Users</title>
    <link rel="icon" href="../assets/img/favicon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: url('../assets/img/bg.jpg') no-repeat center center fixed; background-size: cover;" class="bg-light">

<?php
include '../includes/config.php';
include '../includes/sidebar.php';
include '../includes/toast.php';
include '../auth/adminAuth.php';

// Fetch users
$query = "SELECT `userId`, `firstName`, `lastName`, `email` FROM `users`";
$result = mysqli_query($conn, $query);
?>

<div class="container pt-5">
    <div class="card shadow-lg bg-dark text-white">
        <div class="card-header text-center">
            <h2>Users List</h2>
        </div>
        <div class="card-body">
            <table class="table table-dark table-hover text-center">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['userId']; ?></td>
                            <td><?php echo htmlspecialchars($row['firstName'] . ' ' . $row['lastName']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
