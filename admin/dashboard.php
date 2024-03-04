<?php 
    require_once('../connection.php');
    $q="SELECT p.theme, COUNT(s.id) AS student_count
    FROM student s
    JOIN project p ON s.project_id = p.id
    GROUP BY p.theme";

    $result=mysqli_query($con,$q);
?>
<div class="row mx-5 text-center">
    <div class="col-sm-4 mt-5">
        <div class="card text-white bg-warning mb-3" style="max-width:18rem;">
            <div class="card-header">Humanities, Languages and Arts</div>
            <div class="card-body">
                <h4 class="card-title">10</h4>
                <a href="#" class="btn text-white">view</a>
            </div>
        </div>
    </div>
    <div class="col-sm-4 mt-5">
        <div class="card text-white bg-info mb-3" style="max-width:18rem;">
            <div class="card-header">Commerce, Management and Law</div>
            <div class="card-body">
                <h4 class="card-title">456</h4>
                <a href="#" class="btn text-white">View</a>
            </div>
        </div>
    </div>
    <div class="col-sm-4 mt-5">
        <div class="card text-white bg-secondary mb-3" style="max-width:18rem;">
            <div class="card-header">Pure Sciences</div>
            <div class="card-body">
                <h4 class="card-title">56</h4>
                <a href="#" class="btn text-white">View</a>
            </div>
        </div>
    </div>
    <div class="col-sm-4 mt-5">
        <div class="card text-white bg-danger mb-3" style="max-width:18rem;">
            <div class="card-header">Agriculture and Animal Husbandry</div>
            <div class="card-body">
                <h4 class="card-title">12</h4>
                <a href="#" class="btn text-white">View</a>
            </div>
        </div>
    </div>
    <div class="col-sm-4 mt-5">
        <div class="card text-white bg-success mb-3" style="max-width:18rem;">
            <div class="card-header">Engineering and Technology</div>
            <div class="card-body">
                <h4 class="card-title">456</h4>
                <a href="#" class="btn text-white">View</a>
            </div>
        </div>
    </div>
    <div class="col-sm-4 mt-5">
        <div class="card text-white bg-primary mb-3" style="max-width:18rem;">
            <div class="card-header">Medicine and Pharmacy </div>
            <div class="card-body">
                <h4 class="card-title">56</h4>
                <a href="#" class="btn text-white">View</a>
            </div>
        </div>
    </div>
</div>
<div class="mx-5 mt-5 text-center">

    <p class="bg-dark text-white p-2">xyz </p>
</div>

</div>
</div>