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
?>
<main>
    <form action = "<?php print PHP_SELF; ?>"
          id="frmOption"
          method = "get">
        <fieldset class="buttons">
            <legend>Delivery Option</legend>
            <input type="radio" id="delivery" name="deliveryOption" value="delivery">
            <label for="delivery">Delivery</label>
            <input type="radio" id="pickup" name="deliveryOption" value="pickup">
            <label for="pickup">Pick Up</label>
        </fieldset>
    </form>

    <form action = "<?php print PHP_SELF; ?>"
          id="frmSandwhich"
          method = "get">
        <fieldset class="checkbox">
            <legend class="legend">Select Your Sandwiches</legend>
            <p class="left">
            <p>---------------</p>
                <?php
                print'<p>++++++++++++++</p>';
                $query = "SELECT * FROM `Sandwiches`";
                if ($thisDatabaseReader->querySecurityOk($query, 0,0,0,0,0)) {
                    $query = $thisDatabaseReader->sanitizeQuery($query, 0, 0, 0, 0, 0);
                    $sandwiches = $thisDatabaseReader->select($query, '');
                    print"<p>Passed security </p>";
                }
                //print '<p>Post Array:</p><pre>';
                //print_r($sandwiches);
                print"<p>Reached </p>";
                foreach ($sandwiches as $sandwich) {
                    print'<input type="button" value="-" class="minus">';
                    print '<input type="number" step="1" min="0" max="" name="quantity" 
                            value="0" title="Qty" class="input-text qty text" 
                            size="4" pattern="" inputmode="">';
                    print '<input type="button" value="+" class="plus">';
                    print $sandwich["Sandwich_Name"];
                    print $sandwich["Price"];
                    print $sandwich["Description"];
                }
                ?>
            </p>
        </fieldset>
    </form>
    <?php
        $option = $_GET['btn'];
        //print '<p>Post Array:</p><pre>';
        //print_r($_POST);

        // process from when its submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $dataIsGood = true;
        }
    ?>
    <body>
        <p class="quantity buttons_added">
            <input type="button" value="-" class="minus">
            <input type="number" step="1" min="0" max="" name="quantity"
                   value="0" title="Qty" class="input-text qty text"
                   size="4" pattern="" inputmode="">
            <input type="button" value="+" class="plus">
        </p>
    </body>
    <?php
        $option = $_GET['btn'];
    ?>
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