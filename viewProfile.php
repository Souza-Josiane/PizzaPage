<?php
session_start();

require './inc/globalHeader.php';

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

    $queryResult = $connectionOperation->readProfile();

    if (isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
        $deleteId = $_GET['deleteId'];
        $connectionOperation->deleteProfile($deleteId);
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
              Profile updated successfully!
            </div>";
        }
        if (isset($_GET['msg2']) == "delete") {
            echo "<div class='alert alert-success alert-dismissible msg-update-delete'>
              <button type='button' class='close' data-dismiss='alert'>×</button>
              Profile deleted!
            </div>";
        }
        ?>

        <!-- Table header -->
        <div class="container">
            <table class="table-view table-profile">
                <thead>
                    <tr>
                        <th scope="col">Cliente Number#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Favorite pizza Flavor</th>
                        <th scope="col">Address</th>
                        <th scope="col">Delivery Instrunctions</th>
                        <th scope="col">Profile Picture</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <!-- Table body -->
                <tbody>
                    <?php
                    while ($r = mysqli_fetch_assoc($queryResult)) {
                    ?>
                        <tr>
                            <td><?php echo $r['PROFILE_ID']; ?></td>
                            <td><?php echo $r['FNAME']; ?></td>
                            <td><?php echo $r['LNAME']; ?></td>
                            <td><?php echo $r['USERNAME']; ?></td>
                            <td><?php echo $r['PNUMBER']; ?></td>
                            <td><?php echo $r['EMAIL']; ?></td>
                            <td><?php echo $r['PAYMENTMETHOD']; ?></td>
                            <td><?php echo $r['FAVORITEPIZZA']; ?></td>
                            <td><?php echo $r['C_ADDRESS']; ?></td>
                            <td><?php echo $r['ADDITIONAL']; ?></td>
                            <td>
                                <?php
                                // If PROFILE_PICTURE has the file name
                                $imagePath = './profileImages/' . $r['PROFILE_PICTURE'];
                                // Check if the image file exist before show it
                                if (file_exists($imagePath)) {
                                    echo '<img src = "' . $imagePath . ' " alt = "Profile Picture" style = "max-width: 100px; max-height: 100px;">';
                                } else {
                                    echo 'No Image!';
                                }
                                ?>
                            </td>

                            <!-- Button to edit page -->
                            <td>
                                <button class="btn btn-danger">
                                    <a href="updateProfile.php?editId=<?php echo $r['PROFILE_ID'] ?>">
                                        <i class="fa fa-pencil text-white"></i>
                                    </a>
                                </button>

                                <!-- Button to delete -->
                                <button class="btn btn-danger">
                                    <a href="viewProfile.php?deleteId=<?php echo $r['PROFILE_ID'] ?>" onclick="return confirm('Are you sure?'); return false;">
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
require './inc/globalFooter.php';
?>