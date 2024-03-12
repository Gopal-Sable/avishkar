<?php
require_once('../connection.php');
session_start();
if (!isset($_SESSION['user']) || $_SESSION['is_admin'] != true) {
    header("Location: ../login/login.html");
    exit();
}
if (isset($_POST['add'])) {
    // Adding new college
    if (isset($_POST['college'])) {
        // Retrieve data from POST request
        $data = $_POST['college'];
        $password = 'password'; // Replace 'password' with the actual password

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Prepare SQL statement to insert data into database
        $stmt = $con->prepare("INSERT INTO college (name, pass) VALUES (?, ?)");
        // Bind parameters
        $stmt->bind_param("ss", $data, $hashedPassword);

        // Execute the statement
        if ($stmt->execute()) {
            // If successful, return success message
            echo "Data added successfully.";
        } else {
            // If not successful, return error message
            echo "Failed to add data: " . $con->error;
        }

        // Close statement
        $stmt->close();
    } else {
        // If form data is not received, return error message
        echo "No data received.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Fetching colleges data
    $q = "SELECT c.id, c.name, COUNT(s.id) AS student_count
        FROM college c
        LEFT JOIN student s ON c.id = s.college
        GROUP BY c.id, c.name
        ";
    $result = mysqli_query($con, $q);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<th scope='row'>" . $row['id'] . "</th>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['student_count'] . "</td>";
            echo "<td>";
            echo "<form action='' class='d-inline' method='post'>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<button type='submit' class='btn btn-primary mr-3' name='submit' value='submit'><i class='fas fa-pen'></i></button>";
            echo "</form>";
            echo "<form action='' class='d-inline' method='post'>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<button type='submit' name='delete' class='btn btn-danger deleteCollegeBtn' value='delete' data-college-id='" . $row['id'] . "'><i class='far fa-trash-alt'></i></button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
    }
} elseif (isset($_POST['delete'])) {
    // Deleting college
    // echo 'delete clicked';
    $collegeId = $_POST['id'];

    // Begin transaction
    // $con->begin_transaction();

    try {
        // Prepare SQL statement to delete related students
        $deleteStudentsStmt = $con->prepare("DELETE FROM student WHERE college = ?");
        // Bind parameter
        $deleteStudentsStmt->bind_param("i", $collegeId);
        // Execute the statement
        $deleteStudentsStmt->execute();

        // Prepare SQL statement to delete college
        $deleteCollegeStmt = $con->prepare("DELETE FROM college WHERE id = ?");
        // Bind parameter
        $deleteCollegeStmt->bind_param("i", $collegeId);
        // Execute the statement
        $deleteCollegeStmt->execute();

        // Commit transaction
        $con->commit();

        // If successful, return success message
        echo "College and related students deleted successfully.";
    } catch (Exception $e) {
        // Rollback transaction if any error occurs
        $con->rollback();
        // Return error message
        echo "Failed to delete college: " . $e->getMessage();
    }

    // Close statements
    $deleteStudentsStmt->close();
    $deleteCollegeStmt->close();
}
// Check if update request is submitted
elseif (isset($_POST['update']) && $_POST['update'] == 'ok') {
    $collegeId = $_POST['collegeId'];
    $newCollegeName = $_POST['collegeName'];

    // Perform update operation in your database
    $updateQuery = "UPDATE college SET name = '$newCollegeName' WHERE id = $collegeId";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        echo "College updated successfully.";
    } else {
        echo "Error: " . mysqli_error($con);
    }

    exit(); // Terminate the script after processing update request
}
