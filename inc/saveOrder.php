<?php
require_once('database.php');

if (!empty($_POST)) {
    $daydate = $_POST['daydate'];
    $wholeSlicePizza = $_POST['wholeSlicePizza'];
    $numberPizza = $_POST['numberPizza'];
    $shape = $_POST['shape'];
    $size = $_POST['size'];

    //$toppings = $_POST['toppings'];
    //Checks if the 'toppings' field is defined in $_POST
    if (isset($_POST['toppings'])) {
        $allToppings = $_POST['toppings'];
        //Converts the array to a string if necessary.
        $toppings = implode(", ", $allToppings);
    } else {
        echo "No toppings selected.";
    }

    //$styleCrust = $_POST['styleCrust'];
    //Checks if the 'styleCrust' field is defined in $_POST
    if (isset($_POST['styleCrust'])) {
        $allStyleCrust = $_POST['styleCrust'];
        //Converts the array to a string if necessary.
        $styleCrust = implode(", ", $allStyleCrust);
    } else {
        echo "No style crust selected.";
    }

    $typeDelivery = $_POST['typeDelivery'];

    //$typeDelivery = $_POST['typeDelivery'];
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

    $queryResult = $connectionOperation->registerOrder($daydate, $wholeSlicePizza, $numberPizza, $shape, $size, $toppings, $styleCrust, $typeDelivery, $fname, $lname, $pnumber, $c_address, $additional);
    if ($queryResult) {
        echo "<p>Successfully created order!</p>";
        // Redirect to order
        header("Location: ../viewOrder.php");
    } else {
        echo "<p>Failed to create order!</p>";
    }
}