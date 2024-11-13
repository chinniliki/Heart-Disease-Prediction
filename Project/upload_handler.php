<?php
session_start(); // Ensure session is started

// Check if the user is logged in
if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    header('Location: multiuserlogin.php'); // Redirect to login page if not logged in
    exit();
}

// Initialize result variable and class for result styling
$result = "";
$resultClass = "";

// Handle the file upload and analysis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['dataset']) && $_FILES['dataset']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['dataset']['tmp_name'];
        $name = basename($_FILES['dataset']['name']);
        $upload_dir = 'uploads/'; // Directory where the file will be saved

        // Ensure the upload directory exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Move the uploaded file to the desired location
        if (move_uploaded_file($tmp_name, $upload_dir . $name)) {
            // Process the file to check for heart disease
            $file_path = $upload_dir . $name;
            $result = analyzeFile($file_path);

            // Determine the class based on the result
            if (strpos($result, 'presence') !== false) {
                $resultClass = 'positive-result';
            } else {
                $resultClass = 'negative-result';
            }

            // Store the result in the session for this user
            $_SESSION['result'] = $result;
            $_SESSION['resultClass'] = $resultClass;
        } else {
            $result = "Failed to move uploaded file.";
        }
    } else {
        $result = "Error in file upload.";
    }
} else {
    // Use the result from the session if available
    if (isset($_SESSION['result'])) {
        $result = $_SESSION['result'];
        $resultClass = $_SESSION['resultClass'];
    } else {
        $result = "Invalid request method or no result found.";
    }
}

function analyzeFile($file_path) {
    // Read the file
    $file = fopen($file_path, 'r');
    if ($file === false) {
        return "Failed to open the file.";
    }

    // Skip the header row if the file has headers
    $header = fgetcsv($file);

    $hasHeartDisease = false;

    while (($data = fgetcsv($file)) !== false) {
        // Example: Assuming the last column indicates heart disease (1 = Yes, 0 = No)
        if (isset($data[count($data) - 1]) && $data[count($data) - 1] == '1') {
            $hasHeartDisease = true;
            break;
        }
    }

    fclose($file);

    if ($hasHeartDisease) {
        return "Your test results indicate the presence of heart disease,but with the right treatment and lifestyle changes,it can be effectively managed.";
    } else {
        return "The patient does not have heart disease.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heart Disease Analysis</title>
    <link rel="stylesheet" href="styles.css">
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
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 8px;
            display: inline-block;
            color: white;
        }
        .result-text {
            font-size: 28px; /* Adjust the size as needed */
            margin: 20px 0; /* Margin to separate from other elements */
        }
        .positive-result {
            color: rgb(255, 99, 71); /* Red color for positive results */
        }
        .negative-result {
            color: rgb(50, 205, 50); /* Green color for negative results */
        }
        .logout-button {
            background-color: #74992e;
            color: #ff6600;
            border: none; /* Remove border */
            padding: 10px 20px; /* Adjust padding for a better appearance */
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px; /* Adjust margin for spacing */
            cursor: pointer;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: Add a slight shadow for a 3D effect */
        }
        .logout-button:hover {
            background-color: #f0f0f0;
            color: #74992e; /* Change text color on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Heart Disease Analysis Result</h1>
        <p class="result-text <?php echo htmlspecialchars($resultClass, ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo htmlspecialchars($result, ENT_QUOTES, 'UTF-8'); ?>
        </p>
        <form action="logout.php" method="post">
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>
</body>
</html>
