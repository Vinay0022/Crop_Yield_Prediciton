<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "acrs"; // Replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get sensor data from POST request
$temp = $_POST['temperature'];
$humidity = $_POST['humidity'];
$rainmeter = $_POST['rain'];
$soilmoisture = $_POST['humidity'];
$sunlightintensity = $_POST['intensity'];

// Insert data into the dataset table
$sql = "INSERT INTO dataset (TEMP, HUMIDITY, RAINMETER, SOILMOISTURE, SUNLIGHTINTENSITY) VALUES ($temp, $humidity, $rainmeter, $soilmoisture, $sunlightintensity)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
