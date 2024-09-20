<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hospital Inquiry</title>
  <link rel="stylesheet" href="inquary.css">
</head>
<body>

  <header>
    <a href="./index.php" id="backButton"> Back</a>
    <h1>Hospital Inquiry</h1>
  </header>









  <form action="#" method="post">
    <label for="name">Your Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Your Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="message">Your Message:</label>
    <textarea id="message" name="message" required></textarea>

    <input type="submit" value="Submit Inquiry">
  </form>

</body>
</html>


<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "test1";
 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $name = $_POST['name'];
     $email = $_POST['email'];
     $message = $_POST['message'];
     // Prepare and bind the SQL statement
     $stmt = $conn->prepare("INSERT INTO inquiry (name, email, message) VALUES (?, ?, ?)");
     $stmt->bind_param("sss", $name, $email, $message);
     // Execute the statement
     if ($stmt->execute()) {
         echo "Inquiry submitted successfully. Thank you!";
     } else {
         echo "Error: " . $stmt->error;
     }
     // Close statement
     $stmt->close();
 }
 // Close connection
 $conn->close();
 ?>
