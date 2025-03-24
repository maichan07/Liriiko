


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Playlist</title>
    <link href="../assets/img/llogo.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
<?php
include("../includes/headuser.php");

?>

<div id="layoutSidenav_content" style="text-align:center">
  <div  class="container-fluid">

<?php 
include("../includes/sidebar.php");
?>
    <div class="content">
    <h1>Welcome to Liriiko</h1>
    
        
    <h2>Your Playlists</h2>
        <div class="search-bar">
            <input type="text" id="search" placeholder="Search for playlists...">
        </div>


        <div class="playlist-container">
            <div class="playlist">
                <img src="../assets/img/b.jpg" alt="Playlist 1">
                <p>Chill Vibes</p>
            </div>
            <div class="playlist">
                <img src="../assets/img/l.jpg" alt="Playlist 2">
                <p>Workout Mix</p>
            </div>
            <div class="playlist">
                <img src="../assets/img/r.jpg" alt="Playlist 3">
                <p>Top Hits</p>
            </div>
            <div class="playlist">
                <img src="../assets/img/l.jpg" alt="Playlist 4">
                <p>Old School</p>
            </div>
        </div>
        </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    
</body>
</html>
<?php
include("../includes/footer.php");

?>