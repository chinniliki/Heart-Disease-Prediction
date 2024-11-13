<!doctype html>
<?php
session_start(); // Start the session to manage login status

$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "login"; // Make sure to specify your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle login
if (isset($_POST['Login'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $usertype = $_POST['usertype'];

    $query = "SELECT * FROM login WHERE username='$user' AND password='$pass' AND usertype='$usertype'";
    $result = mysqli_query($conn, $query);

    // Check if login is successful
    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION['login'] = true; // Set session variable to indicate the user is logged in
        $_SESSION['usertype'] = $usertype; // Store user type in session

        // Check the user type and redirect accordingly
        if ($usertype == 'admin') {
            echo '<script type="text/javascript">alert("You are logged in successfully as Admin")</script>';
            echo '<script type="text/javascript">window.location.href="dataset_upload.php";</script>'; // Admin is redirected to upload page
        } else if ($usertype == 'user') {
            echo '<script type="text/javascript">alert("You are logged in successfully as User")</script>';
            echo '<script type="text/javascript">window.location.href="heart_disease_prediction.php";</script>'; // User is redirected to prediction form
        }
    } else {
        echo '<script type="text/javascript">alert("Invalid username, password, or user type")</script>';
    }
}

// Handle signup
if (isset($_POST['Signup'])) {
    $new_user = $_POST['new_user'];
    $new_pass = $_POST['new_pass'];
    $new_usertype = $_POST['new_usertype'];

    // Check if username already exists
    $check_query = "SELECT * FROM login WHERE username='$new_user'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo '<script type="text/javascript">alert("Username already exists")</script>';
    } else {
        $insert_query = "INSERT INTO login (username, password, usertype) VALUES ('$new_user', '$new_pass', '$new_usertype')";
        if (mysqli_query($conn, $insert_query)) {
            echo '<script type="text/javascript">alert("Registration successful")</script>';
        } else {
            echo '<script type="text/javascript">alert("Error: ' . mysqli_error($conn) . '")</script>';
        }
    }
}

mysqli_close($conn);
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Multi user login system</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="text-overlay">
    Welcome To Heart Disease Prediction
</div>    

<!-- Login Form -->
<form method="post">
    <table>
        <tr>
            <td>Username:<input type="text" name="user" placeholder="enter your username"></td>
        </tr>
        <tr>
            <td>Password:<input type="text" name="pass" placeholder="enter your password"></td>
        </tr>
        <tr>
            <td>
                Select user type: 
                <select name="usertype">
                    <option value="admin">admin</option>
                    <option value="user">user</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="Login" value="Login"></td>
        </tr>
    </table>
</form>

<!-- Registration Form -->
<form method="post">
    <h2>Sign Up</h2>
    <table>
        <tr>
            <td>Username:<input type="text" name="new_user" placeholder="enter a username"></td>
        </tr>
        <tr>
            <td>Password:<input type="text" name="new_pass" placeholder="enter a password"></td>
        </tr>
        <tr>
            <td>
                Select user type: 
                <select name="new_usertype">
                    <option value="admin">admin</option>
                    <option value="user">user</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="Signup" value="Sign Up"></td>
        </tr>
    </table>
</form>

</body>
</html>
