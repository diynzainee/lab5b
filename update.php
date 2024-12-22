<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'Lab_5b');

if (isset($_GET['matric'])) {
    $old_matric = $_GET['matric'];
    $sql = "SELECT * FROM users WHERE matric = '$old_matric'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET matric = '$new_matric', name = '$name', role = '$role' WHERE matric = '$old_matric'";
    if ($conn->query($sql) === TRUE) {
        header('Location: display.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Update User</h2>
        <form action="update.php?matric=<?php echo $old_matric; ?>" method="POST">
            <div class="mb-3">
                <label for="matric" class="form-label">Matric:</label>
                <input type="text" name="matric" id="matric" class="form-control" value="<?php echo $user['matric']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo $user['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="lecturer" <?php if ($user['role'] === 'lecturer') echo 'selected'; ?>>Lecturer</option>
                    <option value="student" <?php if ($user['role'] === 'student') echo 'selected'; ?>>Student</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='display.php'">Cancel</button>
        </form>
    </div>
</body>
</html>

