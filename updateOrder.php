<?php
include ("top.php");
?>
<main>
    <p>If you wish to change your order after you have submitted it, you can do so by looking it up below.</p>
    <form action = "<?php print PHP_SELF; ?>"
          id="frmOption"
          method = "post">
        <fieldset class="contact">
            <legend class="legend">Search by Order Number</legend>
            <label for="order">Order #</label>
            <input type="text" id="order" name="order">
        </fieldset>

        <fieldset class="contact">
            <legend class="legend">Search by Phone Number</legend>
            <label for="order">Phone #</label>
            <input type="text" id="order" name="order">
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
