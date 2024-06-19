<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Ambulance with Live Location</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <link rel="stylesheet" href="ambulance.css">
</head>
<body>
    <h1>Book Ambulance with Live Location</h1>
    <div id="map"></div>
    <p class="error-message" id="error-message"></p>

    <div class="form-container">
        <h2>Booking Details</h2>






        <form id="ambulanceForm" method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required>
            
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
            
            <label for="emergencyType">Emergency Type:</label>
            <select id="emergencyType" name="emergencyType" required>
                <option value="Accident">Accident</option>
                <option value="Medical Emergency">Medical Emergency</option>
                <option value="Other">Other</option>
            </select>
            
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">

            <button type="submit">Book Ambulance</button>
        </form>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="am.js"></script>
</body>
</html>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $emergencyType = $_POST['emergencyType'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test1";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO ambulance_bookings (name, phone, address, emergency_type, latitude, longitude)
            VALUES ('$name', '$phone', '$address', '$emergencyType', '$latitude', '$longitude')";
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green; text-align: center; font-size: 24px;'>New booking created successfully</p>";


    } else {
        echo "<p class='error-message'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
    $conn->close();
}
?>