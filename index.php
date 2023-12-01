<?php require('./inc/globalHeader.php'); ?>

<main>
    <section class="main-content">
        <div class="registration">
            <div class="tittle">
                <!-- Register -->
                <h3>Are you new?</h3>
                <h4>Register here!</h4>
            </div>


            <form method="post" action="./inc/saveProfile.php" enctype="multipart/form-data" class="formRegistration">

                <!-- Personal Information -->
                <div><input type="text" class="register-form" name="firstName" placeholder="First Name" required autofocus /></div>
                <div><input type="text" class="register-form" name="lastName" placeholder="Last Name" required /></div>
                <div><input type="text" class="register-form" name="username" placeholder="Username" required /></div>
                <!-- pattern="\(\d{3}\) \d{3}-\d{4}" -->
                <div><input type="text" class="register-form" name="phoneNumber" placeholder="(123) 456-7890" required /></div>
                <div><input type="email" class="register-form" name="email" placeholder="Email" required /></div>

                <!-- Payment Method -->
                <div class="register-form-payment">
                    <label for="payment-method">Payment method:</label>
                    <br>
                    <input class="register-form-input" type="radio" id="cash" name="paymentMethod" value="Cash" checked> Cash
                    <br>
                    <input class="register-form-input" type="radio" id="debit-credit-card" name="paymentMethod" value="Debit/Credit Card"> Debit/Credit Card
                </div>

                <!-- Favorite Pizza -->
                <div><input type="text" class="register-form" name="favoritePizza" placeholder="Favorite Pizza Flavor" /></div>

                <!-- Delivery Information -->
                <div><input type="text" class="register-form" name="deliveryAddress" placeholder="#, St. and postal code" /></div>
                <div><textarea class="register-form" name="deliveryInstructions" placeholder="Delivery Instructions"></textarea></div>

                <!-- Profile Photo -->
                <div>
                    <label class="profile-image" for="profile-image">Profile picture:</label>
                    <br>
                    <input type="file" class="register-form" name="profileImage" id="profile-image" accept="image/*" />
                </div>

                <div><input type="password" class="register-form" name="password" placeholder="Password" required /></div>
                <div><input type="password" class="register-form" name="confirm" placeholder="Confirm Password" required /></div>

                <input class="btn btn-send" type="submit" id="" name="submit" value="Register" />

            </form>
        </div>

        <!-- Sign in -->
        <div class="loginIndex">
            <div class="tittle">
                <h3>Have you already created a profile?</h3>
                <h4>So, sign in here!</h4>
            </div>
            <form method="post" action="./inc/validation.php" class="formLogin">
                <div><input class="signInForm" name="username" type="text" placeholder="Username" required /></div>
                <div><input class="signInForm" name="password" type="password" placeholder="Password" required /></div>

                <input class="btn btn-send" type="submit" id="" value="Login" />
            </form>
        </div>
    </section>
</main>

<?php
require('./inc/globalFooter.php');
?>

<script src="js/script.js"></script>