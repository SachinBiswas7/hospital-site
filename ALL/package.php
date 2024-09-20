<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test1";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission handling
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $package = $_POST['package'];

    // Insert data into database
    $sql = "INSERT INTO bookings (name, email, date, package) VALUES ('$name', '$email', '$date', '$package')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Booking for $package sent successfully!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Website</title>
    <link rel="stylesheet" href="./package.css">
</head>
<body>

    <!-- Booking form for Pre-Ramadan Health Checkup Package -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="booking-form">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <input type="date" name="date" required>
        <input type="hidden" name="package" value="Pre-Ramadan Health Checkup Package">
        <button type="submit" name="submit">Book Now</button>
    </form>

    <!-- Booking form for Home Health Checkup Package -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="booking-form">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <input type="date" name="date" required>
        <input type="hidden" name="package" value="Home Health Checkup Package">
        <button type="submit" name="submit">Book Now</button>
    </form>

    <!-- Add more booking forms for other packages -->
    <!-- Example: -->
    <!-- Booking form for Whole Body Checkup Package -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="booking-form">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <input type="date" name="date" required>
        <input type="hidden" name="package" value="Whole Body Checkup Package">
        <button type="submit" name="submit">Book Now</button>
    </form>

    <!-- Footer and other HTML content -->
</body>
</html>
