<?php
include ("top.php");
?>
<main>
    <h1>Menu</h1>

    <h2>Sandwiches</h2>
    <?php
    $query = "SELECT * FROM `Sandwiches`";
    if ($thisDatabaseReader->querySecurityOk($query, 0,0,0,0,0)) {
        $query = $thisDatabaseReader->sanitizeQuery($query, 0, 0, 0, 0, 0);
        $sandwiches = $thisDatabaseReader->select($query, '');
    }

    foreach ($sandwiches as $sandwich) {
        $english_format_money = "$" . number_format($sandwich["Price"], 2, '.', ',');
        print '<h3><span>' . $sandwich["Sandwich_Name"] . '</span>' . ' - ' . $english_format_money . '<h3>';
        print '<p>' . $sandwich["Description"] . '</p>';
    }
    ?>
</main>

<?php
include ("footer.php");
?>
