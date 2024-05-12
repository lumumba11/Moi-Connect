<?php
// Database connection
require_once "config.php";

// Process landlord signup form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password']; // Note: You should hash the password before storing it in the database for security

    // Check if the email is already registered
    $sql_check = "SELECT landlord_id FROM landlords WHERE email='$email'";

    $result = $conn->query($sql_check);
    
    if ($result->num_rows > 0) {
        // Email is already registered
        echo "Email is already registered. Please choose a different email.";
    } else {
        // Insert landlord data into the database
        $sql_insert = "INSERT INTO landlords (email, password) VALUES ('$email', '$password')";
        
        if ($conn->query($sql_insert) === TRUE) {
            echo "Landlord signup successful. You can now login with your credentials.";
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
