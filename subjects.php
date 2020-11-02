<?php
include ("top.php");
?>
    <?php

    $subjects = '';

    $query = "SELECT DISTINCT ` Subj` FROM `tblEnrollments` ORDER BY `tblEnrollments`.` Subj` ASC";

    if ($thisDatabaseReader->querySecurityOk($query, 0,1,0,0,0)) {
        $query = $thisDatabaseReader->sanitizeQuery($query);
        $subjects = $thisDatabaseReader->select($query, '');
    }

    foreach ($subjects as $sub) {
        print "<p><a href='classes.php?subject=" . $sub[' Subj'] . "'>" . $sub[' Subj'] . "</a></p>";
        print PHP_EOL;
    }
    ?>

    <?php
    include ("footer.php");
    ?>
    </body>

</html>