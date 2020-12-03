<?php
include ("top.php");

// Get URL
$thisURL = DOMAIN . PHP_SELF;

$orderNum = 0;

$orderNumError = false;

$errorMsg = array();

if (isset($_GET["btnSubmit"])) {
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // Security
    //
    //    if (securityCheck($thisURL)) {
    //        $msg = '<p class="container">Sorry you cannot access this page. ';
    //        $msg .= 'Security breach detected and reported.</p>';
    //        print($msg);
    //    }

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // Sanitize (clean) data
    $orderNum = htmlentities($_GET["order"], ENT_QUOTES, "UTF-8");

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2c Validation
    //
    if ($orderNum == "") {
        $errorMsg[] = 'Please enter your order number.';
        $orderNumError = true;
    } elseif (!verifyNumeric($orderNum)) {
        $errorMsg[] = 'Your order number appears to be incorrect.';
        $phoneError = true;
    }

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // Process Form - Passed Validation
    //
    if (empty($errorMsg)) {
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // Save Data
        //
        // This block saves the data to the global variables in top to pass to next form
        header('Location: https://mzahar.w3.uvm.edu/cs148/final/order.php' . '?updateOrderNum=' . strval($orderNum));
    } else {
        print '';

        //#########################################################################
        //
        // Error Messages
        //
        if ($errorMsg) {
            print '<section id="errors">' . PHP_EOL;
            print '<h3>Your form has the following mistakes that need to be fixed.</h3>' . PHP_EOL;
            print '<ol>' . PHP_EOL;

            foreach ($errorMsg as $err) {
                print '<li>' . $err . '</li>' . PHP_EOL;
            }
            print '</ol>' . PHP_EOL;
            print '</section>' . PHP_EOL;
        }
    }
}
?>
<main>
    <p>If you wish to change your order after you have submitted it, you can do so by looking it up below.</p>
    <form action = "<?php print PHP_SELF; ?>"
          id="frmOption"
          method = "get"
          class="form_container">
        <fieldset class="contact row">
            <section class="col-25">
                <legend class="legend">Search by Order Number</legend>
            </section>
            <section class="col-75">
                <label for="order">Order #</label>
                <input type="text" id="order" name="order">
            </section>
        </fieldset>

        <!-- Start Submit button -->
        <fieldset class="buttons row">
            <section class="col-25">
                <legend class="legend">Lookup Order</legend>
            </section>
            <section class="col-75">
                <input
                        class="button"
                        id="btnSubmit"
                        name="btnSubmit"
                        tabindex="1500"
                        type="submit"
                        value="Update">
            </section>
        </fieldset>
        <!-- ends submit button -->
    </form>
</main>
<?php
include ("footer.php");
?>
