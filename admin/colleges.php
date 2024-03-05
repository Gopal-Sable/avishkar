<?php
require_once('../connection.php');
$q = "SELECT c.id, c.name, COUNT(s.id) AS student_count
    FROM college c
    LEFT JOIN student s ON c.id = s.college
    GROUP BY c.id, c.name
    ";
$result = mysqli_query($con, $q);
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
                    <th scope="row"><?php echo $row['id']; ?></th>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['student_count'] ?></td>
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
       
?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-danger box" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    <i class="fas fa-plus fa-2x"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addDataForm">
                    <div class="form-group">
                        <label for="dataInput">College Name:</label>
                        <input type="text" class="form-control" id="college" name="college">
                        <div id="collegeError" class="text-danger"></div>
                        <input type="text" name="add" value="ok" hidden>
                    </div>
                    <input type="submit" name="add" value="Submit" class="btn btn-primary">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add College</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        fetchColleges()
        // Function to fetch and display colleges
        function fetchColleges() {
            $.ajax({
                type: 'GET',
                url: 'collegeOperations.php', // PHP script URL that handles fetching colleges data
                success: function(response) {
                    $('#myTable tbody').html(response); // Update table body with new data
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log error message
                    alert('An error occurred while fetching colleges.'); // Show error message
                }
            });
        }

        // Adding new college to database
        $('#addDataForm').submit(function(event) {
            event.preventDefault();

            // Get form data
            var formData = $(this).serialize();

            // Check if college field is empty
            if ($('#college').val() == '') {
                $('#collegeError').text('College name is required.'); // Display error message
                return;
            }

            // Send AJAX request to save data
            $.ajax({
                type: 'POST',
                url: 'collegeOperations.php', // PHP script URL that handles adding new college
                data: formData,
                success: function(response) {
                    alert(response); // Show success message
                    $('#addDataModal').modal('hide'); // Hide the modal
                    fetchColleges(); // Refresh colleges table
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log error message
                    alert('An error occurred while adding data.'); // Show error message
                }
            });
        });

        // Clear error message on input change
        $('#college').on('input', function() {
            $('#collegeError').text('');
        });

        // Delete college button click event
        $(document).on('click', '.deleteCollegeBtn', function() {
            var collegeId = $(this).data('college-id');
            if (confirm('Are you sure you want to delete this college?')) {
                $.ajax({
                    type: 'POST',
                    url: 'collegeOperations.php', // PHP script URL that handles deleting college
                    data: {
                        id: collegeId,
                        delete:'ok'
                    },
                    success: function(response) {
                        alert(response); // Show success message
                        fetchColleges(); // Refresh colleges table
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log error message
                        alert('An error occurred while deleting college.'); // Show error message
                    }
                });
            }
        });
    });

    
</script>