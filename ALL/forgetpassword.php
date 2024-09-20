<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="login.css">
    <style>
        /* Add your CSS styles here */
        .error-message {
            margin-top: 20px;
            text-align: center;
            color: red;
            font-weight: bold;
            position: static;
            bottom: 10px;
            width: 100%;
            margin-right: 10px;
        }
    </style>
    <script>
        function validateForm() {
            var usernameOrEmail = document.getElementById("username_or_email").value;
            if (usernameOrEmail == "") {
                alert("Please enter your username or email");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

    <div class="back-button">
        <a href="index.php"> Back To Home</a>
    </div>

    <div class="login-container">
        <h1>Forgot Password</h1>
        <form id="forgot-password-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" onsubmit="return validateForm()">
            <label for="username_or_email">Enter your username or email:</label>
            <input type="text" id="username_or_email" name="username_or_email" required>
            <button type="submit">Send Password Reset Link</button>
        </form>

        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "test1";

        // Establish connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Initialize error message variable
        $error_message = "";

        // Form submission handling
        if (isset($_POST['username_or_email'])) {
            $username_or_email = $_POST['username_or_email'];

            // Prepare and bind SQL statement using a prepared statement
            $sql = "SELECT * FROM list WHERE name = ? OR email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username_or_email, $username_or_email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // If user exists, retrieve their email and password
                $row = $result->fetch_assoc();
                $password = $row['password'];
                $email = $row['email'];

                // Send the password to the user's email
                $to = $email;
                $subject = "Password Reminder";
                $message = "Your password is: " . $password;
                $headers = "From: your_email@example.com"; // Replace with your email address

                // Validate email before sending
                if (filter_var($to, FILTER_VALIDATE_EMAIL)) {
                    // Send email
                    if (mail($to, $subject, $message, $headers)) {
                        // Display success message if email sent successfully
                        $error_message ='<span style="color: green;">An email with your password has been sent to your email address.</span>';
                    } else {
                        // Set error message if email failed to send
                        $error_message = '<span style="color: red;">Failed to send email. Please try again later.</span>';
                    }
                } else {
                    // Set error message for invalid email address
                    $error_message = '<span style="color: red;">Invalid email address.</span>';
                }
            } else {
                // Set error message if user does not exist
                $error_message = '<span style="color: red;">Username or email not found.</span>';
            }
            $stmt->close(); // Close prepared statement
        }

        // Close connection
        $conn->close();
        ?>

        <!-- Error message container -->
        <div class="error-message"><?php echo $error_message; ?></div>

        <div class="options">
            <p class="login-link" onclick="window.location.href='./login.php'">Remembered your password?    Log in</p>
        </div>
    </div>

</body>
</html>
