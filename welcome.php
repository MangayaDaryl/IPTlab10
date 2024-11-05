<?php
session_start();


if (!isset($_SESSION['is_logged_in'])) {
    header("Location: /login-form");
    exit();
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "USERS";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$result = $conn->query("SELECT id, CONCAT(first_name, ' ', last_name) AS full_name, email FROM USERS");
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>
<body>
<section class="section">
    <div class="container">
        <h1 class="title">Welcome to IPT10</h1>

        <table class="table is-fullwidth">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['full_name']; ?></td>
                        <td><?= $row['email']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="/logout.php" class="button is-danger">Logout</a>
    </div>
</section>
</body>
</html>

<?php
$conn->close();
?>
