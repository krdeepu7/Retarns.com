<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection parameters
$servername = "localhost";
$username = "u381914726_admin";
$password = "DJ5t3}03w&&*e)(RLDHA";
$dbname = "u381914726_contact_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$full_name = $_POST['full_name'];
$phone_number = $_POST['phone_number'];
$email_address = $_POST['email_address'];
$message = $_POST['message'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO inquiry (Full_name, Phone_number, Email, Message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $full_name, $phone_number, $email_address, $message);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Send email
$to = $email_address;
$subject = "Thank you for contacting us";
$body = "Dear $full_name,\n\nThank you for reaching out. We have received your message and will get back to you shortly.\n\nBest regards,\nYour Company Name";
$headers = "From: your_email@example.com";

// Use mail() function to send email
if (mail($to, $subject, $body, $headers)) {
    echo "Email sent successfully";
} else {
    echo "Failed to send email";
}

// Redirect to thank you page
header("Location: thank_you.php");
exit();
?>
