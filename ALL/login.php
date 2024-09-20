<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <div class="back-button">
        <a href="index.php"> Back To Home</a>
    </div>

    <div class="login-container">
        <h1>Login</h1>
        <form id="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <?php
        session_start(); // Start the session

        // Establish database connection
        $connection = mysqli_connect('localhost', 'root', '', 'test1');

        // Check if connection is successful
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $email = $_POST['email'];
            $password = $_POST['password'];

            // SQL query to check if email and password match
            $query = "SELECT * FROM list WHERE email='$email' AND password='$password'";
            $result = mysqli_query($connection, $query);

            // Check if there's a match
            if (mysqli_num_rows($result) == 1) {
                // Authentication successful
                $row = mysqli_fetch_assoc($result);
                if ($row['email'] == 'admin@gmail.com' && $row['password'] == 'admin') {
                    // If the user is admin, redirect to admin panel
                    header("Location: admin.php");
                    exit(); // Ensure no further code is executed after redirection
                } else {
                    // For regular users, set session variable and redirect to home page
                    $_SESSION['user'] = $email; // You can set any value you want for the session variable
                    header("Location: index.php"); // Redirect to the home page
                    exit(); // Ensure no further code is executed after redirection
                }
            } else {
                // Authentication failed, display error message
                echo '<p style="color: red;">Invalid email or password. Please try again.</p>';
            }
        }

        // Close database connection
        mysqli_close($connection);
        ?>


        <div class="options">
            <p class="signup-link" onclick="window.location.href='./signup.php'">Sign Up</p>
            <p class="forgot-password-link" onclick="window.location.href='./Forgetpassword.php'">Forgot Password?</p>
        </div>
    </div>

    <script src="login.js"></script>

</body>

</html>
