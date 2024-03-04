<?php
require_once('../connection.php');
$q = "SELECT s.id, s.name AS student_name, c.name AS clg_name, l.name AS level_name, p.theme AS project_theme, t.category AS project_category
FROM student s
LEFT JOIN college c ON s.college = c.id
LEFT JOIN level l ON s.level = l.id
LEFT JOIN project p ON s.project_id = p.id
LEFT JOIN themes t ON p.theme = t.id; ";
$result = mysqli_query($con, $q);

?>

<h1>students - <?php echo $result->num_rows ?></h1>



<!-- table -->
<p class="bg-dark text-white my-4 p-2">List Of Students</p>


<table id="myTable" class=" table table-striped table-responsive table-hover table-bordered">
    <thead>
        <tr>
            <th class="col">ID</th>
            <th class="col">Name</th>
            <th class="col">College</th>
            <th class="col">Category</th>
            <th class="col">Level</th>
            <th class="col">Action</th>

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
            <td>
                <form action="" class="d-inline" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                    <button type="submit" class="btn btn-primary mr-3" name="submit" value="submit"><i class="fas fa-pen"></i></button>
                </form>
                <form action="" class="d-inline" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']?>">
                    <button type="submit" class="btn btn-danger" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button>
                </form>
            </td>
        </tr>
        
        <?php } 
        ?>
    </tbody>
</table>
<?php
 } //else {
//     echo "No Data Found";
// }
// if (isset($_POST['delete'])) {
//     $q = "delete from students where id= {$_REQUEST['id']}";
//     if (mysqli_query($con, $q)) {
//         echo '<meta http-equiv="refresh" content"0;URL=?deleted"/>';
//     } else {
//         echo '<script>swal("Oops..", "Something went wrong!", "error")</script>';
//     }
// }

?>
<a href="">Download</a> | <a href="">Publish</a>

<div>
    <a href="#" class="btn btn-danger box"><i class="fas fa-plus fa-2x"></i></a>
</div>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>