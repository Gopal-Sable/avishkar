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
    $a = array(); //array for selected id 
    ?>
    <h1>Results </h1>


    <div class="Container my-4">
        <div class="row align-items-left">
            <div class="col-3">

                <select class="form-select" aria-label="Default select example">
                    <option selected>Select year to see results</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2024">2024</option>
                </select>
            </div>
            <div class="col-9 " style="width:450px;">
                <h6><a class=`<?php echo $_GET['action'] == 'registered' ? "text-danger" : "" ?>` href="Results.php?action=registered"> Registered</a>
                    > <a href="Results.php?action=selected">selected</a> >
                    <a href="Results.php?action=winners">Winners</a>
                </h6>
            </div>

        </div>
    </div>

    <!-- table -->
    <p class="bg-dark text-white my-4 p-2">List of <?php echo $_GET['action']?> projcts</p>
    <?php
    $q =  " SELECT p.id, p.name , t.category
    FROM project p
    JOIN themes t ON p.theme = t.id
    JOIN winners w ON w.id=p.id
    WHERE w.type='" . $_GET['action'] . "'";

    $result = mysqli_query($con, $q);

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
            <?php while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <th scope="row"><input type="checkbox" name="chkID" id="<?php echo $row['id'] ?>" value="<?php echo $row['id'] ?>"></th>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['category'] ?></td>

                </tr>

            <?php }
            ?>
        </tbody>
    </table>

    <button class="btn btn-success">Send for next round</button>


    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</div>
<?php
require_once("footer.php");
?>