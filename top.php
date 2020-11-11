<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- ######################   Page Top   ############################## -->
        <meta charset="utf-8">
        <title>Name TBD</title>
        <meta name="author" content="Matt Zahar & Jace Laquerre">
        <meta name="description" content="CS148 final project">
        <script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="js/quantity.js"></script>
        <link rel="stylesheet" href="css/custom2.css">

        <?php
        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        //
        // inlcude all libraries.
        //
        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        print '<!-- begin including libraries -->';

        include 'lib/constants.php';

        include LIB_PATH . '/Connect-With-Database.php';

        print '<!-- libraries complete-->';
        ?>
    </head>
    <!-- ######################   End of Page Top   ############################## -->
    <!-- ######################     Start of Body   ############################ -->
    <?php
        print '<!-- #### Start of Body #### -->';
        include("header.php");
        print PHP_EOL;
        include("nav.php");
    ?>

