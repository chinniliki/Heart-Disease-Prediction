<?php
session_start(); // Start the session to check if the user is logged in

// Check if the user is logged in
if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    header('Location: multiuserlogin.php'); // Redirect to login page if not logged in
    exit();
}

// Check if the user type is 'user'
if ($_SESSION['usertype'] != 'user') {
    header('Location: multiuserlogin.php'); // Redirect to login if not a user
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heart Disease Prediction</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: black;
            background-image: url(download.jpg); /* Ensure the path is correct */
            background-size: cover;
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: rgb(22, 232, 32);
        }

        .scrollable-container {
            width: 400px;
            max-height: 500px;
            overflow: auto;
            margin: 0 auto;
            border-radius: 10px;
        }"C:\xampp\htdocs\making\liki.jpg"

        form {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50px;
        }

        label {
            display: block;
            margin: 10px 0;
            color: white;
        }

        input {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
        }

        .disclaimer {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 12px;
            animation: movingText 10s linear infinite;
        }

        @keyframes movingText {
            0% { transform: translateX(0); }
            100% { transform: translateX(calc(-1 * 100%)); }
        }
    </style>
</head>
<body>
<div class="container">
        <h1>Heart Disease Prediction</h1>
        <div class="scrollable-container">
            <form action="process_prediction.php" method="POST">
                <label for="age">Age:</label>
                <input type="text" name="age" required>
        
                <label for="sex">Sex (0 for female, 1 for male):</label>
                <input type="text" name="sex" required>
        
                <label for="cp">Chest Pain Type (0-3):</label>
                <input type="text" name="cp" required>
        
                <label for="trestbps">Resting Blood Pressure:</label>
                <input type="text" name="trestbps" required>
        
                <label for="chol">Serum Cholesterol:</label>
                <input type="text" name="chol" required>
        
                <label for="fbs">Fasting Blood Sugar:</label>
                <input type="text" name="fbs" required>
        
                <label for="restecg">Resting Electrocardiographic Results:</label>
                <input type="text" name="restecg" required>
        
                <label for="thalach">Maximum Heart Rate Achieved:</label>
                <input type="text" name="thalach" required>
        
                <label for="exang">Exercise Induced Angina (0 for no, 1 for yes):</label>
                <input type="text" name="exang" required>
        
                <label for="oldpeak">ST Depression Induced by Exercise Relative to Rest:</label>
                <input type="text" name="oldpeak" required>
        
                <label for="slope">Slope of the Peak Exercise ST Segment:</label>
                <input type="text" name="slope" required>
        
                <label for="ca">Number of Major Vessels Colored by Fluoroscopy (0-3):</label>
                <input type="text" name="ca" required>
        
                <label for="thal">Thalassemia:</label>
                <input type="text" name="thal" required>
                <br>
                <input type="submit" value="Predict">
            </form>
        </div>
    </div>
</body>
</html>
