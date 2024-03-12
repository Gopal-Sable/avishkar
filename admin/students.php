<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['is_admin'] != true) {
    header("Location: ../login/login.html");
    exit();
}
require_once("header.php");
require_once("Navbar.php");

require_once('../connection.php');
if (isset($_GET['theme'])) {
    $q = "SELECT s.id, s.name AS student_name, c.name AS clg_name, l.name AS level_name, p.theme AS project_theme, t.category AS project_category
FROM student s
LEFT JOIN college c ON s.college = c.id
LEFT JOIN level l ON s.level = l.id
LEFT JOIN project p ON s.project_id = p.id
LEFT JOIN themes t ON p.theme = t.id 
WHERE p.theme=" . $_GET['theme'];
} else {
    $q = "SELECT s.id, s.name AS student_name, c.name AS clg_name, l.name AS level_name, p.theme AS project_theme, t.category AS project_category
FROM student s
LEFT JOIN college c ON s.college = c.id
LEFT JOIN level l ON s.level = l.id
LEFT JOIN project p ON s.project_id = p.id
LEFT JOIN themes t ON p.theme = t.id ";
}
$result = mysqli_query($con, $q);

$temp=mysqli_query($con, $q);
?>
<div id="page-content" class="col-sm-10 mt-5 text-center">

    <h1>students - <?php echo $result->num_rows ?></h1>
    <!-- table -->
    <p class="bg-dark text-white my-4 p-2">List Of Students For <?php echo isset($_GET['theme']) ? $temp->fetch_assoc()['project_category'] : "All" ?></p>


    <table id="myTable" class=" table table-striped table-responsive table-hover table-bordered">
        <thead>
            <tr>
                <th class="col">ID</th>
                <th class="col">Name</th>
                <th class="col">College</th>
                <th class="col">Category</th>
                <th class="col">Level</th>

            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <th scope="row"><?php echo $row['id'] ?></th>
                        <td><?php echo $row['student_name'] ?></td>
                        <td><?php echo $row['clg_name'] ?></td>
                        <td><?php echo $row['project_category'] ?></td>
                        <td><?php echo $row['level_name'] ?></td>
                    </tr>

                <?php }
                ?>
        </tbody>
    </table>
<?php
            }

?>

<div>
    <a href="#" class="btn btn-danger box"><i class="fas fa-plus fa-2x"></i></a>
</div>

<a href="">Download</a> | <a href="">Publish</a>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
</div>

<?php
require_once("footer.php");
?>