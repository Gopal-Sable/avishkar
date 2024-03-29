<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['is_admin'] != true) {
    header("Location: ../login/login.html");
    exit();
}
require_once("header.php");
require_once("Navbar.php");

require_once('../connection.php');
$q = "SELECT t.id, t.category, COUNT(s.id) AS student_count
FROM student s
JOIN project p ON s.project_id = p.id
RIGHT JOIN themes t ON p.theme = t.id
GROUP BY t.category";

$result = mysqli_query($con, $q);

$colors = array("bg-warning", "bg-info", "bg-secondary", "bg-danger", "bg-success", "bg-primary");

$color_index = 0;

?>
<div id="page-content" class="col-sm-10 mt-5 text-center">
    <div class="row mx-5 text-center">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <div class="col-sm-4 mt-5">
                <div class="card text-white <?php echo $colors[$color_index]; ?> mb-3" style="max-width:18rem;">
                    <div class="card-header"><?php echo $row['category']; ?></div>
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $row['student_count']; ?></h4>
                        <a href=<?php echo "students.php?theme=".$row['id']?> class="btn text-white">View</a>
                    </div>
                </div>
            </div>
            <?php
            $color_index = ($color_index + 1) % count($colors);
            ?>
        <?php endwhile; ?>
    </div>
    <div class="mx-5 mt-5 text-center">
        <p class="bg-dark text-white p-2">xyz </p>
    </div>
</div>
<?php
require_once("footer.php");
?>