<?php
session_start();
$_SESSION['user_id']='temprary';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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
<script>
   
    $(document).ready(function() {
        
        $('#page-content').load('dashboard.php');
        $('.navigation').click(function(e) {
            e.preventDefault();

            var url = $(this).attr('href');
            $('#page-content').load(url);
        });
        
    });

    
</script>