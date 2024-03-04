<?php
// Function to generate the next sequential serial number for a given category and level
function getNextSerialNumber($category, $level) {
    // You can retrieve the last serial number from the database based on the provided category and level
    // For demonstration purposes, I'll use an array to simulate the last serial number
    // Replace this with your actual database query
    $lastSerialNumber = getLastSerialNumberFromDatabase($category, $level);

    // Increment the last serial number to get the next sequential serial number
    $nextSerialNumber = $lastSerialNumber + 1;

    // Save the incremented serial number to the database
    saveLastSerialNumberToDatabase($category, $level, $nextSerialNumber);

    return $nextSerialNumber;
}

// Function to generate the participant code and save it to the database
function registerParticipant($category, $level) {
    // Generate the next sequential serial number for the provided category and level
    $serialNumber = getNextSerialNumber($category, $level);

    // Combine category, level, and serial number
    $participantCode = $category . $level . str_pad($serialNumber, 2, '0', STR_PAD_LEFT);

    // Save participant code to the database
    saveParticipantCodeToDatabase($participantCode);

    return $participantCode;
}

// Sample data for testing
$category = 3; // Example category (Pure Sciences)
$level = 2; // Example level (Postgraduate Students)

// Register the participant and get the participant code
$participantCode = registerParticipant($category, $level);
echo "Participant registered successfully with code: $participantCode";

// Function to retrieve the last serial number from the database based on the provided category and level
function getLastSerialNumberFromDatabase($category, $level) {
    // This function should retrieve the last serial number from the database based on the provided category and level
    // Replace this with your actual database query
    // For demonstration purposes, I'll return a hardcoded value
    return 10; // Example last serial number
}

// Function to save the last serial number to the database
function saveLastSerialNumberToDatabase($category, $level, $serialNumber) {
    // This function should save the last serial number to the database for the provided category and level
    // Replace this with your actual database operation
    // For demonstration purposes, I'll just echo the serial number
    echo "Last serial number saved to the database for category $category and level $level: $serialNumber";
}

// Function to save participant code to the database
function saveParticipantCodeToDatabase($participantCode) {
    // This function should save the participant code to the database
    // Replace this with your actual database connection and query
    // For demonstration purposes, I'll just echo the participant code
    echo "Participant code saved to the database: $participantCode";
}
?>











// Function to retrieve the last serial number from the database based on the provided category and level
function getLastSerialNumberFromDatabase($category, $level) {
    // Database connection parameters
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to retrieve the last serial number
    $sql = "SELECT serial_number FROM participant_serial_numbers WHERE category = $category AND level = $level";

    // Execute SQL statement
    $result = $conn->query($sql);

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Fetch the last serial number from the result set
        $row = $result->fetch_assoc();
        $lastSerialNumber = $row["serial_number"];
    } else {
        // If no rows were returned, set the last serial number to 0
        $lastSerialNumber = 0;
    }

    // Close database connection
    $conn->close();

    return $lastSerialNumber;
}
