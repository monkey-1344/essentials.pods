<?php
// Database connection parameters
require_once 'components/config.php';

// Create connection
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into your_table (adjust table name and column names accordingly)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $review = $_POST['review'];

    // Prepare SQL statement with placeholders
    $stmt = $conn->prepare("INSERT INTO reviews (review) VALUES (?)");

    // Bind parameters to statement
    $stmt->bind_param("s", $review);

    // Execute statement
    if ($stmt->execute()) {
        echo "Parerea dumneavoastră contează.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close statement and connection
$stmt->close();
$conn->close();



?>
