<?php
session_start();
print_r($_SESSION); 
include("../includes/config.php");

// Check if database connection is set
if (!isset($conn)) {
    die("Database connection error.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="../assets/img/llogo.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include("../includes/headuser.php"); ?>

<div>
    <div id="layoutSidenav_content" style="text-align:center">
        <div class="container-fluid">
            <?php include("../includes/sidebar.php"); ?>

            <div class="content">
                <h1>Welcome to Liriiko</h1>
                <p>Your personalized music dashboard</p>
                <p style="font-size:20px; font-weight:bold;">
                    Hello  
                    <?php 
                    if (isset($_SESSION['email'])) {
                        $email = $_SESSION['email'];
                        $query = mysqli_query($conn, "SELECT firstName, lastName FROM liriikouser WHERE email='$email'");
                        if ($row = mysqli_fetch_assoc($query)) {
                            echo htmlspecialchars($row['firstName'] . ' ' . $row['lastName']);
                        }
                    }
                    ?>
                </p>
                <button class="btn add-btn" onclick="window.location.href='./lyrics.php';"> Add Song Lyrics</button>
                <br>

                <div class="search-bar">
                    <input type="text" id="search" placeholder="Search for song lyrics...">
                </div>

                <h2>Sing along with your favorite music</h2>

                <!-- Retrieving lyrics data from the database -->
                <?php
                $lyricsQuery = mysqli_query($conn, "SELECT lyrics.song_id, lyrics.title, lyrics.artist, liriikouser.firstName, liriikouser.lastName 
                                                    FROM lyrics 
                                                    JOIN liriikouser ON lyrics.user_id = liriikouser.id 
                                                    ORDER BY lyrics.song_id DESC");
                ?>

                <div class="playlist-container">
                    <?php
                    while ($row = mysqli_fetch_assoc($lyricsQuery)) {
                        if (!isset($row['song_id'])) {
                            continue; // Skip if song_id is missing
                        }

                        echo "<a href='../user/view_lyrics.php?song_id=" . urlencode($row['song_id']) . "' style='text-decoration: none;'>
                                <div class='song-card'>
                                    <div class='song-info' style='
                                        background: linear-gradient(to right, rgb(1, 18, 50), #1E3A8A); 
                                        color: white; 
                                        padding: 15px; 
                                        border-radius: 8px; 
                                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                        width: 100%;
                                        max-width: 300px;
                                        transition: transform 0.2s ease-in-out;
                                        ' 
                                        onmouseover='this.style.transform=\"scale(1.05)\"' 
                                        onmouseout='this.style.transform=\"scale(1)\"'>
                                        <h3 style='margin: 0 0 10px 0; font-size: 18px;'>" . htmlspecialchars($row['title']) . "</h3>
                                        <p style='margin: 5px 0; font-size: 14px;'>Artist: " . htmlspecialchars($row['artist']) . "</p>
                                        <p style='margin: 5px 0; font-size: 14px;'>Uploaded by: " . htmlspecialchars($row['firstName'] . ' ' . $row['lastName']) . "</p>
                                    </div>
                                </div>
                              </a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>

</body>
</html>

<?php include("../includes/footer.php"); ?>
