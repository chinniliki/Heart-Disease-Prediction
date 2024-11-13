<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    header('Location: multiuserlogin.php'); // Redirect to login page if not logged in
    exit();
}

// Example logic to handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $cp = $_POST['cp'];
    $trestbps = $_POST['trestbps'];
    $chol = $_POST['chol'];
    $fbs = $_POST['fbs'];
    $restecg = $_POST['restecg'];
    $thalach = $_POST['thalach'];
    $exang = $_POST['exang'];
    $oldpeak = $_POST['oldpeak'];
    $slope = $_POST['slope'];
    $ca = $_POST['ca'];
    $thal = $_POST['thal'];

    // Example prediction logic (modify as needed)
    if ($age > 50 && $chol > 200) {
        $result = "High risk of heart disease. Please consult a doctor.";
        $resultClass = 'high-risk'; // For CSS styling
    } else {
        $result = "Low risk of heart disease.";
        $resultClass = 'low-risk'; // For CSS styling
    }

    // Store result in session to display on the result page
    $_SESSION['predictionResult'] = $result;
    $_SESSION['resultClass'] = $resultClass;

    // Redirect to result display page
    header('Location: result.php');
    exit();
}
