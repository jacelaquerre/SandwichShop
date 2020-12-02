<?php
include ("top.php");

// Get URL
$thisURL = DOMAIN . PHP_SELF;

$orderNum = 0;
$phone = "";

$orderNumError = false;
$phoneError = false;

$errorMsg = array();

if (isset($_GET["btnSubmit"])) {
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // Security
    //
    if (securityCheck($thisURL)) {
        $msg = '<p class="container">Sorry you cannot access this page. ';
        $msg .= 'Security breach detected and reported.</p>';
        print($msg);
    }

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // Sanitize (clean) data
    $orderNum = htmlentities($_GET["order"], ENT_QUOTES, "UTF-8");
    $phone = htmlentities($_GET["phone"], ENT_QUOTES, "UTF-8");
    //eliminate every char except 0-9
    $phone = preg_replace("/[^0-9]/", '', $phone);
    //eliminate leading 1 if its there
    if (strlen($phone) == 11) {
        $phone = preg_replace("/^1/", '', $phone);
    }

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2c Validation
    //
    if ($orderNum == "" and $phone == "") {
        $errorMsg[] = 'Please enter either your order number or phone number.';
        $orderNumError = true;
        $phoneError = true;
    } else if ($orderNum != "" and $phone == "") {
        if ($orderNum == "") {
            $errorMsg[] = 'Please enter your order number.';
            $orderNumError = true;
        } elseif (!verifyNumeric($orderNum)) {
            $errorMsg[] = 'Your order number appears to be incorrect.';
            $phoneError = true;
        }
    } else if ($orderNum == "" and $phone != "") {
        if ($phone == "" or strlen($phone) != 10) {
            $errorMsg[] = 'Please enter your phone number.';
            $phoneError = true;
        } elseif (!verifyPhone($phone)) {
            $errorMsg[] = 'Your phone number appears to be incorrect.';
            $phoneError = true;
        }
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
        if ($orderNum != "" and $phone == "") {
            $updateOrderNum = $orderNum;
            $updateOrderPhone = "";
        } else if ($orderNum == "" and $phone != "") {
            $updateOrderNum = 0;
            $updateOrderPhone = $phone;
        }
        header('Location: https://jlaquerr.w3.uvm.edu/cs148/live-final/updateForm.php');
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
          method = "get">
        <fieldset class="contact">
            <legend class="legend">Search by Order Number</legend>
            <label for="order">Order #</label>
            <input type="text" id="order" name="order">
        </fieldset>

        <fieldset class="contact">
            <legend class="legend">Search by Phone Number</legend>
            <label for="phone">Phone #</label>
            <input type="text" id="phone" name="phone">
        </fieldset>

        <!-- Start Submit button -->
        <fieldset class="buttons">
            <legend class="legend">Lookup Order</legend>
            <input
                    class="button"
                    id="btnSubmit"
                    name="btnSubmit"
                    tabindex="1500"
                    type="submit"
                    value="Update">
        </fieldset>
        <!-- ends submit button -->
    </form>
</main>
<?php
include ("footer.php");
?>
