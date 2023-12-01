<?php
session_start();

require('./inc/globalHeader.php');

// Check if session PROFILE_ID variable is set and time.
if (!isset($_SESSION['PROFILE_ID']) || (time() > $_SESSION['timeout'])) {
    session_unset();
    session_destroy();
    header('Location: signIn.php');
    exit();
} else {
    // Connect with database
    require_once('./inc/database.php');
    $_SESSION['timeout'] = time() + 120; // Two minuts.

    $queryResult = $connectionOperation->readOrders();

    if (isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
        $deleteId = $_GET['deleteId'];
        $connectionOperation->deleteOrders($deleteId);
    }
?>
    <!-- Main content - table -->
    <main>
        <!-- Buton to logout -->
        <a class="btn btn-logout" href="logout.php">Logout</a>

        <!-- Messages to display after edit or delete item -->
        <?php
        if (isset($_GET['msg1']) == "update") {
            echo "<div class='alert alert-success alert-dismissible msg-update-delete'>
              <button type='button' class='close' data-dismiss='alert'>×</button>
              Your order updated successfully!
            </div>";
        }
        if (isset($_GET['msg2']) == "delete") {
            echo "<div class='alert alert-success alert-dismissible msg-update-delete'>
              <button type='button' class='close' data-dismiss='alert'>×</button>
              Order deleted!
            </div>";
        }
        ?>

        <!-- Table header -->
        <div class="container">
            <table class="table-view table-order">
                <thead>
                    <tr>
                        <th scope="col">Order#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Whole or Slice</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Shape</th>
                        <th scope="col">Size</th>
                        <th scope="col">Toppings</th>
                        <th scope="col">Style Crust</th>
                        <th scope="col">Type of Delivery</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Phone#</th>
                        <th scope="col">Address</th>
                        <th scope="col">Additional</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <!-- Table body -->
                <tbody>
                    <?php
                    while ($r = mysqli_fetch_assoc($queryResult)) {
                    ?>
                        <tr>
                            <td><?php echo $r['ORDER_ID']; ?></td>
                            <td><?php echo $r['DAYDATE']; ?></td>
                            <td><?php echo $r['WHOLESLICEPIZZA']; ?></td>
                            <td><?php echo $r['NUMBERPIZZA']; ?></td>
                            <td><?php echo $r['SHAPE']; ?></td>
                            <td><?php echo $r['SIZE']; ?></td>
                            <td><?php echo $r['TOPPINGS']; ?></td>
                            <td><?php echo $r['STYLECRUST']; ?></td>
                            <td><?php echo $r['TYPEDELIVERY']; ?></td>
                            <td><?php echo $r['FNAME']; ?></td>
                            <td><?php echo $r['LNAME']; ?></td>
                            <td><?php echo $r['PNUMBER']; ?></td>
                            <td><?php echo $r['C_ADDRESS']; ?></td>
                            <td><?php echo $r['ADDITIONAL']; ?></td>

                            <!-- Button to edit page -->
                            <td>
                                <button class="btn btn-danger">
                                    <a href="updateOrder.php?editId=<?php echo $r['ORDER_ID'] ?>">
                                        <i class="fa fa-pencil text-white"></i>
                                    </a>
                                </button>

                                <!-- Button to delete -->
                                <button class="btn btn-danger">
                                    <a href="viewOrder.php?deleteId=<?php echo $r['ORDER_ID'] ?>" onclick="return confirm('Are you sure?'); return false;">
                                        <i class="fa fa-trash text-white"></i>
                                    </a>
                                </button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
<?php
    $connectionOperation = null;
}
require('./inc/globalFooter.php');
?>