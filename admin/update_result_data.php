<?php

// selectedIDs[]: 1
// chktype: selected 
// resone: update

require_once("../connection.php");

// Check if selectedIDs are set and not empty
if (isset($_POST['selectedIDs']) && !empty($_POST['selectedIDs'])) {
    $selectedIDs = $_POST['selectedIDs'];
    $updateQuery = "";
    $idsString = implode(',', $selectedIDs);

    if ($_POST['resone'] == 'update')
        $updateQuery = "UPDATE winners SET type = '". $_POST['chktype']."' WHERE id IN ($idsString)";
    
    elseif ($_POST['resone'] == 'demote' )
        $updateQuery = "UPDATE winners SET type = '". $_POST['chktype']."' WHERE id IN ($idsString)";
    
    if (mysqli_query($con, $updateQuery)) {
        echo "Data updated successfully for IDs: $idsString\n";
    } else {
        echo "Error updating data for IDs: $idsString\n";
    }
} else {
    echo "No IDs selected";
}
