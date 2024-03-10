<?php


require_once("../connection.php");

// Check if selectedIDs are set and not empty
if (isset($_POST['selectedIDs']) && !empty($_POST['selectedIDs'])) {
    $selectedIDs = $_POST['selectedIDs'];
    $updateQuery = "";
    // Convert selected IDs array into a comma-separated string for SQL query
    $idsString = implode(',', $selectedIDs);
    // echo $_POST['type'] . $_POST['resone'] . $idsString;
    // $checkbox= $_POST['chktype'];
    // if ('selected'==$checkbox) {
    //     echo 'selected oksda';
    // // }
    if ($_POST['resone'] == 'update') {

        if ($_POST['chktype'] == 'selected')
            echo "ok slected update";
        elseif ($_POST['chktype'] == 'registered')
            $updateQuery = "UPDATE winners SET type = 'selected' WHERE id IN ($idsString)";

        if (mysqli_query($con, $updateQuery)) {
            echo "Data updated successfully for IDs: $idsString\n";
        } else {
            echo "Error updating data for IDs: $idsString\n";
        }
    }
    // else {
    //     if ($_POST['type'] == 'winners')
    //         $updateQuery = "UPDATE winners SET type = 'selected' WHERE id IN ($idsString)";
    //     elseif ($_POST['type'] == 'selected')
    //         $updateQuery = "UPDATE winners SET type = 'registered' WHERE id IN ($idsString)";

    //     if (mysqli_query($con, $updateQuery)) {
    //         echo "Data updated successfully for IDs: $idsString\n";
    //     } else {
    //         echo "Error updating data for IDs: $idsString\n";
    //     }
    // }
    // if ($_POST['resone'] == 'update') && $_POST['type'] == 'selected')
    // $updateQuery = "UPDATE winners SET type = 'winners' WHERE id IN ($idsString)";
    // elseif ($_POST['resone'] == 'update' && $_POST['type'] == 'registered')
    //     $updateQuery = "UPDATE winners SET type = 'selected' WHERE id IN ($idsString)";

    // elseif ($_POST['resone'] == 'demote' && $_POST['type'] == 'winners')
    //     $updateQuery = "UPDATE winners SET type = 'selected' WHERE id IN ($idsString)";
    // elseif ($_POST['resone'] == 'demote' && $_POST['type'] == 'selected') 
    //     $updateQuery = "UPDATE winners SET type = 'registered' WHERE id IN ($idsString)";

    // if (mysqli_query($con, $updateQuery)) {
    //     echo "Data updated successfully for IDs: $idsString\n";
    // } else {
    //     echo "Error updating data for IDs: $idsString\n";
    // }

} else {
    echo "No IDs selected";
}
