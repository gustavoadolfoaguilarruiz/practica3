<?php
require_once "config.php";
session_start();

if (!isset($_SESSION["username"])) {
    header("location:index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional App</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin-top: 50px;
        }
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #e9ecef;
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #495057;
        }
        .card-subtitle {
            font-size: 0.875rem;
            color: #6c757d;
        }
        .card-text {
            font-size: 1rem;
            color: #495057;
        }
        .card-link {
            color: #007bff;
            font-weight: bold;
        }
        .card-link:hover {
            color: #0056b3;
            text-decoration: none;
        }
        .btn-logout {
            background-color: #dc3545;
            color: #fff;
            border: none;
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 4px;
            margin-top: 20px;
            display: block;
            width: 100%;
            text-align: center;
            font-weight: bold;
        }
        .btn-logout:hover {
            background-color: #c82333;
        }
        .header-text {
            font-size: 1.5rem;
            color: #007bff;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <span class="header-text">Welcome to My App!</span>
        <div class="row">
            <?php
            $query = "SELECT * FROM users";    
            $result = mysqli_query($connection, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">' . htmlspecialchars($row["username"]) . '</h5>
                                <h6 class="card-subtitle mb-2 text-muted">ID: ' . htmlspecialchars($row["id"]) . '</h6>
                                <p class="card-text">Muy interesante y amena esta práctica, gracias.</p>
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            </div>
                        </div>
                    </div>
                    ';
                }
            }
            ?> 
        </div>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</body>
</html>
