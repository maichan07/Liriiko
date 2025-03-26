<?php
session_start();
include '../includes/config.php'; // Database connection
include '../includes/sidebar.php'; // Sidebar
include '../includes/toast.php'; // Toast messages

// Redirect if not a user
if (!isset($_SESSION['userId']) || $_SESSION['userRole'] !== 'User') {
    header("Location: ../index.php");
    exit();
}

// Fetch songs
$query = "SELECT * FROM songs ORDER BY songId DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Music Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: url('../assets/img/bg.jpg') no-repeat center center fixed; background-size: cover;" class="bg-light">

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white" style="margin-top: 20px"> Welcome, <?php echo $_SESSION['authUser']['fullName']; ?>! </h2>
    </div>
    <h5 class="text-white"> Check everybodys song collections </h5>

    <div class="row row-cols-1 row-cols-md-3 g-4" style="margin-top: 40px">
    <?php while ($row = $result->fetch_assoc()) { ?>
    <div class="col">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title"><?php echo $row['title']; ?></h5>
                <p class="card-text text-muted"><?php echo $row['artist']; ?></p>

                <!-- Favorite Button -->
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <button class="btn btn-outline-danger favorite-btn"
                            data-song-id="<?php echo $row['songId']; ?>">
                        ❤️ Favorite
                    </button>

                    <!-- View Lyrics Button -->
                    <button class="btn btn-primary" 
                            data-title="<?php echo htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8'); ?>" 
                            data-artist="<?php echo htmlspecialchars($row['artist'], ENT_QUOTES, 'UTF-8'); ?>" 
                            data-lyrics="<?php echo htmlspecialchars($row['lyrics'], ENT_QUOTES, 'UTF-8'); ?>"
                            onclick="showLyrics(this)">
                        View Lyrics
                    </button>

                </div>

            </div>
        </div>
    </div>
<?php } ?>
    </div>
</div>

<!-- Lyrics Modal -->
<div class="modal fade" id="lyricsModal" tabindex="-1" aria-labelledby="lyricsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lyricsTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 id="lyricsArtist" class="text-muted"></h6>
                <p id="lyricsText"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Lyric fetcher  -->
<script>
    function showLyrics(button) {
    let title = button.getAttribute("data-title");
    let artist = button.getAttribute("data-artist");
    let lyrics = button.getAttribute("data-lyrics");

    document.getElementById('lyricsTitle').innerText = title;
    document.getElementById('lyricsArtist').innerText = artist;
    document.getElementById('lyricsText').innerHTML = lyrics.replace(/\n/g, "<br>");

    new bootstrap.Modal(document.getElementById('lyricsModal')).show();
}

</script>
<!-- Favorite Interaction  -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".favorite-btn").forEach(button => {
        button.addEventListener("click", function (event) {
            let songId = this.getAttribute("data-song-id");
            let button = event.target;

            fetch("favorite_song.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "songId=" + songId
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    if (data.favorited) {
                        button.classList.add("btn-danger");
                        button.classList.remove("btn-outline-danger");
                        button.innerText = "❤️ Favorited";
                    } else {
                        button.classList.add("btn-outline-danger");
                        button.classList.remove("btn-danger");
                        button.innerText = "❤️ Favorite";
                    }
                } else {
                    alert("Failed to favorite the song.");
                }
            });
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
