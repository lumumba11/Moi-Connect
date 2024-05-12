<?php
// Database connection
require_once "config.php";
// Process tenant signup form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password']; // Note: You should hash the password before storing it in the database for security

    // Check if the email is already registered
    $sql_check = "SELECT tenant_id FROM tenants WHERE email='$email'";
    $result = $conn->query($sql_check);
    
    if ($result->num_rows > 0) {
        // Email is already registered
        echo "Email is already registered. Please choose a different email.";
    } else {
        // Insert tenant data into the database
        $sql_insert = "INSERT INTO tenants (email, password) VALUES ('$email', '$password')";
        
        if ($conn->query($sql_insert) === TRUE) {
            echo "Tenant signup successful. You can now login with your credentials.";
            // Redirect user to login file
            header("Location: tenant-login.html");
            exit();
        } else {
            echo "Error: ". $sql_insert. "<br>". $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>