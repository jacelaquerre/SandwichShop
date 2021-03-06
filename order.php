<?php
include ("top.php");

// Get URL
$thisURL = DOMAIN . PHP_SELF;

$deliveryOption = "pickup";
$name = "";
$phone = "";
$email = "";
$street = "";
$town = "";
$state = "";
$zipcode = "";
$messages = [];
$dict = [];
$updating = false;

$updateOrderNum = "";
$customerID = 0;

$query = "SELECT * FROM `Sandwiches`";

if ($thisDatabaseReader->querySecurityOk($query, 0, 0, 0, 0, 0)) {
    $query = $thisDatabaseReader->sanitizeQuery($query, 0, 0, 0, 0, 0);
    $sandwiches = $thisDatabaseReader->select($query, '');
}

if (isset($_GET["updateOrderNum"])) {
    $updateOrderNum = $_GET["updateOrderNum"];
    $updating = true;

    $query = "SELECT * FROM `Orders` 
           LEFT JOIN Customer ON Customer.Customer_ID = `cust_id`
           LEFT JOIN Cart ON Cart.Cart_OrderNum = `Order_Num`
           LEFT JOIN Sandwiches ON Sandwiches.Sandwich_Code = Cart.Cart_SandwhichCode
               WHERE `Order_Num` = ?";

    if ($thisDatabaseReader->querySecurityOk($query, 1, 0, 0, 0, 0)) {
        $query = $thisDatabaseReader->sanitizeQuery($query, 1, 0, 1, 0, 0);
        $records = $thisDatabaseReader->select($query, array($updateOrderNum));
    }

    foreach ($records as $record) {
        $deliveryOption = $record['Order_Type'];
        $name = $record['Customer_Name'];
        $street = $record['Customer_Street'];
        $town = $record['Customer_City'];
        $state = $record['Customer_State'];
        $zipcode = $record['Customer_Zip'];
        $email = $record['Customer_Email'];
        $phone = $record['Customer_Phone'];
        $customerID = $record['Customer_ID'];
        foreach ($sandwiches as $sandwich) {
            if ($sandwich["Sandwich_Name"] == $record["Sandwich_Name"]) {
                $dict[$sandwich["Sandwich_Name"]] = $record["Cart_Quantity"];
            }
        }
        $record['Cart_OrderNum'];
        $record['Cart_SandwhichCode'];
        print PHP_EOL;
    }
} else {
    foreach ($sandwiches as $sandwich) {
        $dict[$sandwich["Sandwich_Name"]] = 0;
    }
}

// Initialize error flags
$deliveryOptionError = false;
$quantityError = false;
$nameError = false;
$phoneError = false;
$emailError = false;
$streetError = false;
$townError = false;
$stateError = false;
$zipcodeError = false;
$errorMsg = array();
$mailed = false;

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// Process for when the form is submitted
//
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

    $deliveryOption = htmlentities($_GET["deliveryOption"], ENT_QUOTES, "UTF-8");
    foreach ($sandwiches as $sandwich) {
        $dict[$sandwich["Sandwich_Name"]] = htmlentities($_GET[$sandwich["Sandwich_Name"]], ENT_QUOTES, "UTF-8");
    }
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
    $zipcode = htmlentities($_GET["zip"], ENT_QUOTES, "UTF-8");
    $updating = htmlentities($_GET["updating"], ENT_QUOTES, "UTF-8");
    $updateOrderNum = htmlentities($_GET["updateOrderNum"], ENT_QUOTES, "UTF-8");
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    // 
    // SECTION: 2c Validation
    //
    if ($deliveryOption != "pickup" and $deliveryOption != "delivery" and $deliveryOption != "cless_delivery") {
        $errorMsg[] = "Please choose a delivery option.";
        $deliveryOptionError = true;
    }

    foreach ($dict as $quantity) {
        if (!verifyNumeric($quantity)) {
            $errorMsg[] = "Your sandwich quantity values appear to be incorrect.";
            $quantityError = true;
        }
        if ($quantity < 0) {
            $errorMsg[] = "Your sandwich quantity values cannot be negative.";
            $quantityError = true;
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

    if (!(preg_match('/^\d{5}$/', substr($zipcode, 0), $matches))) {
        $errorMsg[] = 'Your zipcode appears to be incorrect.';
        $zipcodeError = false;
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
        // This block saves the data to the SQL database

        // get current date/time
        $date = date('Y-m-d H:i:s');
        if ($updating) {
            $query = "UPDATE `Customer` 
                         SET `Customer_Name`= ?,
                             `Customer_Street`= ?, `Customer_City`= ?,`Customer_State`= ?,
                             `Customer_Zip`= ?,`Customer_Email`= ?,`Customer_Phone`= ? 
                       WHERE `Customer_ID`= ?";
            if ($thisDatabaseWriter->querySecurityOk($query, 1, 0, 0, 0, 0)) {
                $query = $thisDatabaseWriter->sanitizeQuery($query, 0, 0, 0, 0, 0);
                $thisDatabaseWriter->update($query, array($name, $street, $town, $state, strval($zipcode), $email, $phone, $customerID));
            }

            $query = "UPDATE `Orders` 
                         SET `Order_Date`= ?,`Order_Type` = ? 
                       WHERE `Order_Num` = ?";
            if ($thisDatabaseWriter->querySecurityOk($query, 1, 0, 0, 0, 0)) {
                $query = $thisDatabaseWriter->sanitizeQuery($query, 0, 0, 0, 0, 0);
                $thisDatabaseWriter->update($query, array($date, $deliveryOption, $updateOrderNum));
            }

            foreach ($sandwiches as $sandwich) {
                $query = "UPDATE `Cart`
                             SET `Cart_Quantity`= ?
                           WHERE `Cart_OrderNum`= ? AND `Cart_SandwhichCode`= ?";
                if ($thisDatabaseWriter->querySecurityOk($query, 1, 1, 0, 0, 0)) {
                    $query = $thisDatabaseWriter->sanitizeQuery($query, 0, 0, 0, 0, 0);
                    $thisDatabaseWriter->update($query, array($dict[$sandwich["Sandwich_Name"]], $updateOrderNum, $sandwich["Sandwich_Code"]));
                }
            }

        } else {
            $query = "INSERT INTO `Customer`(`Customer_ID`, `Customer_Name`, `Customer_Street`, 
                       `Customer_City`, `Customer_State`, `Customer_Zip`, `Customer_Email`, `Customer_Phone`) 
                           VALUES (?,?,?,?,?,?,?,?)";
            if ($thisDatabaseWriter->querySecurityOk($query, 0, 0, 0, 0, 0)) {
                $query = $thisDatabaseWriter->sanitizeQuery($query, 0, 0, 0, 0, 0);
                $thisDatabaseWriter->insert($query, array(null, $name, $street, $town, $state, strval($zipcode), $email, $phone));
                $customerID = $thisDatabaseWriter->lastInsert();
            }

            $orderID = 0;
            $query = "INSERT INTO `Orders`(`Order_Num`, `Order_Date`, `Order_Type`, `cust_id`)
                           VALUES (?,?,?,?)";
            if ($thisDatabaseWriter->querySecurityOk($query, 0, 0, 0, 0, 0)) {
                $query = $thisDatabaseWriter->sanitizeQuery($query, 0, 0, 0, 0, 0);
                $thisDatabaseWriter->insert($query, array(null, $date, $deliveryOption, $customerID));
                $orderID = $thisDatabaseWriter->lastInsert();
            }

            foreach ($sandwiches as $sandwich) {
                $query = "INSERT INTO `Cart`(`Cart_OrderNum`, `Cart_SandwhichCode`, `Cart_Quantity`) 
                               VALUES (?,?,?)";
                if ($thisDatabaseWriter->querySecurityOk($query, 0, 0, 0, 0, 0)) {
                    $query = $thisDatabaseWriter->sanitizeQuery($query, 0, 0, 0, 0, 0);
                    $thisDatabaseWriter->insert($query, array($orderID, $sandwich["Sandwich_Code"], $dict[$sandwich["Sandwich_Name"]]));
                }
            }
        }

        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // Create message
        //
        $message = "";
        if ($updating) {
            $message .= '<h3> Your order number is: #' . $updateOrderNum . '</h3>';
        } else {
            $message .= '<h3> Your order number is: #' . $orderID . '</h3>';
        }

        $message .= '<table>';
        $total = 0;
        foreach($sandwiches as $sandwich) {
            if ($dict[$sandwich["Sandwich_Name"]] > 0) {
                $total = $total + ($sandwich["Price"] * $dict[$sandwich["Sandwich_Name"]]);
                $message .= '<tr>';
                $message .= '<td>' . htmlentities($sandwich["Sandwich_Name"], ENT_QUOTES, "UTF-8") . '</td>';
                $message .= '<td>' . htmlentities($dict[$sandwich["Sandwich_Name"]], ENT_QUOTES, "UTF-8") . '</td>';
                $message .= '</tr>' . PHP_EOL;
            }
        }
        $message .= '</table>';
        $formattedTotal = "$" . number_format($total, 2, '.', ',');
        $message .= '<h3> Your Total is ' . $formattedTotal . '</h3>';
        $message .= '<p>Thank you for your business!</p>';

        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // Mail to user
        //

        $to = $email; // the person who filled out the form
        $cc = 'mzahar@uvm.edu';
        $bcc = '';

        $from = 'mzahar@uvm.edu';

        // subject of main should make sense to your form
        $subject = 'Your sandwiches order: ';

        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);
    } // end if form is valid
} // ends if from was submitted
?>

<article id="main" class="container">

<?php
if (isset($_GET["btnSubmit"]) AND empty($errorMsg)) { //closing if marked with: end body submit
    print '<h1>You Order Has Been Received</h1>';

    print '<h2>For your records a copy of this data has ';

    if (!$mailed) {
        print "not ";
    }

    print 'been sent: </h2>';
    print '<h2> To: ' . $email . '</h2>';

    print $message;
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
    ?>
    <section>
        <form action = "<?php print PHP_SELF; ?>"
              id="frmOption"
              method = "get"
              class = "form_container">
            <fieldset class="deliveryOption row">
                <section class="col-25">
                    <h4>Delivery Option</h4>
                </section>
                <section class="col-75">
                    <input type="radio" id="pickup" name="deliveryOption" value=pickup <?php if($deliveryOption === 'pickup') echo 'checked'; ?>>
                    <label for="pickup">Pick Up</label>
                    <input type="radio" id="delivery" name="deliveryOption" value=delivery <?php if($deliveryOption === 'delivery') echo 'checked'; ?>>
                    <label for="delivery">Delivery</label>
                    <input type="radio" id="cless_delivery" name="deliveryOption" value=cless_delivery <?php if($deliveryOption === 'cless_delivery') echo 'checked'; ?>>
                    <label for="cless_delivery">Contactless Delivery</label>
                </section>
            </fieldset>

            <fieldset class="row">
                <section class="col-25">
                    <h4>Select Your Sandwiches</h4>
                </section>
                
                <section class="col-75">
                    <?php
                    foreach ($sandwiches as $sandwich) {
                        print '<p>';
                        $english_format_money = "$" . number_format($sandwich["Price"], 2, '.', ',');
                        print '<input type= "number" value="';

                        if (isset($dict[$sandwich["Sandwich_Name"]])) {
                            echo $dict[$sandwich["Sandwich_Name"]];
                        }
                        else{
                            echo 0;
                        }

                        print '" name="' . $sandwich["Sandwich_Name"] . '" id="' . $sandwich["Sandwich_Name"] .'">';
                        print '<label for="' . $sandwich["Sandwich_Name"] . '">' . $sandwich["Sandwich_Name"] . "      " .  $english_format_money . '</label>';
                        print '</p>';
                    }
                    ?>
                </section>
            </fieldset>

            <fieldset class="contact row">
                <section class="col-25">
                    <h4>Contact Information</h4>
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
                    <h4>Delivery Information</h4>
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
            <input type="hidden" name="updating" value="<?php echo $updating; ?>">
            <input type="hidden" name="updateOrderNum" value="<?php echo $updateOrderNum; ?>">
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
    <?php
    } //end body submit
    ?>
</article>
<?php
include ("footer.php");
?>
