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
    <?php
    require_once('../connection.php');
    $q = "SELECT DISTINCT p.id, p.name, t.category AS theme,c.name AS college_name, l.name AS level_name
        FROM project p
        JOIN student s ON p.id = s.project_id
        LEFT JOIN college c ON s.college = c.id
        LEFT JOIN level l ON s.level = l.id
        LEFT JOIN themes t ON p.theme = t.id;
        ";
    $result = mysqli_query($con, $q);
    echo "<h1>Projects - $result->num_rows </h1>";
    ?>

    <!-- table -->
    <p class="bg-dark text-white my-4 p-2">List Of Projects</p>


    <table id="myTable" class=" table table-striped table-hover table-bordered">
        <thead>
            <tr class="">
                <th class="col">Id</th>
                <th class="col">Project Name</th>
                <th class="col">Category</th>
                <th class="col">College</th>
                <th class="col">Level</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['theme'] ?></td>
                        <td><?php echo $row['college_name'] ?></td>
                        <td><?php echo $row['level_name'] ?></td>

                    </tr>
                <?php }
                ?>
        </tbody>
    </table>
<?php
            }

?>
<a href="">Download</a> | <a href="">Publish</a>

<!-- <div>
    <a href="#" class="btn btn-danger box"><i class="fas fa-plus fa-2x"></i></a>
</div> -->
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
</div>
<?php
require_once("footer.php");
?>