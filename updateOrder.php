<?php
include ("top.php");
?>
<main>
    <form action = "<?php print PHP_SELF; ?>"
          id="frmOption"
          method = "post">
        <fieldset class="contact">
            <label for="name">Order #</label>
            <input type="text" id="order" name="order">
        </fieldset>    
    </form>

</main>
<?php
include ("footer.php");
?>