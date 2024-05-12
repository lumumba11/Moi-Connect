<?php

    session_start();
    // Connect to database
    require_once "config.php";
    // Check if the form was submitted
    if (isset($_POST['email'], $_POST['password'])) {
        $email = trim($_POST['email']);
        $password = $_POST['password'];
    
        // Prepare the SQL statement
        $stmt = $conn->prepare('SELECT tenant_id, email, password FROM tenants WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $db_email, $password_hash);
            $stmt->fetch();
    
            // Debugging: Output email address from the database and provided by the user
            var_dump($db_email, $email);
    
            // Debugging: Output hashed password from the database and hashed user input password
            var_dump($password_hash, password_hash($password, PASSWORD_DEFAULT));
    
            // Trim both stored hashed password and user input password
            $password_hash = trim($password_hash);
            $password = trim($password);
    
            // Sanitize both passwords by removing non-printable characters
            $password_hash = filter_var($password_hash, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
            $password = filter_var($password, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
    
            // Debugging: Output sanitized hashed password from the database
            var_dump($password_hash);
    
            // Check if the password is correct
            if ($password_hash === $password) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $db_email; // Use the email from the database
                header('Location: rooms.html');
                exit;
            } else {
                $error = 'Invalid password';
            }
        } else {
            $error = 'Invalid username';
        }
    
        // Close the prepared statement
        $stmt->close();
    }
    
    // Close the database connection
    $conn->close();
    ?>
    
    <!-- Display the error message if any -->
    <?php if (isset($error)) {?>
        <p><?= $error?></p>
    <?php }?>
    

   