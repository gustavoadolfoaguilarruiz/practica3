<?php
require_once "config.php";
session_start();

// Redirigir si ya está logueado
if (isset($_SESSION["username"])) {
    header("location:home.php");
}

// Proceso de inicio de sesión
if (isset($_POST["login"])) {
    $username = mysqli_real_escape_string($connection, $_POST["username"]);
    $password = mysqli_real_escape_string($connection, $_POST["password"]);
    $query = "SELECT * FROM users WHERE username = '$username'";    
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $username;
            header("location:home.php");
        } else {
            echo '<script>alert("Incorrect login details")</script>'; 
        }
    } else {
        echo '<script>alert("Incorrect login details")</script>';
    }
}

// Proceso de registro
if (isset($_POST["register"])) {
    if (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["repeat_password"])) {
        echo '<script>alert("All fields are required!")</script>';
    } else {
        $username = mysqli_real_escape_string($connection, $_POST["username"]);
        $password = password_hash(mysqli_real_escape_string($connection, $_POST["password"]), PASSWORD_DEFAULT);
        $query = "INSERT INTO users(username, password) VALUES('$username', '$password')";

        if (mysqli_query($connection, $query)) {
            echo '<script>alert("Registration Successful!")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional PHP App</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            color: #333;
        }
        .container {
            max-width: 500px;
            margin-top: 50px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-control, .btn {
            font-size: 1rem;
            padding: 10px;
        }
        .btn-primary {
            background: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        h3 {
            color: #333;
            font-weight: 700;
        }
        .text-center a {
            color: #007bff;
        }
        .text-center a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_GET["action"]) && $_GET["action"] == "register") { ?>
            <form method="post">
                <h3 class="text-center">Register</h3>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="repeat_password">Repeat Password</label>
                    <input type="password" id="repeat_password" name="repeat_password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="register">Register</button>
                <div class="text-center mt-3">
                    <p>Already a member? <a href="index.php">Login</a></p>
                </div>
            </form>
        <?php } else { ?>
            <form method="post">
                <h3 class="text-center">Login</h3>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
                <div class="text-center mt-3">
                    <p>Not a member? <a href="index.php?action=register">Register</a></p>
                </div>
            </form>
        <?php } ?>
    </div>
</body>
</html>
