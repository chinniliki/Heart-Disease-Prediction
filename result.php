<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    header('Location: multiuserlogin.php'); // Redirect to login page if not logged in
    exit();
}

// Check if there's a prediction result available
if (!isset($_SESSION['predictionResult'])) {
    echo "No result available. Please submit the form first.";
    exit();
}

// Retrieve the prediction result and result class from the session
$result = $_SESSION['predictionResult'];
$resultClass = $_SESSION['resultClass'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prediction Result</title>
    <style>
        body {
            background-color: #f0f0f0;
            color: #333;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        h1 {
            color: #ff6600;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            display: inline-block;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .result-text {
            font-size: 24px;
            margin: 20px 0;
        }
        .high-risk {
            color: red;
        }
        .low-risk {
            color: green;
        }
        .logout-button {
            background-color: #ff6600;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 8px;
        }
        .logout-button:hover {
            background-color: #e55d00;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Heart Disease Prediction Result</h1>
        <p class="result-text <?php echo htmlspecialchars($resultClass, ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo htmlspecialchars($result, ENT_QUOTES, 'UTF-8'); ?>
        </p>
        <form action="logout.php" method="post">
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>
</body>
</html>
