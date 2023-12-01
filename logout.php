<?php
// Access existing session
session_start();

// Remove session variables
session_unset();

// Kill the session
session_destroy();

// Redirect to the sign-in page
header("Location: signIn.php");
