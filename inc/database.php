<?php

    class ConnectionOperation {
        private $conn;
        function __construct() {
            $this->connect_db();
        }

        public function connect_db() {
            $db_host = "localhost";
            $db_user = "root";
            $db_pass = "";
            $db_name = "PIZZANOSSADB";

            $this->conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

            //Check connection
            if (mysqli_connect_error()) {
                die("ERROR: Could not connect: ".mysqli_connect_error());
            }
        }

        // To obtain connection
        public function getConn() {
            return $this->conn;
        }

        // Close connection
        public function closeConnection() {
            if ($this->conn) {
                mysqli_close($this->conn);
            }
        }

        // Query
        public function query($sql) {
            return mysqli_query($this->conn, $sql);
        }

        // Order
        // Insert
        public function registerOrder($daydate,$wholeSlicePizza, $numberPizza, $shape, $size, $toppings, $styleCrust, $typeDelivery, $fname, $lname, $pnumber, $c_address, $additional){
            $insertQuery = "INSERT INTO ORDERPIZZA (DAYDATE, WHOLESLICEPIZZA, NUMBERPIZZA, SHAPE, SIZE, TOPPINGS, STYLECRUST, TYPEDELIVERY, FNAME, LNAME, PNUMBER, C_ADDRESS, ADDITIONAL) VALUES ('$daydate','$wholeSlicePizza', '$numberPizza', '$shape', '$size', '$toppings', '$styleCrust', '$typeDelivery', '$fname', '$lname', '$pnumber', '$c_address', '$additional')";
            $queryResult = mysqli_query($this->conn, $insertQuery);
            if($queryResult){
                return true;
            } else {
                return false;
            }
        }

        // Read
        public function readOrders() {
            $selectQuery = "SELECT * FROM ORDERPIZZA";
            $queryResult = mysqli_query($this->conn, $selectQuery);
            return $queryResult;
        }

        // Read One by ID
        public function readOrderByID($order_id) {
            $selectQueryByID = "SELECT * FROM ORDERPIZZA WHERE ORDER_ID = '$order_id'";
            $queryResult = mysqli_query($this->conn, $selectQueryByID);
            if ($queryResult->num_rows > 0) {
                $row = $queryResult->fetch_assoc();
                return $row;
            } else {
                echo "Not Found!";
            }
        }

        // Update
        public function updateOrder($wholeSlicePizza, $numberPizza, $shape, $size, $toppings, $styleCrust, $typeDelivery, $fname, $lname, $pnumber, $c_address, $additional, $order_id) {
            $updateQuery = "UPDATE ORDERPIZZA SET WHOLESLICEPIZZA = '$wholeSlicePizza', NUMBERPIZZA = '$numberPizza', SHAPE = '$shape', SIZE = '$size', TOPPINGS = '$toppings', STYLECRUST = '$styleCrust', TYPEDELIVERY = '$typeDelivery', FNAME = '$fname', LNAME = '$lname', PNUMBER = '$pnumber', C_ADDRESS = '$c_address', ADDITIONAL = '$additional' WHERE ORDER_ID = '$order_id'";
            $queryResult = mysqli_query($this->conn, $updateQuery);
            if ($queryResult == true) {
                header("Location: ../viewOrder.php?msg1=update");
                exit;
            } else {
                echo "Updated failed!";
            }
        }

        // Delete
        public function deleteOrders($order_id) {
            $deleteQuery = "DELETE FROM ORDERPIZZA WHERE ORDER_ID = '$order_id'";
            $queryResult = mysqli_query($this->conn, $deleteQuery);
            if ($queryResult == true) {
                header("Location: viewOrder.php?msg2=delete");
            } else {
                echo "Record does not deleteted!";
            }
        }



        // Profile
        // Create
        public function registerProfile($fname,$lname, $username, $phoneNumber, $email, $paymentMethod, $favoritePizza, $deliveryAddress, $deliveryInstructions, $profileImages, $password){
            $insertQuery = "INSERT INTO PROFILEPIZZA (FNAME, LNAME, USERNAME, PNUMBER, EMAIL, PAYMENTMETHOD, FAVORITEPIZZA, C_ADDRESS, ADDITIONAL, PROFILE_PICTURE, PROFILE_PASSWORD) VALUES ('$fname', '$lname', '$username', '$phoneNumber', '$email', '$paymentMethod', '$favoritePizza', '$deliveryAddress', '$deliveryInstructions', '$profileImages', '$password')";
            $queryResult = mysqli_query($this->conn, $insertQuery);
            if($queryResult){
                return true;
            } else {
                return false;
            }
        }

        // Read
        public function readProfile() {
            $selectQuery = "SELECT * FROM PROFILEPIZZA";
            $queryResult = mysqli_query($this->conn, $selectQuery);
            return $queryResult;
        }

        // Read One by ID
        public function readProfileByID($profile_id) {
            $selectQueryByID = "SELECT * FROM PROFILEPIZZA WHERE PROFILE_ID = '$profile_id'";
            $queryResult = mysqli_query($this->conn, $selectQueryByID);
            if ($queryResult->num_rows > 0) {
                $row = $queryResult->fetch_assoc();
                return $row;
            } else {
                echo "Not Found!";
            }
        }

        // Update
        public function updateProfile($fname, $lname, $username, $phoneNumber, $email, $paymentMethod, $favoritePizza, $deliveryAddress, $deliveryInstructions, $profile_id) {
            $updateQuery = "UPDATE PROFILEPIZZA SET FNAME = '$fname', LNAME = '$lname', USERNAME = '$username', PNUMBER = '$phoneNumber', EMAIL = '$email', PAYMENTMETHOD = '$paymentMethod', FAVORITEPIZZA = '$favoritePizza', C_ADDRESS = '$deliveryAddress', ADDITIONAL = '$deliveryInstructions' WHERE PROFILE_ID = '$profile_id'";
            $queryResult = mysqli_query($this->conn, $updateQuery);
            if ($queryResult == true) {
                header("Location: ../viewProfile.php?msg1=update");
            } else {
                echo "Updated failed!";
            }
        }

        // Delete
        public function deleteProfile($profile_id) {
            $deleteQuery = "DELETE FROM PROFILEPIZZA WHERE PROFILE_ID = '$profile_id'";
            $queryResult = mysqli_query($this->conn, $deleteQuery);
            if ($queryResult == true) {
                header("Location: viewProfile.php?msg2=delete");
            } else {
                echo "Client does not deleteted!";
            }
        }

    }

    $connectionOperation = new ConnectionOperation();
?>