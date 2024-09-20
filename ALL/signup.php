<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="signup.css">
    <style>
        .success-message {
            color: darkgreen;
        }
        .error-message {
            color: darkred;
        }
    </style>
</head>
<body>
    <div class="back-button">
        <a href="index.php"> Back To Home</a>
    </div>
    <div class="login-container">
        <h1>Sign Up</h1>
        <form id="signup-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
           <input type="password" id="password" name="password" required>
            <button type="submit" name="send">Sign Up</button>
        </form>
        <div id="message" style="display: none;"></div>
        <div class="options">
            <p class="login-link" onclick="window.location.href='./login.php'">Login</p>
            <p class="forgot-password-link" onclick="window.location.href='./forgetpassword.php'">Forgot Password?</p>
        </div>
    </div>
    <script src="login.js"></script>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $connection = mysqli_connect('localhost', 'root', '', 'test1');

        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
            $name = mysqli_real_escape_string($connection, $_POST['name']);
            $email = mysqli_real_escape_string($connection, $_POST['email']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);

            // Check if the email already exists
            $check_query = "SELECT * FROM list WHERE email = '$email'";
            $result = mysqli_query($connection, $check_query);
            if (mysqli_num_rows($result) > 0) {
                echo '<script>document.getElementById("message").innerText = "' . htmlspecialchars("This email is already registered.") . '"; document.getElementById("message").style.color = "darkred"; document.getElementById("message").style.display = "block";</script>';
            } 
            else {
          // Email doesn't exist, proceed with insertion
                $request = "INSERT INTO list (name, email, password) VALUES ('$name', '$email', '$password')";

                if (mysqli_query($connection, $request)) {
                    echo '<script>document.getElementById("message").innerText = "Record inserted successfully"; document.getElementById("message").style.color = "darkgreen"; document.getElementById("message").style.display = "block";</script>';
                } else {
                    echo "Error: " . $request . "<br>" . mysqli_error($connection);
                }
            }
        } else {
            echo '<script>document.getElementById("message").innerText = "All fields are required"; document.getElementById("message").style.color = "darkred"; document.getElementById("message").style.display = "block";</script>';
        }

        mysqli_close($connection);
    }
    ?>
</body>
</html>
