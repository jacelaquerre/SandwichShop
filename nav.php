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
        if (PATH_PARTS['filename'] == 'subject') {
            print ' class="activePage" ';
        }
        print '><a href="subjects.php">Subjects</a></li>';

        print '<li ';
        if (PATH_PARTS['filename'] == 'classes') {
            print ' class="activePage" ';
        }
        print '><a href="classes.php">Classes</a></li>';


        ?>
    </ul>

</nav>
<!-- ###################### End Of Main Navigation ########################## -->