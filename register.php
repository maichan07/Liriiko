<?php
include 'includes/config.php';
include 'includes/toast.php';

// Register Function 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (firstName,lastName, email, password) VALUES ('$firstName','$lastName', '$email', '$password')";
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Register Successfully";
        $_SESSION['code'] = "success";
    } else {
        $_SESSION['message'] = "Error : Fail to Register ";
        $_SESSION['code'] = "danger";;
    }
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CJ - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .blurry-container {
                    background: rgba(255, 255, 255, 0.2); /* Semi-transparent */
                    backdrop-filter: blur(10px); /* Blurry effect */
                    border-radius: 15px;
                    border: 1px solid rgba(255, 255, 255, 0.3);
                    padding: 20px;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                }

                
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light"
style="background: url('assets/img/music-bg.jpg') no-repeat center center/cover;">>
>

<!-- Register Form  -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4" >
            <div class="card shadow-lg p-4 blurry-container">
                <div class="card-body">
                    <h3 class="text-center mb-4 text-white">Register</h3>

                    <form method="POST" action="register.php">
                        <div class="mb-3">
                            <label class="form-label text-white">First Name</label>
                            <input type="text" name="firstName" class="form-control" placeholder="Enter First Name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-white ">Last Name</label>
                            <input type="text" name="lastName" class="form-control" placeholder="Enter Last Name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-white">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-white">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                        </div>

                        <button type="submit" class="btn btn-dark w-100">Register</button>
                    </form>

                    <p class="text-center mt-3 text-white">
                        Already have an account? <a class="btn btn-primary" href="login.php">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
