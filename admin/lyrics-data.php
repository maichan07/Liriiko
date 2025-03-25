<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Song Library - Liriiko Admin</title>
        <link href="../assets/img/llogo.png" rel="icon">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php include("../includes/head.php"); ?>
        
        <div id="layoutSidenav">
        <?php include("../includes/sidenav.php"); ?>
        <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Song Library
                            </div>
                            <div class="card-body">

                            <?php
                            // Include database connection
                            include("../includes/config.php");

                            // Fetch all lyrics along with user details
                            $query = "SELECT lyrics.*, liriikouser.firstName, liriikouser.lastName 
                                    FROM lyrics 
                                    JOIN liriikouser ON lyrics.user_id = liriikouser.id 
                                    ORDER BY lyrics.created_at DESC"; 

                            $result = mysqli_query($conn, $query);
                            ?>

                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Artist Name</th>
                                        <th>Posted by</th>
                                        <th>Created at</th>
                                        <th>Lyrics</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // Check if 'content' exists, otherwise use the correct column name
                                        $lyricsText = isset($row['content']) ? $row['content'] : (isset($row['lyrics_text']) ? $row['lyrics_text'] : '');
                                    
                                        // Extract first 20 words
                                        $lyricsExcerpt = implode(' ', array_slice(explode(' ', $lyricsText), 0, 20)) . '...';
                                    
                                        echo "<tr>
                                                <td>" . htmlspecialchars($row['artist']) . "</td>
                                                <td>" . htmlspecialchars($row['firstName'] . ' ' . $row['lastName']) . "</td>
                                                <td>" . htmlspecialchars($row['created_at']) . "</td>
                                                <td>" . htmlspecialchars($lyricsExcerpt) . "</td>
                                              </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>


                            </div>
                        </div>
                    </div>
                </main>
                
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
