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

    $query = "SELECT `pmkNetId`, `fldLastName`, `fldFirstName` 
                FROM `tblStudent`
            ORDER BY `fldFirstName`";
    if ($thisDatabaseReader->querySecurityOk($query, 0,1,0,0,0)) {
        $query = $thisDatabaseReader->sanitizeQuery($query, 0, 0, 1, 0, 0);
        $records = $thisDatabaseReader->select($query, '');
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
        <fieldset class="buttons">
            <legend></legend>
            <input class="button" id="btnSubmit" name = "btnSubmit"
                   tabindex="900" type = "submit" value = "Submit">
        </fieldset>
    </form>





    <table>
        <caption><strong>My Classes</strong></caption>
        <tr>
            <th>Student Name</th>
            <th>Subject</th>
            <th>#</th>
            <th>Title</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Days</th>
            <th>Building</th>
            <th>Room</th>
            <th>Teacher Name</th>
        </tr>
    <?php

    $records = '';

    $query = "SELECT `student`.`fldFirstName`, `student`.`fldLastName`, ` Subj`, `#`, `Title`, `Start Time`, `End Time`, `Days`, `Bldg`, `Room` , `Instructor` 
                FROM `tblEnrollments` 
                JOIN tblStudentEnrollments As enroll ON enroll.pfkEnrollmentId = `pmkEnrollmentId` 
                JOIN tblStudent AS student ON student.pmkNetId = `pfkStudentId` 
               WHERE `pmkEnrollmentId` = enroll.pfkEnrollmentId AND `pfkStudentId` LIKE ?";

    if ($thisDatabaseReader->querySecurityOk($query, 1,1,0,0,0)) {
        $query = $thisDatabaseReader->sanitizeQuery($query, 1, 0, 1, 0, 0);
        $records = $thisDatabaseReader->select($query, array($_GET["studentID"]));
    }

    foreach ($records as $record) {
        print '<tr>';
        print '<td>' . $record['fldFirstName'] ." " . $record['fldLastName']  . '</td>';
        print '<td>' . $record[' Subj'] . '</td>';
        print '<td>' . $record['#'] . '</td>';
        print '<td>' . $record['Title'] . '</td>';
        print '<td>' . $record['Start Time'] . '</td>';
        print '<td>' . $record['End Time'] . '</td>';
        print '<td>' . $record['Days'] . '</td>';
        print '<td>' . $record['Bldg'] . '</td>';
        print '<td>' . $record['Room'] . '</td>';
        print '<td>' . $record['Instructor'] . '</td>';
        print '</tr>' . PHP_EOL;
    }
    ?>

        <tr>
            <td>Sources</td>
            <td colspan="9"> <a href="https://giraffe.uvm.edu/~rgweb/batch/curr_enroll_fall.html" target="_blank"> https://www.uvm.edu/registrar </a> </td>
        </tr>
    </table>
</main>
    <?php
    include ("footer.php");
    ?>
    </body>
    
</html>