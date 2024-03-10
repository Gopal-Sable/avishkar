<?php
if (!isset($_SESSION)) {
  session_start();
}
$con = mysqli_connect("localhost", "root", "", "e-learn");
if (!$con) {
  die("Connectioin Failed");
}
// login verification
// if (!isset($_SESSION['user'])) {
  if (isset($_POST["email"], $_POST["pass"])) {
    $user = $_POST["email"];
    $pass = $_POST["pass"];






    // change the connection string and query and test it






    // $sql = "select admin_email,admin_pass from Admin where admin_email='" . $user . "' AND admin_pass='" . $pass . "'";
    // $result = $con->query($sql);
    // $row = $result->num_rows;
    // if ($row === 1) {
      if ($user == 'admin') {
        $_SESSION['is_admin'] = true;
        $_SESSION['user'] = "admin";
        echo json_encode(1);
      } else {
        $_SESSION['is_admin'] = false;
        $_SESSION['user'] =$user; //$row['collegeName'];
        $_SESSION['clgID']=1;//$row['id'];
        echo json_encode(1);
      }
    } else if ($row === 0) {
      echo json_encode(0);
    }
  // }
// }
