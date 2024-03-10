<?php
require_once('../connection.php');

// if (!isset($_SESSION['user']) || $_SESSION['is_admin'] == true) {
//     echo "please login first";

// }

// if (isset($_POST['submit'])) {
//     // echo "form submited";
// }
function presentation()
{
    if ($_POST['present'] == "Model with Poster" && $_POST['services'] != "") {
        return $_POST['services'];
    } elseif ($_POST['present'] == "Model with Poster") {
        return "Model with Poster";
    } else {
        return $_POST['present'];
    }
}

$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$clgid = 1; //temparary id $_SESSION['clgID'];
$dob1 = $_POST['dob1'];
$dob2 = $_POST['dob2'];
$ID = 1125; //temp for stud and project
$level = $_POST['level'];
$name2 = $_POST['name2'];
$email2 = $_POST['email2'];
$gender1 = $_POST['gender1'];
$gender2 = $_POST['gender2'];
$projName = $_POST['project_name'];
$theme = $_POST['theme'];
$presentationType = presentation();
$sup_name = $_POST['sup_name'];
$sup_email = $_POST['sup_email'];
$sup_mobile = $_POST['sup_mobile'];
try {

    $q = "INSERT INTO student (id, name, email, mobile, college, DOB, project_id, level, superwiser_name, sup_mobile,sup_email, gender,  stud2_name, stud2_dob, stud2_email, stud2_gender) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $stud = $con->prepare($q);
    // Bind parameters
    $stud->bind_param("sssssssssssssss", $ID, $name, $email, $mobile, $clgid, $dob1, $ID, $level, $sup_name, $sup_mobile, $sup_email, $gender1, $name2, $dob2, $email2, $gender2);
    $stud->execute();

    $winner = $con->prepare("INSERT INTO winners(id,year)VALUES(?,?)");
    $winner->bind_param("is", $ID, date('Y'));
    $winner->execute();

    $project = $con->prepare("INSERT INTO project(id,name,theme,type)VALUES(?,?,?,?)");
    $project->bind_param("isss", $ID, $projName, $theme, $presentationType);
    $project->execute();

    $con->commit();

    echo "Registaration successful.";
} catch (Exception $e) {
    $con->rollback();
    echo "Failed to delete college: " . $e->getMessage();
}
