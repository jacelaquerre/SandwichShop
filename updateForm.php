<?php
include ("top.php");
?>
<main>
    <section>
        <form action = "<?php print PHP_SELF; ?>"
              id="frmOption"
              method = "get"
              class = "form_container">
            <fieldset class="deliveryOption row">
                <section class="col-25">
                    <legend>Delivery Option</legend>
                </section>
                <section class="col-75">
                    <input type="radio" id="pickup" name="deliveryOption" value=pickup <?php //if($deliveryOption === 'pickup') echo 'checked'; ?>>
                    <label for="pickup">Pick Up</label>
                    <input type="radio" id="delivery" name="deliveryOption" value=delivery <?php //if($deliveryOption === 'delivery') echo 'checked'; ?>>
                    <label for="delivery">Delivery</label>
                    <input type="radio" id="cless_delivery" name="deliveryOption" value=cless_delivery <?php //if($deliveryOption === 'cless_delivery') echo 'checked'; ?>>
                    <label for="cless_delivery">Contactless Delivery</label>
                </section>
            </fieldset>

            <fieldset class="row">
                <section class="col-25">
                    <legend class="legend">Select Your Sandwiches</legend>
                </section>

                <section class="col-75">
                    <?php
//                    foreach ($sandwiches as $sandwich) {
//                        print '<p>';
//                        $english_format_money = "$" . number_format($sandwich["Price"], 2, '.', ',');
//                        print '<input type="number" value="';
//
//                        if (isset($dict[$sandwich[ "Sandwich_Name"]]))
//                            echo $dict[$sandwich["Sandwich_Name"]];
//
//                        print '"name="' . $sandwich["Sandwich_Name"] . '">';
//                        print '<label for="' . $sandwich["Sandwich_Name"] . '">' . $sandwich["Sandwich_Name"] . "      " .  $english_format_money . '</label>';
//                        print '</p>';
//                    }
                    ?>
                </section>
            </fieldset>

            <fieldset class="contact row">
                <section class="col-25">
                    <legend class="legend">Contact Information</legend>
                </section>
                <section class="col-75">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?php if (isset($name)) echo $name; ?>">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" value="<?php if (isset($email)) echo $email; ?>">
                    <label for="phone">Phone #</label>
                    <input type="text" id="phone" name="phone" value="<?php if (isset($phone)) echo $phone; ?>">
                </section>
            </fieldset>

            <fieldset class="address row">
                <section class="col-25">
                    <legend class="legend">Delivery Information</legend>
                </section>
                <section class="col-75">
                    <label for="street">Street Address</label>
                    <input type="text" id="street" name="street" value="<?php if (isset($street)) echo $street; ?>">
                    <label for="town">Town</label>
                    <input type="text" id="town" name="town" value="<?php if (isset($town)) echo $town; ?>">
                    <label for="state">State</label>
                    <input type="text" id="state" name="state" value="<?php if (isset($state)) echo $state; ?>">
                    <label for="zip">Zip Code</label>
                    <input type="text" id="zip" name="zip" value="<?php if (isset($zipcode)) echo $zipcode; ?>">
                </section>
            </fieldset>

            <!-- Start Submit button -->
            <fieldset class="buttons row">
                <input
                    class="button"
                    id="btnSubmit"
                    name="btnSubmit"
                    type="submit"
                    value="Submit">
            </fieldset>
            <!-- ends submit button -->
        </form>
    </section>
</main>

<?php
include ("footer.php");
?>