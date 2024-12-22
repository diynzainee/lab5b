<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-center bg-success text-white">
                        <h2>Registration</h2>
                    </div>
                    <div class="card-body">
                        <form action="registration.php" method="POST">
                            <div class="mb-3">
                                <label for="matric" class="form-label">Matric:</label>
                                <input type="text" name="matric" id="matric" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role:</label>
                                <select name="role" id="role" class="form-select" required>
                                    <option value="">Please select</option>
                                    <option value="lecturer">Lecturer</option>
                                    <option value="student">Student</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Register</button>
                            </div>
                        </form>
                        <p class="text-center mt-3">
                            Already have an account? <a href="login.php">Login here</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $matric = $_POST['matric'];
        $name = $_POST['name'];
        $role = $_POST['role'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $conn = new mysqli('localhost', 'root', '', 'Lab_5b');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO users (matric, name, role, password) VALUES ('$matric', '$name', '$role', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<div class='text-success text-center mt-3'>Registration successful! <a href='login.php'>Login here</a></div>";
        } else {
            echo "<div class='text-danger text-center mt-3'>Error: " . $conn->error . "</div>";
        }

        $conn->close();
    }
    ?>
</body>
</html>

