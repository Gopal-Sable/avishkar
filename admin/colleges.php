
<?php 
    require_once('../connection.php');
    $q="SELECT c.id, c.name, COUNT(s.id) AS student_count
    FROM college c
    LEFT JOIN student s ON c.id = s.college
    GROUP BY c.id, c.name
    ";
    $result=mysqli_query($con,$q);
?>
<h1>Colleges - <?php echo $result->num_rows ?></h1>



<!-- table -->
<p class="bg-dark text-white my-4 p-2">List of colleges</p>



<table id="myTable" class=" table table-striped table-hover">
    <thead>
        <tr>
            <th class="col">ID</th>
            <th class="col">Name</th>
            <th class="col">Total Participant</th>
            <th class="col">Action</th>

        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) { 
        ?>
        <tr>
            <th scope="row"><?php echo $row['id'] ;?></th>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['student_count']?></td>
            <td>
                <form action="" class="d-inline" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                    <button type="submit" class="btn btn-primary mr-3" name="submit" value="submit"><i class="fas fa-pen"></i></button>
                </form>
                <form action="" class="d-inline" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                    <button type="submit" class="btn btn-danger" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button>
                </form>
            </td>
        </tr>
       
        <?php } 
        ?>
    </tbody>
</table>
<?php
}
// if (isset($_POST['delete'])) {
//     $q = "delete from college where id= {$_REQUEST['id']}";
//     if (mysqli_query($con, $q)) {
//         echo '<meta http-equiv="refresh" content"0;URL=?deleted"/>';
//     } else {
//         echo '<script>swal("Oops..", "Something went wrong!", "error")</script>';
//     }
// }

?>

<div>
    <a href="#" class="btn btn-danger box"><i class="fas fa-plus fa-2x"></i></a>
</div>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>