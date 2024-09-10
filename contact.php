<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $message = $_POST['message'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'contact');

    // Check for a database connection error
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        // Prepare the SQL insert statement
        $stmt = $conn->prepare("INSERT INTO contact_form (name, email, mobile, message) VALUES (?, ?, ?, ?)");

        // Check if the SQL statement is prepared successfully
        if ($stmt === false) {
            die('Prepare failed: ' . $conn->error);
        }
        
        // Bind parameters and execute the statement
        $stmt->bind_param("ssss", $fullname, $email, $mobile, $message);
        
        // Check if the statement is executed successfully
        if ($stmt->execute() === TRUE) {
            echo "Thank you for your interest in my profile. I will reply to your query soon.";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Close the statement and the database connection
        $stmt->close();
        $conn->close();
    }
}
?>
