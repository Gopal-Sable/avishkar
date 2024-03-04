<?php
$a = array(); //array for selected id 
?>
    <h1>Results </h1>


    <div class="Container my-4">
        <div class="row align-items-left">
            <div class="col-3"  >

                <select  class="form-select" aria-label="Default select example">
                    <option selected>Select year to see results</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2024">2024</option>
                </select>
            </div>
            <div class="col-9 " style="width:450px;">
                <h6><a href=""> Registered</a> > <a href="">selected</a> > <a href="">Winners</a> </h6>
            </div>
          
        </div>
    </div>

    <!-- table -->
    <p class="bg-dark text-white my-4 p-2">List of colleges</p>
    <?php
    $q = "select * from colleges";
    // $result = mysqli_query($con, $q);
    // if ($result->num_rows > 0) {
    ?>

    <table id="myTable" class=" table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th class="col">#</th>
                <th class="col">Id</th>
                <th class="col">Project Name</th>
                <th class="col">Category</th>
            </tr>
        </thead>
        <tbody>
            <?php # while ($row = $result->fetch_assoc()) { 
            ?>
            <tr>
                <th scope="row"><input type="checkbox" name="" id="" value="1102"></th>
                <td><?php ?>1102</td>
                <td><?php ?>gfgfgfhjfghfhj</td>
                <td>Humanities, Languages and Arts</td>

            </tr>
            <tr>
                <th scope="row"><input type="checkbox" name="" id=""></th>
                <td><?php ?>1102</td>
                <td><?php ?>gfgfgfhjfghfhj</td>
                <td>Humanities, Languages and Arts</td>

            </tr>
            <?php #} 
            ?>
        </tbody>
    </table>
    <?php
    // } else {
    //     echo "No Data Found";
    // }
    // if (isset($_POST['delete'])) {
    //     $q = "delete from course where id= {$_REQUEST['id']}";
    //     if (mysqli_query($con, $q)) {
    //         echo '<meta http-equiv="refresh" content"0;URL=?deleted"/>';
    //     } else {
    //         echo '<script>swal("Oops..", "Something went wrong!", "error")</script>';
    //     }
    // }

    ?>
    <button class="btn btn-success">Send for next round</button>

<!-- <div>
    <a href="#" class="btn btn-danger box"><i class="fas fa-plus fa-2x"></i></a>
</div> -->
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>