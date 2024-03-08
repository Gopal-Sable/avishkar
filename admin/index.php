<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['is_admin'] != true) {
    header("Location: ../login/login.html");
    exit();
}
require_once("header.php");
require_once("Navbar.php");
?>

<div id="page-content" class="col-sm-10 mt-5 text-center">

</div>
<?php
require_once("footer.php");
?>