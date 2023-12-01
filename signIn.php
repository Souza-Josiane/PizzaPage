<?php
require './inc/globalHeader.php';
?>
<main>
    <section class="signIn-content">
        <div class="signIn">
            <!-- Sign in -->
            <h3>You are not signed!</h3>
            <h4>Please sign in to continue!</h4>

            <form method="post" action="./inc/validation.php" class="formLogin formSignIn">

                <p><input class="signInForm" name="username" type="text" placeholder="Username" required autofocus /></p>
                <p><input class="signInForm" name="password" type="password" placeholder="Password" required /></p>
                <input class="btn btn-send" type="submit" value="Login" />

                <?php
                if (isset($_GET['msg']) == "invalidLogin") {
                    echo "<div>User or Password Incorrect!</div>";
                }
                ?>

            </form>
        </div>
    </section>
</main>
<?php
require './inc/globalFooter.php';
?>