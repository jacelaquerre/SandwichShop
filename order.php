<?php
include ("top.php");

//Sanitize function from the text
function getData($field) {
    if(!isset($_GET[$field])) {
        $data = "";

    } else {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data);
    }
    return $data;
}

$deliveryOption = "pickup";
?>
<main>
    <form action = "<?php print PHP_SELF; ?>"
          id="frmOption"
          method = "post">
        <fieldset class="deliveryOption">
            <legend>Delivery Option</legend>
            <input type="radio" id="pickup" name="deliveryOption" value="pickup">
            <label for="pickup">Pick Up</label>
            <input type="radio" id="delivery" name="deliveryOption" value="delivery">
            <label for="delivery">Delivery</label>
        </fieldset>
    </form>

    <form action = "<?php print PHP_SELF; ?>"
          id="frmSandwhich"
          method = "get">
        <fieldset class="checkbox">
            <legend class="legend">Select Your Sandwiches</legend>
            <p class="left">
                <?php
                $query = "SELECT * FROM `Sandwiches`";
                if ($thisDatabaseReader->querySecurityOk($query, 0,0,0,0,0)) {
                    $query = $thisDatabaseReader->sanitizeQuery($query, 0, 0, 0, 0, 0);
                    $sandwiches = $thisDatabaseReader->select($query, '');
                }

                foreach ($sandwiches as $sandwich) {
                    print '<p class="quantity buttons_added">';
                    print'<input type="button" value="-" class="minus">';
                    print '<input type="number" step="1" min="0" max="" name="quantity" 
                            value="0" title="Qty" class="input-text qty text" 
                            size="4" pattern="" inputmode="">';
                    print '<input type="button" value="+" class="plus">';
                    print $sandwich["Sandwich_Name"]. "     ";
                    $english_format_money = "$" . number_format($sandwich["Price"], 2, '.', ',');
                    print $english_format_money;
                    print $sandwich["Description"];
                    print '</p>';

                }
                ?>
            </p>
        </fieldset>
    </form>
    <form action = "<?php print PHP_SELF; ?>"
          id="frmInstructions"
          method = "get">
        <fieldset class="instructions">
            <label for="instructions">Please Any Additional Instructions</label>
            <input type="text" id="instructions" name="instructions">
        </fieldset>
    </form>

    <form action = "<?php print PHP_SELF; ?>"
          id="frmContact"
          method = "get">
        <fieldset class="contact">
            <label for="name">Name</label>
            <input type="text" id="name" name="name">
            <label for="phone">Phone #</label>
            <input type="text" id="phone" name="phone">
            <label for="email">Email</label>
            <input type="text" id="email" name="email">
        </fieldset>

        <fieldset class="address">
        <label for="street">Street Address</label>
        <input type="text" id="street" name="street">
        <label for="town">Town</label>
        <input type="text" id="town" name="town">
        <label for="state">State</label>
        <input type="text" id="state" name="state">
        <label for="zip">Zip Code</label>
        <input type="text" id="zip" name="zip">
        </fieldset>

    </form>
    <!-- Start Submit button -->
    <fieldset class="buttons">
        <input
            class="button"
            id="btnSubmit"
            name="btnSubmit"
            tabindex="1500"
            type="submit"
            value="Submit">

    </fieldset> <!-- ends submit button -->
</main>
<?php
include ("footer.php");
?>