<?php
require_once('database.php');

// validate inputs
$ok = true;

// Function to show error
function displayError($messageError)
{
    echo "<p>$messageError</p>";
    global $ok;
    $ok = false;
}

if (!empty($_POST)) {
    // Variables
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $username = $_POST['username'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $paymentMethod = $_POST['paymentMethod'];
    $favoritePizza = $_POST['favoritePizza'];
    $deliveryAddress = $_POST['deliveryAddress'];
    $deliveryInstructions = $_POST['deliveryInstructions'];

    // Password
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm'];

    // Validation
    if (empty($fname) || empty($lname) || empty($username) || empty($phoneNumber) || empty($email) || empty($paymentMethod) || empty($favoritePizza) || empty($deliveryAddress) || empty($password) || empty($confirmPassword)) {
        displayError('All fields are required');
        $ok = false;
    }


    if ((empty($password)) || ($password != $confirmPassword)) {
        displayError('Passwords do not match');
        $ok = false;
    }

    // Upload image
    if (!empty($_FILES['profileImage']['name'])) {
        $profileImagesPath = '../profileImages/';
        $fileName = basename($_FILES['profileImage']['name']);
        $targetFile = $profileImagesPath . $fileName;
        $tempFilePath = $_FILES['profileImage']['tmp_name'];

        // Check if the file is an image
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        // Valid image extension
        $valid_extension = array("png", "jpeg", "jpg", "svg");

        if (in_array($fileType, $valid_extension)) {
            if (move_uploaded_file($tempFilePath, $targetFile)) {
                echo "<p>File upload successfully!</p>";
            } else {
                displayError('Error uploading file.');
            }
        } else {
            displayError('Invalid file type! Upload image files only.');
        }
    } else {
        displayError('No image selected');
    }


    // Decide if we are saving or not
    if ($ok) {
        // Hash the password
        $password = hash('sha512', $password);

        // Construct the full image path
        $fullImagePath = $profileImagesPath . $fileName;

        // set up the sql
        $queryResult = $connectionOperation->registerProfile($fname, $lname, $username, $phoneNumber, $email, $paymentMethod, $favoritePizza, $deliveryAddress, $deliveryInstructions, $fullImagePath, $password);

        try {
            if ($queryResult) {
                // Display success message
                echo '<section class="success-row">';
                echo '<div>';
                echo '<h3>Admin Saved</h3>';
                echo '</div>';
                echo '</section>';

                // Redirect to the sign-in page
                header("Location: ../signIn.php");
                exit(); // Ensure that no further code is executed after the redirect
            } else {
                // Display an error message if the query fails
                echo '<p>Failed to save profile!</p>';
            }
        } catch (PDOException $e) {
            // Display an error message if the SQL execution fails
            echo '<p>Error: ' . $e->getMessage() . '</p>';
        }
    }
}
