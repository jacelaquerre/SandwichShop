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
        print '<h3><span>' . $sandwich["Sandwich_Name"] . '</span>' . $english_format_money . '<h3>';
        print '<p>' . $sandwich["Description"] . '</p>';
    }
    ?>
    <h3><span>Country Sandwich</span> $5.99<h3>
    <p>Lettuce, tomato etc</p>

    <h3><span>Turkey Club</span> $4.99</h3>
    <p>turkey, bacon, tomato and lettuce on toast with mayonnaise</p>

    <h2>Fajitas & Quesadillas</h2>

    <h3><span>Bacon Quesadilla</span> $6.99</h3>
    <p>smoked bacon and cheese etc&#8230;</p>
</main>
<?php
include ("footer.php");
?>
