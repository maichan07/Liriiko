<?php
session_start();
include("../includes/config.php");

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

<?php
include("../includes/headuser.php");

?>
    <div>

    <div id="layoutSidenav_content" style="text-align:center">
      <div  class="container-fluid">

    <?php 
    include("../includes/sidebar.php");
    ?>
    
    <div class="content">
        <h1>Welcome to Liriiko</h1>
        <p>Your personalized music dashboard</p>
        <p  style="font-size:20px; font-weight:bold;">
       Hello  <?php 
       if(isset($_SESSION['email'])){
        $email=$_SESSION['email'];
        $query=mysqli_query($conn, "SELECT liriikouser.* FROM `liriikouser` WHERE liriikouser.email='$email'");
        while($row=mysqli_fetch_array($query)){
            echo $row['firstName'].' '.$row['lastName'];
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
        <div class="playlist-container">
            <div class="playlist">
                <img src="../assets/img/b.jpg" alt="Playlist 1">
                <p>Chill Vibes</p>
            
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

<?php
include("../includes/footer.php");

?>