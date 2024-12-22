<?php
$conn = new mysqli('localhost', 'root', '', 'Lab_5b');

session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $sql = "DELETE FROM users WHERE matric = '$matric'";
    if ($conn->query($sql) === TRUE) {
        header('Location: display.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

