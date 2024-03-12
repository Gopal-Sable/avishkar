<?php
// require_once('../connection.php');
$servername = "localhost";
$username = "root";
$password = "";
$database = "avishkar";

// Create connection
$con = new mysqli($servername, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
// if (!isset($_SESSION['user']) || $_SESSION['is_admin'] == true) {
//     echo "please login first";

// }

// if (isset($_POST['submit'])) {
//     // echo "form submited";
// }
function generateID($category, $level)
{
    // require_once('../connection.php');
    $q = "SELECT p.id
    FROM project p
    JOIN student s ON s.project_id = p.id
    WHERE s.level = ? AND p.theme = ?
    ORDER BY s.id DESC
    LIMIT 1";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "avishkar";

    // Create connection
    $con = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $stmt = mysqli_prepare($con, $q);
    mysqli_stmt_bind_param($stmt, "ii", $level, $category);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows > 0) {
        $last_id = $result->fetch_assoc()['id'] + 1;
        return $last_id;
    } else {
        return $category * 1000 + $level * 100 + 1;
    }
}

function maxlimit($level, $clgid)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "avishkar";

    // Create connection
    $con = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    // require_once('../connection.php');
    $q = "SELECT COUNT(*) AS project_count
    FROM student
    WHERE level = $level AND college = $clgid";
    $result = mysqli_query($con, $q);
    $row = $result->fetch_assoc();
    if ($level == 1 && $row['project_count'] == 3) {
        echo "Max Limit for UG Level is Riched please try another level";
        return true;
    }
    if ($level == 2 && $row['project_count'] == 3) {
        echo "Max Limit for pG Level is Riched please try another level";
        return true;
    }
    if ($level == 3 && $row['project_count'] == 2) {
        echo "Max Limit for Post PG Level is Riched please try another level";
        return true;
    }
    return false;
}
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
$clgid = 11; //temparary id $_SESSION['clgID'];
$dob1 = $_POST['dob1'];
$dob2 = isset($_POST['dob2'])?$_POST['dob2']:"";
$level = $_POST['level'];
$name2 = isset($_POST['name2'])?$_POST['name2']:"";
$email2 = isset($_POST['email2'])?$_POST['email2']:"";
$gender1 = $_POST['gender1'];
$gender2 = isset($_POST['gender2'])?$_POST['gender2']:"";;
$projName = $_POST['project_name'];
$theme = $_POST['theme'];
$presentationType = presentation();
$sup_name = $_POST['sup_name'];
$sup_email = $_POST['sup_email'];
$sup_mobile = $_POST['sup_mobile'];
$fileData = file_get_contents($_FILES['abstract']['tmp_name']);


$ID = generateID($theme, $level);
try {
    if (maxlimit($level, $clgid)) {
        echo "max limit rich";
        exit();
    }
    $q = "INSERT INTO student (id, name, email, mobile, college, DOB, project_id, level, superwiser_name, sup_mobile,sup_email, gender,  stud2_name, stud2_dob, stud2_email, stud2_gender,abstract) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $stud = $con->prepare($q);
    // Bind parameters
    $stud->bind_param("sssssssssssssssss", $ID, $name, $email, $mobile, $clgid, $dob1, $ID, $level, $sup_name, $sup_mobile, $sup_email, $gender1, $name2, $dob2, $email2, $gender2,$fileData);
    $stud->execute();

    $winner = $con->prepare("INSERT INTO winners(id,year)VALUES(?,?)");
    $date=date('y');
    $winner->bind_param("is", $ID, $date);
    $winner->execute();

    $project = $con->prepare("INSERT INTO project(id,name,theme,type)VALUES(?,?,?,?)");
    $project->bind_param("isss", $ID, $projName, $theme, $presentationType);
    $project->execute();

    $con->commit();

    echo "Registaration successful.";
} catch (Exception $e) {
    $con->rollback();
    echo "Failed : " . $e->getMessage();
}
