<?php
session_start();
include '../includes/config.php'; 
include '../includes/sidebar.php';
include '../includes/toast.php'; 

// Redirect if not a user
if (!isset($_SESSION['userId']) || $_SESSION['userRole'] !== 'User') {
    header("Location: ../index.php");
    exit();
}

$userId = $_SESSION['userId'];  
$query = "SELECT * FROM songs WHERE userId = ? ORDER BY songId DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
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
        <h2 class="text-white" style="margin-top: 20px "> Share your music with us, <?php echo $_SESSION['authUser']['fullName']; ?>! </h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSongModal">+ Add Music</button>
    </div>

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

                    <!-- Edit Lyrics Button -->
                    <button class="btn btn-warning" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editLyricsModal"
                            data-song-id="<?php echo $row['songId']; ?>"
                            data-title="<?php echo htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8'); ?>" 
                            data-artist="<?php echo htmlspecialchars($row['artist'], ENT_QUOTES, 'UTF-8'); ?>" 
                            data-lyrics="<?php echo htmlspecialchars($row['lyrics'], ENT_QUOTES, 'UTF-8'); ?>"
                            onclick="editLyrics(this)">
                        ✏️ Edit Lyrics
                    </button>
                </div>

            </div>
        </div>
    </div>
<?php } ?>
    </div>
</div>

<!-- Edit Lyrics Modal -->
<div class="modal fade" id="editLyricsModal" tabindex="-1" aria-labelledby="editLyricsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLyricsModalLabel">Edit Lyrics</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="update_lyrics.php">
                <div class="modal-body">
                    <input type="hidden" name="songId" id="editSongId">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" id="editTitle" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Artist</label>
                        <input type="text" id="editArtist" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lyrics</label>
                        <textarea name="lyrics" id="editLyrics" class="form-control" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update_lyrics" class="btn btn-success">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Add Music Modal -->
<div class="modal fade" id="addSongModal" tabindex="-1" aria-labelledby="addSongModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSongModalLabel">Add New Music</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="add_song.php">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Artist</label>
                        <input type="text" name="artist" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lyrics</label>
                        <textarea name="lyrics" class="form-control" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="add_song" class="btn btn-success">Add Song</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
 document.addEventListener("DOMContentLoaded", function () {
    var editLyricsModal = document.getElementById("editLyricsModal");
    
    editLyricsModal.addEventListener("show.bs.modal", function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var songId = button.getAttribute("data-song-id");
        var title = button.getAttribute("data-title");
        var artist = button.getAttribute("data-artist");
        var lyrics = button.getAttribute("data-lyrics");

        // Populate the modal fields
        document.getElementById("editSongId").value = songId;
        document.getElementById("editTitle").value = title;
        document.getElementById("editArtist").value = artist;
        document.getElementById("editLyrics").value = lyrics; // Set lyrics inside textarea
    });
});

</script>

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
