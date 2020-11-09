<?php
include ("top.php");

$dataIsGood = false;
$studentArray = array();
$netIds = array();

//Sanitize function from the text
function getData($field) {
    if(!isset($_GET[$field])) {
        $data = "";

    } else {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data);
    }
    return $data;
}
?>
<main>
    <?php
    //print '<p>Post Array:</p><pre>';
    //print_r($_POST);
    //print '</pre>';

    // process from when its submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dataIsGood = true;
    }
    $records = '';
    $query = "";
    if ($thisDatabaseReader->querySecurityOk($query, 0,1,0,0,0)) {
        $query = $thisDatabaseReader->sanitizeQuery($query, 0, 0, 1, 0, 0);
        $records = $thisDatabaseReader->select($query, '');
    }
    ?>

    <form action = "<?php print PHP_SELF; ?>"
          id="frmRegister"
          method = "get">
    </form>
</main>
<?php
include ("footer.php");
?>