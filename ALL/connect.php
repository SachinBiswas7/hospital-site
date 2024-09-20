<?php
$connection = mysqli_connect('localhost', 'root', '', 'test1');

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email already exists
    $check_query = "SELECT * FROM list WHERE email = '$email'";
    $result = mysqli_query($connection, $check_query);
    if (mysqli_num_rows($result) > 0) {
        echo "This email is already registered.";
    } else {
        // Email doesn't exist, proceed with insertion
        $request = "INSERT INTO list (name, email, password) VALUES ('$name', '$email', '$password')";

        if (mysqli_query($connection, $request)) {
            echo "Record inserted successfully";
        } else {
            echo "Error: " . $request . "<br>" . mysqli_error($connection);
        }
    }
} else {
    echo 'All fields are required';
}

mysqli_close($connection);
?>
