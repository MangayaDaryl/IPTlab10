<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "USERS";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : null;
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : null;
    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

   
    if (!empty($first_name) && !empty($last_name) && !empty($username) && !empty($email) && !empty($password)) {
     
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

       
        $stmt = $conn->prepare("INSERT INTO USERS (first_name, last_name, username, email, password_hash) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $first_name, $last_name, $username, $email, $hashedPassword);

       
        if ($stmt->execute()) {
           
            header("Location: registration_success.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

   
        $stmt->close();
    } else {
        echo "Please fill in all required fields.";
    }
}


$conn->close();
?>
