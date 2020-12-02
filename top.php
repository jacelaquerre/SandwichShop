<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- ######################   Page Top   ############################## -->
        <meta charset="utf-8">
        <title>Bob's Sandwiches</title>
        <meta name="author" content="Matt Zahar & Jace Laquerre">
        <meta name="description" content="CS148 final project">
        <script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="js/quantity.js"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/custom4.css">

        <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
        <meta name="apple-mobile-web-app-title" content="Bob's Sandwich">
        <meta name="application-name" content="Bob's Sandwich">
        <link rel="manifest" href="favicon/site.webmanifest">
        <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#ff0000">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <?php
        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        //
        // inlcude all libraries.
        //
        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        print '<!-- begin including libraries -->';

        include 'lib/constants.php';
        include LIB_PATH . '/security.php';
        include LIB_PATH . '/mail-message.php';
        include LIB_PATH . '/validation-functions.php';
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
