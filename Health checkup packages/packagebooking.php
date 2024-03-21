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

// Initialize success message
$success_message = '';

// Form submission handling
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $package = $_POST['package'];
    $date = $_POST['date'];

    // Insert data into database
    $sql = "INSERT INTO packagebooking (name, phone, email, package, date) VALUES ('$name', '$phone', '$email', '$package', '$date')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Booking for $package sent successfully!";
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
    <title>Health Checkup Booking</title>
    <link rel="stylesheet" href="packagebooking.css">
</head>
<body>

    <h2>Health Checkup Booking</h2>

    <!-- Success message -->
    <?php if (!empty($success_message)) : ?>
        <div class="success-message"><?php echo $success_message; ?></div>
    <?php endif; ?>

    <!-- Booking form -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="booking-form">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="package">Select Package:</label>
        <select id="package" name="package" required>
            <option value="PRE-RAMADAN HEALTH CHECKUP PACKAGE">Pre-Ramadan Health Checkup Package</option>
            <option value="HOME HEALTH CHECKUP PACKAGE">Home Health Checkup Package</option>
            <option value="WHOLE BODY CHECKUP (FOR WOMEN BELOW 45 YEARS)">Whole Body Checkup (For Women Below 45 Years)</option>
            <option value="CHILD HEALTH PACKAGE">Child Health Package</option>
            <option value="WHOLE BODY CHECK (FOR MEN BELOW 45 YEARS)">Whole Body Check (For Men Below 45 Years)</option>
        </select>

        <label for="date">Select Booking Date:</label>
        <input type="date" id="date" name="date" required>

        <button type="submit" name="submit">Book Now</button>
    </form>

</body>
</html>
