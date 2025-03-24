<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Playlist</title>
    <link href="../assets/img/llogo.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include("../includes/headuser.php"); ?>

<div id="layoutSidenav_content">
    <div class="container-fluid mt-4">
        <?php include("../includes/sidebar.php"); ?>

        <!-- Playlist Section -->
        <div class="container mt-4">
            <div class="playlist-container d-flex justify-content-center">
                <!-- Add Playlist Box -->
                <div class="playlist card bg-dark text-center p-3">
                    <h4 class="text-white">Create a Playlist</h4>
                    <button class="play-btn"><i class="fas fa-plus"></i> Add Playlist</button>
                </div>

                <!-- Liked Lyrics Box -->
                <div class="playlist card bg-dark p-3">
                    <h4 class="text-white"><i class="fas fa-heart"></i> Liked Lyrics</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-dark text-white">Song Title 1 - Artist</li>
                        <li class="list-group-item bg-dark text-white">Song Title 2 - Artist</li>
                        <li class="list-group-item bg-dark text-white">Song Title 3 - Artist</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include("../includes/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
