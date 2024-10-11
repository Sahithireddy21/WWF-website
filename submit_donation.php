<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "animal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO donations (first_name, last_name, email, country, street_address, apt, city, postal_code,amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)");
if (!$stmt) {
    die("Preparation failed: " . $conn->error);
}

$stmt->bind_param("sssssssss", $first_name, $last_name, $email, $country, $street_address, $apt, $city, $postal_code,$amount);

// Set parameters and execute
$first_name = $_POST['firstName'];
$last_name = $_POST['lastName'];
$email = $_POST['email'];
$country = $_POST['country'];
$street_address = $_POST['streetAddress'];
$apt = $_POST['apt'];
$city = $_POST['city'];
$postal_code = $_POST['postalCode'];
$amount=$_POST['amount'];

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>