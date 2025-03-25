<?php
session_start();
include("../includes/config.php"); // Ensure this file initializes $conn

if (!isset($_GET['song_id'])) {
    echo "Invalid song selection.";
    exit;
}

$song_id = intval($_GET['song_id']); // Get song_id safely

// Fetch the specific song's data
$query = "SELECT lyrics.title, lyrics.artist, lyrics.lyrics, lyrics.created_at, 
                 liriikouser.firstName, liriikouser.lastName 
          FROM lyrics 
          JOIN liriikouser ON lyrics.user_id = liriikouser.id 
          WHERE lyrics.song_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $song_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$song = mysqli_fetch_assoc($result);

if (!$song) {
    echo "Song not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($song['title']); ?></title>
    <link href="../assets/img/llogo.png" rel="icon">
    <link href="css/styles.css" rel="stylesheet">
    <link href="../assets/css/dashboard.css" rel="stylesheet">
</head>
<body>
<?php include("../includes/headuser.php"); ?>

<div id="layoutSidenav_content" style="text-align:center">
    <div class="main-content">

    <?php 
    include("../includes/sidebar.php");
    ?>
        <h2><?php echo htmlspecialchars($song['title']); ?></h2>
        <p><strong>Artist:</strong> <?php echo htmlspecialchars($song['artist']); ?></p>
        <p><strong>Posted by:</strong> <?php echo htmlspecialchars($song['firstName'] . ' ' . $song['lastName']); ?></p>
        <p><strong>Date Created:</strong> <?php echo htmlspecialchars($song['created_at']); ?></p>
        <hr>
        <p style="white-space: pre-line; display: flex; text-align: center; width: 50%; margin: auto;"><?php echo nl2br(htmlspecialchars($song['lyrics'])); ?></p>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
</body>
</html>
