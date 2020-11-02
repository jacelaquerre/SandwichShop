<?php
include ("top.php");

$dataIsGood = false;
$studentArray = array();
$netIds = array();
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

    $records = "";
    $query = "SELECT `pmkNetId`, `fldLastName`, `fldFirstName` 
                FROM `tblStudent`
            ORDER BY `fldFirstName`";
    if ($thisDatabaseReader->querySecurityOk($query, 0,1,0,0,0)) {
        $query = $thisDatabaseReader->sanitizeQuery($query, 0, 0, 1, 0, 0);
        $records = $thisDatabaseReader->select($query, '');
        $dataIsGood = true;
    }

    $index = 0;
    $student = "";
    foreach ($records as $record) {
        $student = $record['fldFirstName'];
        $student .= " ";
        $student .= $record['fldLastName'];
        $studentArray[$index] = $student;
        $netIds[$index] = $record['pmkNetId'];
        ++$index;
    }

    $classes = "";
    $query = "SELECT ` Subj`,`#`,`Title`,`pmkEnrollmentId` FROM `tblEnrollments`
               WHERE ` Subj` = ?";
    if ($thisDatabaseReader->querySecurityOk($query, 1,0,0,0,0)) {
        $query = $thisDatabaseReader->sanitizeQuery($query, 0, 0, 1, 0, 0);
        $classes = $thisDatabaseReader->select($query, array($_GET['subject']));
    }

    ?>

    <form action = "<?php print PHP_SELF; ?>"
          id="frmRegister"
          method = "get">
        <fieldset class = "student">
            <legend>Select Student</legend>
            <p class="dropdown">
                <select id="studentID"
                        name="studentID"
                        tabindex="1200" >
                    <?php
                    foreach(array_combine($netIds, $studentArray) as $id => $name) {
                        echo "<option value='$id'>$name</option>";
                    }
                    ?>
                </select>
            </p>
        </fieldset>
        <fieldset class="classes">
            <?php
            foreach ($classes as $class){
                print "<p><input type='checkbox' name='class[]' value='" . $class['pmkEnrollmentId'] . "'>";
                print  $class[' Subj'] . " " . $class['#'] . " " . $class['Title'];
                print "</input></p>";
            }
            ?>
        </fieldset>
        <fieldset class="buttons">
            <legend></legend>
            <input class="button" id="btnSubmit" name = "btnSubmit"
                   tabindex="900" type = "submit" value = "Submit">
        </fieldset>
    </form>
</main>

    <?php
    $query = "INSERT INTO `tblStudentEnrollments`(`pfkStudentId`, `pfkEnrollmentId`) VALUES (?,?)";

    if ($thisDatabaseWriter->querySecurityOk($query, 0,0,0,0,0)) {
        $query = $thisDatabaseWriter->sanitizeQuery($query, 1, 0, 1, 0, 0);
        foreach ($_GET['class'] as $class)
            $records = $thisDatabaseWriter->insert($query, array($_GET["studentID"], $class));
    }

    // uncomment to see $_GET array
    //print_r($_GET);

    include ("footer.php");
    ?>
    </body>
</html>
