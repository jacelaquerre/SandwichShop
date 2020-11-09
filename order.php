<?php
include ("top.php");
?>
    <?php
    $query = "";
    if ($thisDatabaseReader->querySecurityOk($query, 0,1,0,0,0)) {
        $query = $thisDatabaseReader->sanitizeQuery($query);
        $subjects = $thisDatabaseReader->select($query, '');
    }
    ?>

    <?php
    include ("footer.php");
    ?>