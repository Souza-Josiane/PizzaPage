<?php
require_once('database.php');

// Validate inputs
$ok = true;

if (!empty($_POST)) {
    // Variables
    $profile_id = $_POST['profile_id'];
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $username = $_POST['username'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $paymentMethod = $_POST['paymentMethod'];
    $favoritePizza = $_POST['favoritePizza'];
    $deliveryAddress = $_POST['deliveryAddress'];
    $deliveryInstructions = $_POST['deliveryInstructions'];

    // Validation
    if (empty($fname) ||
        empty($lname) ||
        empty($username) ||
        empty($phoneNumber) ||
        empty($email) ||
        empty($paymentMethod) ||
        empty($favoritePizza) ||
        empty($deliveryAddress)) {
            header ("Location: ../updateProfile.php?msg=All fields must be filled!");
            $ok = false;
    }

    // Decide if we are saving or not
    if ($ok) {

        // Set up the sql
        $queryResult = $connectionOperation->updateProfile($fname, $lname, $username, $phoneNumber, $email, $paymentMethod, $favoritePizza, $deliveryAddress, $deliveryInstructions, $profile_id);

        try {
            if ($queryResult) {
                // Display success message
                echo '<section class="success-row">';
                echo '<div>';
                echo '<h3>Admin Saved</h3>';
                echo '</div>';
                echo '</section>';

                exit(); // Ensure that no further code is executed after the redirect
            } else {
                // Display an error message if the query fails
                echo '<p>Failed to update profile</p>';
            }
        } catch (PDOException $e) {
            // Display an error message if the SQL execution fails
            echo '<p>Error: ' . $e->getMessage() . '</p>';
        }
    }
}
