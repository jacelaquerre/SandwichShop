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
            <input type="button" value="pickup" name="btn"/>
            <input type="button" value="delivery" name="btn"/>
        </fieldset>
    </form>

    <form action = "<?php print PHP_SELF; ?>"
          id="frmSandwhich"
          method = "get">
        <fieldset class="checkbox">
            <legend class="legend">Select Your Sandwiches</legend>

            <p class="left">
                <label class="check-field">
                    <input
                        id="chkBLT"
                        name="chkBLT"
                        tabindex="800"
                        type="checkbox"
                        value="blt">BLT</label>
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

        $query = "SELECT * FROM `Sandwiches`";
        if ($thisDatabaseReader->querySecurityOk($query, 0,0,0,0,0)) {
            $query = $thisDatabaseReader->sanitizeQuery($query, 0, 0, 0, 0, 0);
            $sandwiches = $thisDatabaseReader->select($query, '');
        }
        print '<p>Post Array:</p><pre>';
        print_r($_POST);
        foreach ($sandwiches as $sandwich) {
            print '<p><input type="checkbox" id="' . $sandwich["Sandwich_Code"] . '" name="checklist[]" value="' . $sandwich["Sandwich_Code"] . '">';
            print $sandwich["Sandwich_Name"];
            print $sandwich["Description"];
            $sandwich["Price"];
            print "</input></p>";
        }


    ?>
    <body>
    <div class="quantity buttons_added">
        <input type="button" value="-" class="minus"><input type="number" step="1" min="0" max="" name="quantity" value="0" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" class="plus">
    </div>
    </body>
    <?php
        $option = $_GET['btn'];
    ?>
    <!-- Start Submit button -->
    <fieldset class="buttons">
        <legend class="legend">Submit</legend>
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