<!--Title of the page-->
<?php
require('./inc/globalHeader.php');

session_start();

// Check if session PROFILE_ID variable is set.
if (!isset($_SESSION['PROFILE_ID'])) {
    // If not, redirect for sign in page.
    header("Location: signIn.php");
    exit();
}
?>

<!--Main content with section-->
<main>
    <div class="div-logout">
        <a class="btn btn-logout" href="logout.php">Logout</a>
    </div>

    <section>
        <!--Form to order pizza-->
        <form id="area" method="post" action="./inc/saveOrder.php" class="orderPizzaNossa">
            <h4>Your Order</h4>

            <!--Date of the order-->
            <fieldset>
                <div id="date-field">
                    <?php
                    date_default_timezone_set('America/Toronto');
                    $now = new DateTime('now'); //Current moment
                    $CurrentDate = $now->format('Y-m-d');
                    ?>
                    <input type="date" name="daydate" value="<?php echo $CurrentDate; ?>" min="<?php echo $CurrentDate; ?>" max="<?php echo $CurrentDate; ?>" id="date">
                </div>
            </fieldset>

            <!--Content of the order - <fieldset> with legend-->
            <fieldset>

                <!--Kind of pizza - Whole or slice-->
                <div id="wholeSlicePizza">
                    <input type="radio" name="wholeSlicePizza" id="wholePizza" value="Whole Pizza" checked>
                    <label for="wholePizza">Whole Pizza</label>

                    <input type="radio" name="wholeSlicePizza" id="slicePizza" value="Slice">
                    <label for="slicePizza">Slice</label>

                    <figure>
                        <img src="img/menu-pizza.png" width="110" alt="Menu-pizza">
                    </figure>
                </div>

                <!--Number of pizzas-->
                <div>
                    <label for="numberPizza">Number of Pizza or slice:</label>
                    <input type="number" name="numberPizza" id="numberPizza" min="1" max="30" required>

                    <label for="shape">Shape:</label>
                    <input type="text" name="shape" id="shape" placeholder="Square, round or slice">

                    <label for="size-select">Size:</label>
                    <select name="size" id="size-select">
                        <option value="">--Please choose an option--</option>
                        <option value="small">Small</option>
                        <option value="medio">Medio</option>
                        <option value="large">Large</option>
                        <option value="slice">Slice</option>
                    </select>
                </div>

                <!--Toppings available-->
                <br>
                <div>
                    <label name="toppingsPizza">Toppings:</label>
                    <div>
                        <input type="checkbox" name="toppings[]" value="Pepperoni" id="pepperoni" checked>
                        <label for="pepperoni">Pepperoni</label>
                    </div>
                    <div>
                        <input type="checkbox" name="toppings[]" value="Mushrroms" id="mushrroms">
                        <label for="mushrroms">Mushrroms</label>
                    </div>
                    <div>
                        <input type="checkbox" name="toppings[]" value="Magherita" id="magherita">
                        <label for="magherita">Magherita</label>
                    </div>
                    <div>
                        <input type="checkbox" name="toppings[]" value="Onions" id="onions">
                        <label for="onions">Onions</label>
                    </div>
                    <div>
                        <input type="checkbox" name="toppings[]" value="Cheese" id="cheese">
                        <label for="cheese">Cheese</label>
                    </div>
                    <div>
                        <input type="checkbox" name="toppings[]" value="Tomato" id="tomato">
                        <label for="tomato">Tomato</label>
                    </div>
                    <div>
                        <input type="checkbox" name="toppings[]" value="Mozzarella" id="mozzarella">
                        <label for="mozzarella">Mozzarella</label>
                    </div>
                </div>

                <!--Style Crust-->
                <br>
                <div>
                    <label name="styleCrustPizza">Style Crust:</label>
                    <div>
                        <input type="checkbox" name="styleCrust[]" id="deepDish" value="Deep dish" checked>
                        <label for="deepDish">Deep dish</label>
                    </div>
                    <div>
                        <input type="checkbox" name="styleCrust[]" id="thickCrust" value="Thick crust">
                        <label for="thickCrust">Thick crust</label>
                    </div>
                    <div>
                        <input type="checkbox" name="styleCrust[]" id="thinCrust" value="Thin crust">
                        <label for="thinCrust">Thin crust</label>
                    </div>
                </div>

                <!--How the customer wants to receiv the order-->
                <br>
                <div>
                    <div name="typeDeliveryPizza">
                        <input type="radio" name="typeDelivery[]" id="takeOut" value="Take out" checked>
                        <label for="takeOut">Take out</label>

                        <input type="radio" name="typeDelivery[]" id="delivery" value="Delivery">
                        <label for="delivery">Delivery</label>

                        <input type="radio" name="typeDelivery[]" id="eat-in" value="Eat in">
                        <label for="eat-in">Eat in</label>
                    </div>
                </div>

            </fieldset>

            <!--Personal information-->
            <fieldset>
                <legend>Your Details</legend>
                <div name="customerDetailsPizza">
                    <div>
                        <label for="fName">First name:</label>
                        <input type="text" name="fName" size="20" id="fName" placeholder="First name" required>

                        <label for="lName">Last name:</label>
                        <input type="text" name="lName" size="20" id="lName" placeholder="Last name" required>
                    </div>

                    <br>
                    <div>
                        <label for="phone">Phone number:</label>
                        <input type="tel" name="pnumber" id="phone" placeholder="(999)999-9999" required>
                    </div>

                    <br>
                    <div>
                        <label for="address">Address:</label>
                        <input type="text" name="c_address" id="address" size="25" placeholder="#, St. and postal code">
                    </div>
                </div>
            </fieldset>

            <!--Textarea for additional information and button to submit the order or reset-->
            <fieldset>
                <legend>Additional</legend>
                <textarea name="additional" id="additional" cols="60" rows="10"></textarea>
            </fieldset>
            <div class="button-submit-reset">
                <button class="btn btn-send" name="submit" type="submit" id="submit">Submit</button>
                <button class="btn btn-noSend" name="reset" type="reset" id="reset">Reset</button>
            </div>
        </form>

        <div class="submit-message">
            
        </div>
    </section>
</main>
<?php
// Footer where the copyright is placed
require('./inc/globalFooter.php');
?>