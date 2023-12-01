<!--Title of the page-->
<?php
require_once('./inc/database.php');
require('./inc/globalHeader.php');

if (isset($_GET['editId'])) {
    $editId = $_GET['editId'];
    $editProfile = $connectionOperation->readProfileByID($editId);
?>
    <!--Main content with section-->
    <main>
        <div class="div-logout">
            <a class="btn btn-logout" href="logout.php">Logout</a>
        </div>
        <section class="update-content">

            <div class="updateProfilePage">
                <div class="tittle">
                    <h4>Update your information</h4>
                </div>

                <form method="post" action="./inc/editProfile.php" enctype="multipart/form-data" class="formUpdate">

                    <input type="hidden" name="profile_id" value="<?php echo $editProfile['PROFILE_ID']; ?>">

                    <!-- Profile picture -->
                    <div class="profilePicture">
                        <?php
                        // If PROFILE_PICTURE has the file name
                        $imagePath = './profileImages/' . $editProfile['PROFILE_PICTURE'];
                        // Check if the image file exist before show it
                        if (file_exists($imagePath)) {
                            echo '<img src = "' . $imagePath . ' " alt = "Profile Picture" style = "max-width: 100px; max-height: 100px;">';
                        } else {
                            echo 'No Image!';
                        }
                        ?>
                    </div>

                    <!-- Get message send by header from editProfile.php -->
                    <?php
                    if (isset($_GET['msg'])) {
                        echo $_GET['msg'];
                    }
                    ?>

                    <!-- Personal Information -->
                    <div><input type="text" class="register-form" name="firstName" value="<?php echo $editProfile['FNAME']; ?>" required="" /></div>
                    <div><input type="text" class="register-form" name="lastName" value="<?php echo $editProfile['LNAME']; ?>" required="" /></div>
                    <div><input type="text" class="register-form" name="username" value="<?php echo $editProfile['USERNAME']; ?>" required="" /></div>
                    <!-- pattern="\(\d{3}\) \d{3}-\d{4}" -->
                    <div><input type="text" class="register-form" name="phoneNumber" value="<?php echo $editProfile['PNUMBER']; ?>" required="" /></div>
                    <div><input type="email" class="register-form" name="email" value="<?php echo $editProfile['EMAIL']; ?>" required="" /></div>

                    <!-- Payment Method -->
                    <div class="register-form-payment">
                        <label for="payment-method">Payment method:</label>
                        <br>
                        <input class="register-form-input" type="radio" id="cash" name="paymentMethod" value="Cash" <?php echo ($editProfile['PAYMENTMETHOD'] == "Cash") ? " checked" : "" ?>> Cash
                        <br>
                        <input class="register-form-input" type="radio" id="debit-credit-card" name="paymentMethod" value="Debit/Credit Card" <?php echo ($editProfile['PAYMENTMETHOD'] == "Debit/Credit Card") ? " checked" : "" ?>> Debit/Credit Card
                    </div>

                    <!-- Favorite Pizza -->
                    <div><input type="text" class="register-form" name="favoritePizza" value="<?php echo $editProfile['FAVORITEPIZZA']; ?>" required="" /></div>

                    <!-- Delivery Information -->
                    <div><input type="text" class="register-form" name="deliveryAddress" value="<?php echo $editProfile['C_ADDRESS']; ?>" required="" /></div>
                    <div><textarea class="register-form" name="deliveryInstructions"><?php echo $editProfile['ADDITIONAL']; ?></textarea></div>

                    <input class="btn btn-send" type="submit" id="" name="submit" value="Update" />

                    <!-- To cancell the update -->
                    <button class="btn btn-noSend">
                        <a href="viewProfile.php?>">
                            Cancell
                        </a>
                    </button>

                </form>
            </div>

        </section>
    </main>
<?php
    require('./inc/globalFooter.php');
} else {
    header("Location: viewProfile.php");
    exit;
}
?>