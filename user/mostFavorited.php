<?php
session_start();
include '../includes/config.php';
include '../includes/sidebar.php';

$userId = $_SESSION['userId'];

$query = "SELECT songs.*, 
                 (SELECT COUNT(*) FROM favorites WHERE favorites.songId = songs.songId) AS fav_count
          FROM songs 
          JOIN favorites ON songs.songId = favorites.songId 
          WHERE favorites.userId = ?
          ORDER BY fav_count DESC";  // Order by the most favorited songs

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Most Favorited Songs</title>
    <link rel="stylesheet" href="../styles/bootstrap.min.css">
</head>
<body style="background: url('../assets/img/bg.jpg') no-repeat center center fixed; background-size: cover;" class="bg-light">

<div class="container mt-5">
    <h3 class="text-center text-white">My Songs</h3>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                        <p class="card-text text-muted"><?php echo htmlspecialchars($row['artist']); ?></p>
                        <p><strong>Favorites:</strong> <?php echo $row['fav_count']; ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
