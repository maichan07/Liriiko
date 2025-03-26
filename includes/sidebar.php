<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<div class="d-flex">
    <!-- Sidebar (Fixed for Large Screens) -->
    <div class="d-none d-md-block bg-transparent text-white vh-100 p-3" style="width: 250px; position: fixed;">
        <h4 class="fw-bold">Liriiko's</h4>
        <ul class="nav flex-column">
            <?php if ($_SESSION['userRole'] == 'Admin'): ?> 
                <li class="nav-item"><a class="nav-link text-white" href="../admin/index.php"><i class="bi bi-house"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="../admin/allSongs.php"><i class="bi bi-box2-fill"></i> Songs</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="../admin/users.php"><i class="bi bi-people"></i> Users</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="../admin/feedback.php"><i class="bi bi-cart"></i> User Feedbacks</a></li>
                <li class="nav-item"><a class="btn btn-danger w-100 mt-3" href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link text-white" href="../user/index.php"><i class="bi bi-house"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="../user/addMusic.php"><i class="bi bi-music-note-list"></i> Add Music</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="../user/mostFavorited.php"><i class="bi bi-person"></i> Favorite</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="../user/feedback.php"><i class="bi bi-person"></i> Send a Feedback</a></li>
                <li class="nav-item"><a class="btn btn-danger w-100 mt-3" href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Mobile Sidebar (Collapsible) -->
    <nav class="navbar navbar-light bg-light d-md-none w-100">
        <button class="btn btn-outline-dark m-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
            <i class="bi bi-list"></i> Menu
        </button>
    </nav>

    <div class="offcanvas offcanvas-start bg-light text-dark" tabindex="-1" id="mobileSidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title fw-bold">Liriiko's</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                <?php if ($_SESSION['userRole'] == 'Admin'): ?> 
                    <li class="nav-item"><a class="nav-link" href="../admin/index.php"><i class="bi bi-house"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="../admin/inventory.php"><i class="bi bi-box2-fill"></i> Inventory</a></li>
                    <li class="nav-item"><a class="nav-link" href="../admin/orders.php"><i class="bi bi-cart"></i> Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="../admin/users.php"><i class="bi bi-people"></i> Users</a></li>
                    <li class="nav-item"><a class="btn btn-danger w-100 mt-3" href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="../user/index.php"><i class="bi bi-house"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="../user/addMusic.php"><i class="bi bi-music-note-list"></i> Add Music</a></li>
                    <li class="nav-item"><a class="nav-link" href="../user/manage.php"><i class="bi bi-person"></i> Profile</a></li>
                    <li class="nav-item"><a class="btn btn-danger w-100 mt-3" href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
