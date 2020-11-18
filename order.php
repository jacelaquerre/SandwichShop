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
$thisURL = DOMAIN . PHP_SELF;
$deliveryOption = "pickup";
$instructions = "";
$name = "";
$phone = "";
$email = "youremail@uvm.edu";
$street = "";
$town = "";
$state = "";
$zipcode = "";

$deliveryOptionError = false;
$instructionsError = false;
$nameError = false;
$phoneError = false;
$emailError = false;
$streetError = false;
$townError = false;
$stateError = false;
$zipcodeError = false;


//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// misc variables

$errorMsg = array();

$mailed = false;

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// Process for when the form is submitted
//
if (isset($_POST["btnSubmit"])) {

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // Security
    //
    if (!securityCheck($thisURL)) {
        $msg = '<p>Sorry you cannot access this page. ';
        $msg .= 'Security breach detected and reported.</p>';
        die($msg);
    }

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // Sanitize (clean) data

    $deliveryOption = htmlentities($_GET["deliveryOption"], ENT_QUOTES, "UTF-8");
    $instructions = htmlentities($_GET["instructions"], ENT_QUOTES, "UTF-8");
    $name = htmlentities($_GET["name"], ENT_QUOTES, "UTF-8");
    $email = filter_var($_GET["email"], FILTER_SANITIZE_EMAIL);
    $phone = htmlentities($_GET["phone"], ENT_QUOTES, "UTF-8");
    //eliminate every char except 0-9
    $phone = preg_replace("/[^0-9]/", '', $phone);
    //eliminate leading 1 if its there
    if (strlen($phone) == 11) {
        $phone = preg_replace("/^1/", '', $phone);
    }
    $street = htmlentities($_GET["street"], ENT_QUOTES, "UTF-8");
    $town = htmlentities($_GET["town"], ENT_QUOTES, "UTF-8");
    $state = htmlentities($_GET["state"], ENT_QUOTES, "UTF-8");
    $zipcode = htmlentities($_GET["town"], ENT_QUOTES, "UTF-8");

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2c Validation
    //
    if ($deliveryOption != "pickup" and $deliveryOption != "delivery") {
        $errorMsg[] = "Please choose a delivery option.";
        $deliveryOptionError = true;
    }

    if ($instructions != "") {
        if (!verifyAlphaNum($instructions)) {
            $errorMsg[] = "Your comments appear to have extra characters that are not allowed.";
            $instructionsError = true;
        }
    }

    if ($name == "") {
        $errorMsg[] = "Please enter your name.";
        $nameError = true;
    } else {
        if (!verifyAlphaNum($street)) {
            $errorMsg[] = "Your street address appears to have extra characters that are not allowed.";
            $streetError = true;
        }
    }

    if ($email == "" or $email == "youremail@uvm.edu") {
        $errorMsg[] = 'Please enter your email address.';
        $emailERROR = true;
    } elseif (!verifyEmail($email)) {
        $errorMsg[] = 'Your email address appears to be incorrect.';
        $emailERROR = true;
    }

    if ($phone == "" or strlen($phone) != 10) {
        $errorMsg[] = 'Please enter your phone number.';
        $phoneError = true;
    } elseif (!verifyPhone($phone)) {
        $errorMsg[] = 'Your phone number appears to be incorrect.';
        $phoneError = true;
    }

    if ($street == "") {
        $errorMsg[] = 'Please enter your street address.';
        $streetError = true;
    } else {
        if (!verifyAlphaNum($street)) {
            $errorMsg[] = "Your street address appears to have extra characters that are not allowed.";
            $streetError = true;
        }
    }

    if ($town == "") {
        $errorMsg[] = 'Please enter your town.';
        $townError = true;
    } else {
        if (!verifyAlphaNum($town)) {
            $errorMsg[] = "Your town appears to have extra characters that are not allowed.";
            $townError = true;
        }
    }

    if ($state == "") {
        $errorMsg[] = 'Please enter your state.';
        $stateError = true;
    } else {
        if (!verifyAlphaNum($state)) {
            $errorMsg[] = "Your state appears to have extra characters that are not allowed.";
            $stateError = true;
        }
    }

    if (!(preg_match('#[0-9]{5}#', $zipcode))) {
        $errorMsg[] = 'Your zipcode appears to be incorrect.';
        $zipcodeError = true;
    }

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // Process Form - Passed Validation
    //
    if (!$errorMsg) {
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // Save Data
        //
        // This block saves the data to the SQL database

        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // Create message
        //
        $message = '<h2>Your information:</h2>';

        foreach ($_GET as $htmlName => $value) {

            $message .= '<p>';

            $camelCase = preg_split('/(?=[A-Z])/', substr($htmlName, 3));

            foreach ($camelCase as $oneWord) {
                $message .= $oneWord . ' ';
            }

            $message .= ' = ' . htmlentities($value, ENT_QUOTES, "UTF-8") . '</p>';
        }

        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // Mail to user
        //

        $to = $email; // the person who filled out the form
        $cc = '';
        $bcc = '';

        $from = 'customer.service@sandwiches.com';

        // subject of main should make sense to your form
        $subject = 'Your sandwiches order: ';

        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);
    } // end if form is valid
} // ends if from was submitted
?>

<article id="main">

<?php
if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { //closing if marked with: end body submit
    print '<h2>Thank you for providing your information.</h2>';

    print '<p>For your records a copy of this data has ';

    if (!$mailed) {
        print "not ";
    }

    print 'been sent: </p>';
    print '<p> To: ' . $email . '</p>';

    print $message;
} else {
    print '';

    //#########################################################################
    //
    // Error Messages
    //

    if ($errorMsg) {
        print '<div id="errors">' . PHP_EOL;
        print '<h2>Your form has the following mistakes that need to be fixed.</h2>' . PHP_EOL;
        print '<ol>' . PHP_EOL;

        foreach ($errorMsg as $err) {
            print '<li>' . $err . '</li>' . PHP_EOL;
        }
        print '</ol>' . PHP_EOL;
        print '</div>' . PHP_EOL;
    }
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
                <label for="instructions">Please List Any Additional Instructions</label>
                <input type="text" id="instructions" name="instructions">
            </fieldset>
        </form>

        <form action = "<?php print PHP_SELF; ?>"
              id="frmContact"
              method = "get">
            <fieldset class="contact">
                <label for="name">Name</label>
                <input type="text" id="name" name="name">
                <label for="email">Email</label>
                <input type="text" id="email" name="email">
                <label for="phone">Phone #</label>
                <input type="text" id="phone" name="phone">
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
        <form>
            <fieldset class="buttons">
                <input
                    class="button"
                    id="btnSubmit"
                    name="btnSubmit"
                    tabindex="1500"
                    type="submit"
                    value="Submit">
            </fieldset> <!-- ends submit button -->
        </form>
    </main>
    <?php
    } //end body submit
    ?>
</article>
<?php
include ("footer.php");
?>