<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- ######################   Page Top   ############################## -->
        <meta charset="utf-8">
        <title>Name TBD</title>
        <meta name="author" content="Matt Zahar & Jace Laquerre">
        <meta name="description" content="CS148 final project">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="js/quantity.js"></script>
        <!--
        <link rel="stylesheet" href="css/custom2.css">
        -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

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

