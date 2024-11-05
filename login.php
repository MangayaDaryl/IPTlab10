<?php
session_start(); 


if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0; 
}


$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "USERS"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$errors = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password_hash FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

       
        if (password_verify($password, $hashedPassword)) {
            
            $_SESSION['is_logged_in'] = TRUE; 
            $_SESSION['login_attempts'] = 0; 
            header("Location: welcome.php"); 
            exit; 
        } else {
          
            $_SESSION['login_attempts']++;
            $errors[] = "Invalid email or password. Attempt " . $_SESSION['login_attempts'] . " of 3.";
        }
    } else {
     
        $_SESSION['login_attempts']++;
        $errors[] = "Invalid email or password. Attempt " . $_SESSION['login_attempts'] . " of 3.";
    }

    
    if ($_SESSION['login_attempts'] >= 3) {
        $errors[] = "Too many failed login attempts. Please try again later.";
    }
}


$form_disabled = $_SESSION['login_attempts'] >= 3;


include 'login-form.php';


$stmt->close();
$conn->close();
?>
