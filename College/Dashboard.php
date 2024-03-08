<?php
  session_start();
if (!isset($_SESSION['user'])||$_SESSION['is_admin']==true) {
  header("location: ../index.php");
}
require_once('header.php');
?>
<div class="container">
  <div class="row align-items-end">
    <div class="col ">
      <h2>College Name: <?php echo $_SESSION['user'] ?></h2>
      <h3>Dist: Chh. Sambhajinagar</h3>
    </div>
    <div class="col mx-3">

      <h2> Status : pending</h2>
    </div>
  </div>
</div>
<div class="container">

  <table id="myTable" class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td >Larry the Bird</td>
        <td>@twitter</td>
        <td>dscfsdadsaafdg</td>
      </tr>
    </tbody>
  </table>
  <button class="btn btn-success">Register a Student</button>
  <button class="btn btn-primary">Print Application</button>
  <button class="btn btn-secondary">submit scan copy</button>

</div>
<script>
  $(document).ready(function() {
    $('#myTable').DataTable();
  });
</script>
<?php
require_once('footer.php');
?>