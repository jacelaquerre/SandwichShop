<!-- ######################     Main Navigation   ########################## -->
<nav>
    <ul>
        <?php
        // This sets a class for current page so you can style it differently

        print '<li ';
        if (PATH_PARTS['filename'] == 'index') {
            print ' class="activePage" ';
        }
        print '><a href="index.php">Home</a></li>';

        print '<li ';
        if (PATH_PARTS['filename'] == 'order') {
            print ' class="activePage" ';
        }
        print '><a href="order.php">Order</a></li>';

        print '<li ';
        if (PATH_PARTS['filename'] == 'about') {
            print ' class="activePage" ';
        }
        print '><a href="about.php">About</a></li>';

        print '<li ';
        if (PATH_PARTS['filename'] == 'menu') {
            print ' class="activePage" ';
        }
        print '><a href="menu.php">Menu</a></li>';

        print '<li ';
        if (PATH_PARTS['filename'] == 'updateOrder') {
            print ' class="activePage" ';
        }
        print '><a href="updateOrder.php">Update Order</a></li>';


        ?>
    </ul>

</nav>
<!-- ###################### End Of Main Navigation ########################## -->