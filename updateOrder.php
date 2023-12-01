<!--Title of the page-->
<?php
require_once('./inc/database.php');
require('./inc/globalHeader.php');

if (isset($_GET['editId'])) {
    $editId = $_GET['editId'];
    $editOrder = $connectionOperation->readOrderByID($editId);
?>
    <!--Main content with section-->
    <main>
        <div class="div-logout">
            <a class="btn btn-logout" href="logout.php">Logout</a>
        </div>
        <section>
            <!--Form to order pizza-->
            <form id="area" method="post" action="./inc/editOrder.php" enctype="multipart/form-data" class="orderPizzaNossa">
                <h4>Update Order</h4>

                <input type="hidden" name="order_id" value="<?php echo $editOrder['ORDER_ID']; ?>">

                <!--Date of the order-->
                <fieldset>
                    <div id="date-field">
                        <input type="date" name="daydate" value="<?php echo $editOrder['DAYDATE']; ?>" id="date">
                    </div>
                </fieldset>

                <!--Content of the order - <fieldset> with legend-->
                <fieldset>

                    <!--Kind of pizza - Whole or slice-->
                    <div id="wholeSlicePizza">
                        <input type="radio" name="wholeSlicePizza" id="wholePizza" value="Whole Pizza" <?php echo ($editOrder['WHOLESLICEPIZZA'] == "Whole Pizza") ? " checked" : "" ?>>
                        <label for="wholePizza">Whole Pizza</label>

                        <input type="radio" name="wholeSlicePizza" id="slicePizza" value="Slice" <?php echo ($editOrder['WHOLESLICEPIZZA'] == "Slice") ? " checked" : "" ?>>
                        <label for="slicePizza">Slice</label>

                        <figure>
                            <img src="img/menu-pizza.png" width="110" alt="Menu-pizza">
                        </figure>
                    </div>

                    <!--Number of pizzas-->
                    <div>
                        <label for="numberPizza">Number of Pizza or slice:</label>
                        <input type="number" name="numberPizza" id="numberPizza" min="1" max="30" value="<?php echo $editOrder['NUMBERPIZZA']; ?>" required="">

                        <label for="shape">Shape:</label>
                        <input type="text" name="shape" id="shape" value="<?php echo $editOrder['SHAPE']; ?>" required="">

                        <label for="size-select">Size:</label>
                        <select name="size" id="size-select">
                            <option value="">--Please choose an option--</option>
                            <option value="Small" <?php echo ($editOrder['SIZE'] == 'Small') ? 'selected' : ''; ?>>Small</option>
                            <option value="Medio" <?php echo ($editOrder['SIZE'] == 'Medio') ? 'selected' : ''; ?>>Medio</option>
                            <option value="Large" <?php echo ($editOrder['SIZE'] == 'Large') ? 'selected' : ''; ?>>Large</option>
                            <option value="Slice" <?php echo ($editOrder['SIZE'] == 'Slice') ? 'selected' : ''; ?>>Slice</option>
                        </select>
                    </div>

                    <!--Toppings available-->
                    <br>
                    <div>
                        <label name="toppingsPizza">Toppings:</label>
                        <?php
                        $toppingsArray = explode(", ", $editOrder['TOPPINGS']);
                        ?>

                        <div>
                            <input type="checkbox" name="toppings[]" value="Pepperoni" id="pepperoni" <?php if (in_array("Pepperoni", $toppingsArray)) echo "checked"; ?>>
                            <label for="pepperoni">Pepperoni</label>
                        </div>
                        <div>
                            <input type="checkbox" name="toppings[]" value="Mushrroms" id="mushrroms" <?php if (in_array("Mushrroms", $toppingsArray)) echo "checked"; ?>>
                            <label for="mushrroms">Mushrroms</label>
                        </div>
                        <div>
                            <input type="checkbox" name="toppings[]" value="Magherita" id="magherita" <?php if (in_array("Magherita", $toppingsArray)) echo "checked"; ?>>
                            <label for="magherita">Magherita</label>
                        </div>
                        <div>
                            <input type="checkbox" name="toppings[]" value="Onions" id="onions" <?php if (in_array("Onions", $toppingsArray)) echo "checked"; ?>>
                            <label for="onions">Onions</label>
                        </div>
                        <div>
                            <input type="checkbox" name="toppings[]" value="Cheese" id="cheese" <?php if (in_array("Cheese", $toppingsArray)) echo "checked"; ?>>
                            <label for="cheese">Cheese</label>
                        </div>
                        <div>
                            <input type="checkbox" name="toppings[]" value="Tomato" id="tomato" <?php if (in_array("Tomato", $toppingsArray)) echo "checked"; ?>>
                            <label for="tomato">Tomato</label>
                        </div>
                        <div>
                            <input type="checkbox" name="toppings[]" value="Mozzarella" id="mozzarella" <?php if (in_array("Mozzarella", $toppingsArray)) echo "checked"; ?>>
                            <label for="mozzarella">Mozzarella</label>
                        </div>
                    </div>

                    <!--Style Crust-->
                    <br>
                    <div>
                        <label name="styleCrustPizza">Style Crust:</label>
                        <?php
                        $styleCrustArray = explode(", ", $editOrder['STYLECRUST']);
                        ?>

                        <div>
                            <input type="checkbox" name="styleCrust[]" id="deepDish" value="Deep dish" <?php if (in_array("Deep dish", $styleCrustArray)) echo "checked"; ?>>
                            <label for="deepDish">Deep dish</label>
                        </div>
                        <div>
                            <input type="checkbox" name="styleCrust[]" id="thickCrust" value="Thick crust" <?php if (in_array("Thick crust", $styleCrustArray)) echo "checked"; ?>>
                            <label for="thickCrust">Thick crust</label>
                        </div>
                        <div>
                            <input type="checkbox" name="styleCrust[]" id="thinCrust" value="Thin crust" <?php if (in_array("Thin crust", $styleCrustArray)) echo "checked"; ?>>
                            <label for="thinCrust">Thin crust</label>
                        </div>
                    </div>

                    <!--How the customer wants to receiv the order-->
                    <br>
                    <div>
                        <div name="typeDeliveryPizza">
                            <input type="radio" name="typeDelivery[]" id="takeOut" value="Take out" <?php echo ($editOrder['TYPEDELIVERY'] == "Take out") ? " checked" : "" ?>>
                            <label for="takeOut">Take out</label>

                            <input type="radio" name="typeDelivery[]" id="delivery" value="Delivery" <?php echo ($editOrder['TYPEDELIVERY'] == "Delivery") ? " checked" : "" ?>>
                            <label for="delivery">Delivery</label>

                            <input type="radio" name="typeDelivery[]" id="eat-in" value="Eat in" <?php echo ($editOrder['TYPEDELIVERY'] == "Eat in") ? " checked" : "" ?>>
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
                            <input type="text" name="fName" size="20" id="fName" value="<?php echo $editOrder['FNAME']; ?>" required="">

                            <label for="lName">Last name:</label>
                            <input type="text" name="lName" size="20" id="lName" value="<?php echo $editOrder['LNAME']; ?>" required="">
                        </div>

                        <br>
                        <div>
                            <label for="phone">Phone number:</label>
                            <input type="tel" name="pnumber" id="phone" value="<?php echo $editOrder['PNUMBER']; ?>" required="">
                        </div>

                        <br>
                        <div>
                            <label for="address">Address:</label>
                            <input type="text" name="c_address" id="address" size="25" value="<?php echo $editOrder['C_ADDRESS']; ?>" required="">
                        </div>
                    </div>
                </fieldset>

                <!--Textarea for additional information and button to submit the order or reset-->
                <fieldset>
                    <legend>Additional</legend>
                    <textarea name="additional" id="additional" cols="60" rows="10"> <?php echo $editOrder['ADDITIONAL']; ?></textarea>
                </fieldset>
                <div class="button-submit-reset">
                    <button class="btn btn-send" name="submit" type="submit" id="">Update</button>
                    <button class="btn btn-noSend" name="reset" id="">
                        <a href="viewOrder.php?>">
                            Cancell
                        </a>
                    </button>
                </div>
            </form>
        </section>
    </main>
<?php
    // Footer where the copyright is placed
    require('./inc/globalFooter.php');
} else {
    header("Location: viewProfile.php");
    exit;
}
?>