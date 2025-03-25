<?php
session_start();
include './includes/config.php';

// User Registration (Sign-Up)
if (isset($_POST['signUp'])) {
    $firstName = mysqli_real_escape_string($conn, $_POST['fName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password hashing

    // Check if email already exists
    $checkEmailQuery = "SELECT id FROM liriikouser WHERE email = ?";
    $stmt = $conn->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Email Address Already Exists!";
    } else {
        $insertQuery = "INSERT INTO liriikouser (firstName, lastName, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssss", $firstName, $lastName, $email, $password);

        if ($stmt->execute()) {
            header("Location: index.php"); // Redirect to login page
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
    $stmt->close();
}

// User Login (Sign-In)
if (isset($_POST['signIn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT id, email, password FROM liriikouser WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id']; // Store user ID in session
            $_SESSION['email'] = $row['email'];

            header("Location: user/homepage.php");
            exit();
        } else {
            echo "Incorrect Password!";
        }
    } else {
        echo "User Not Found, Incorrect Email or Password!";
    }
    $stmt->close();
}

$conn->close();
?>
