<?php
// Store the user inputs in variables and hash the password.
$username = $_POST['username'];
$password = hash('sha512', $_POST['password']);

// Connect to database.
require 'database.php';

// Set up and run the query.
$sql = "SELECT PROFILE_ID, USERNAME, FNAME, LNAME FROM PROFILEPIZZA 
WHERE USERNAME = '$username' AND PROFILE_PASSWORD = '$password'";
$result = $connectionOperation->getConn()->query($sql);

// Check the query for errors.
if (!$result) {
    die('Error: ' . mysqli_error($connectionOperation->getConn()));
}

// Store the number of results in a variable.
$count = mysqli_num_rows($result);
// Check if any matches found.

if ($count == 1) {
    $row = mysqli_fetch_assoc($result);

    // Access the existing session created automatically by the server.
    session_start();
    $_SESSION['timeout'] = time() + 300;

    // Take the user's id from the database and store it in a session variable.
    $_SESSION['PROFILE_ID'] = $row['PROFILE_ID'];
    $fname = $row['FNAME'];
    $lname = $row['LNAME'];

    // Set cookie.
    setcookie('FNAME', $fname, time() + 1 * 60, '/');
    setcookie('LNAME', $lname, time() + 2 * 60, '/');

    // Redirect the user.
    Header('Location: ../viewProfile.php');
} else {
    Header('Location: ../signIn.php?msg=invalidLogin');
}
$connectionOperation->closeConnection();
