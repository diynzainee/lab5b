<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-center bg-primary text-white">
                        <h2>Login</h2>
                    </div>
                    <div class="card-body">
                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="matric" class="form-label">Matric:</label>
                                <input type="text" name="matric" id="matric" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                        <p class="text-center mt-3">
                            Don't have an account? <a href="registration.php">Register here</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $matric = $_POST['matric'];
        $password = $_POST['password'];

        $conn = new mysqli('localhost', 'root', '', 'Lab_5b');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM users WHERE matric = '$matric'";
        $result = $conn->query($sql);

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user['name'];
                header('Location: display.php');
            } else {
                echo "<div class='text-danger text-center mt-3'>Invalid password.</div>";
            }
        } else {
            echo "<div class='text-danger text-center mt-3'>User not found. Please <a href='registration.php'>register here</a>.</div>";
        }

        $conn->close();
    }
    ?>
</body>
</html>
