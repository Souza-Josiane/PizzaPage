<?php
require_once('database.php');

if (!empty($_POST)) {
    // Variables
    $wholeSlicePizza = $_POST['wholeSlicePizza'];
    $numberPizza = $_POST['numberPizza'];
    $shape = $_POST['shape'];
    $size = $_POST['size'];

    //Checks if the 'toppings' field is defined in $_POST
    if (isset($_POST['toppings'])) {
        $allToppings = $_POST['toppings'];
        //Converts the array to a string if necessary.
        $toppings = implode(", ", $allToppings);
    } else {
        echo "No toppings selected.";
    }

    //Checks if the 'styleCrust' field is defined in $_POST
    if (isset($_POST['styleCrust'])) {
        $allStyleCrust = $_POST['styleCrust'];
        //Converts the array to a string if necessary.
        $styleCrust = implode($allStyleCrust);
    } else {
        echo "No style crust selected.";
    }

    $typeDelivery = $_POST['typeDelivery'];

    //Checks if the 'typeDelivery' field is defined in $_POST
    if (isset($_POST['typeDelivery'])) {
        $allTypeDelivery = $_POST['typeDelivery'];
        //Converts the array to a string if necessary.
        $typeDelivery = implode($allTypeDelivery);
    } else {
        echo "No type of delivery selected.";
    }

    $fname = $_POST['fName'];
    $lname = $_POST['lName'];
    $pnumber = $_POST['pnumber'];
    $c_address = $_POST['c_address'];
    $additional = $_POST['additional'];
    $order_id = $_POST['order_id'];

    $queryResult = $connectionOperation->updateOrder($wholeSlicePizza, $numberPizza, $shape, $size, $toppings, $styleCrust, $typeDelivery, $fname, $lname, $pnumber, $c_address, $additional, $order_id);
    try {
        if ($queryResult) {
            echo "<p>Updated order</p>";
            exit(); // Ensure that no further code is executed after the redirect
        } else {
            // Display an error message if the query fails
            echo "<p>Failed to update order</p>";
        }
    } catch (PDOException $e) {
        // Display an error message if the SQL execution fails
        echo '<p>Error: ' . $e->getMessage() . '</p>';
    }
}