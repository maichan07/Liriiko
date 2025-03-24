<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Song Lyrics</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="../assets/img/llogo.png" rel="icon">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/lyrics.css">
</head>

<body>
<?php
include("../includes/headuser.php");

?>
    <div class="container">
        <h2>Add Song Lyrics</h2>
        <form id="lyricsForm" action="save_lyrics.php" method="POST">
            <div class="input-group">
                <label for="artist">Original Singer:</label>
                <input type="text" id="artist" name="artist" placeholder="Enter artist name" required>
            </div>
            <div class="input-group">
                <label for="songTitle">Song Title:</label>
                <input type="text" id="songTitle" name="songTitle" placeholder="Enter song title" required>
            </div>
            <div class="input-group">
                <label for="lyrics">Lyrics:</label>
                <textarea id="lyrics" name="lyrics" placeholder="Enter lyrics here..." required></textarea>
            </div>
            
            <button type="submit" class="btn add-btn">Save</button>
        </form>
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
