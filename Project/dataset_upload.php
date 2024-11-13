<!doctype html>
<?php
session_start(); // Start the session to manage login status

// Check if the user is logged in and if the user type is 'admin'
if (!isset($_SESSION['login']) || $_SESSION['usertype'] != 'admin') {
    header('Location: multiuserlogin.php'); // Redirect to login page if not logged in or not an admin
    exit();
}
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dataset Upload</title>
    <style>
        body {
            background-image: url(upload.jpg);
            background-size: cover;
            background-position: center;
            background-color: #f0f0f0;
            background-repeat: no-repeat;
            color: #333;
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #ff6600;
            text-align: center;
            margin-top: 50px;
        }
        form {
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            margin: auto;
            color: white;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Upload Heart Disease Prediction Dataset</h1>
    <form action="upload_handler.php" method="post" enctype="multipart/form-data">
        <input type="file" name="dataset" accept=".csv">
        <input type="submit" value="Upload">
    </form>
</body>
</html>
