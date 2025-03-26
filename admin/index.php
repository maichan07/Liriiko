<?php
    include '../includes/sidebar.php'; 
    include '../includes/config.php';
    include '../includes/toast.php';
    include '../auth/adminAuth.php';

    // Fetch total songs
    $query = "SELECT COUNT(*) AS total_songs FROM songs";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $total_songs = $row['total_songs'];

    // Fetch total users
    $query = "SELECT COUNT(*) AS total_users FROM users";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $total_users = $row['total_users'];

    // Fetch admin name
    $userId = $_SESSION['userId'] ?? null;
    if ($userId) {
        $query = "SELECT firstName FROM users WHERE userId = '$userId' LIMIT 1";
        $result = mysqli_query($conn, $query);
        $admin = mysqli_fetch_assoc($result);
        $first_name = $admin['firstName'] ?? 'Admin';
    } else {
        $first_name = 'Admin';
    }

    // Fetch most favorited songs
    $query = "
        SELECT s.songId, s.title, s.artist, COUNT(f.favId) AS favorite_count 
        FROM songs s
        LEFT JOIN favorites f ON s.songId = f.songId
        GROUP BY s.songId
        ORDER BY favorite_count DESC
        LIMIT 3"; // Get top 5 most favorited songs

    $most_favorited_result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CJ's Online Shop - Admin Panel</title>
    <link rel="icon" href="../assets/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <style>
        body {
            background: url('../assets/img/bg.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .dashboard-container {
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card {
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="dashboard-container text-center">
        <h2 class="mb-3">Welcome, <?php echo htmlspecialchars($first_name); ?>!</h2>
        <p class="text-muted">Manage your shop's inventory, orders, and users.</p>

        <div class="row justify-content-center mt-4">
            <div class="col-sm-6 col-md-4">
                <div class="card text-white bg-danger mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title">Total Songs Uploaded</h5>
                        <p class="display-5 fw-bold"><?php echo $total_songs; ?></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="card text-white bg-secondary mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="display-5 fw-bold"><?php echo $total_users; ?></p>
                    </div>
                </div>
            </div>
        </div> 
        
        <!-- Most Favorited Songs Section -->
        <h3 class="mt-5">Most Favorited Songs</h3>
        <div class="row justify-content-center mt-3">
            <?php while ($song = mysqli_fetch_assoc($most_favorited_result)) { ?>
                <div class="col-md-6">
                    <div class="card mb-3 shadow">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo htmlspecialchars($song['title']); ?></h5>
                            <p class="card-text text-muted">Artist: <?php echo htmlspecialchars($song['artist']); ?></p>
                            <p class="text-danger">❤️ <?php echo $song['favorite_count']; ?> Favorites</p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
