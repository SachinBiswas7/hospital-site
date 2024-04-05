<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Booking</title>
    <link rel="stylesheet" href="icubooking.css">
</head>
<body>

    <header>
        <a href="./index.php" id="backButton"> Back</a>
        <h1>Hospital Booking</h1>
    </header>

    <section>
        <h2>Book an ICU/CCU/General Cabin</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="hospital">Select Hospital:</label>
            <select id="hospital" name="hospital" required>
                <option value="hospital1">Hospital 1</option>
                <option value="hospital2">Hospital 2</option>
                <!-- Add more hospital options as needed -->
            </select>

            <label for="wardType">Select Ward Type:</label>
            <div id="wardType">
                <input type="radio" id="icu" name="wardType" value="icu" required>
                <label for="icu">ICU</label>

                <input type="radio" id="ccu" name="wardType" value="ccu" required>
                <label for="ccu">CCU</label>

                <input type="radio" id="generalCabin" name="wardType" value="generalCabin" required>
                <label for="generalCabin">General Cabin</label>
            </div>

            <label for="date">Select Date:</label>
            <input type="date" id="date" name="date" required>

            <button type="submit">Book Appointment</button>
        </form>

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
            $phone = $_POST['phone'];
            $hospital = $_POST['hospital'];
            $wardType = $_POST['wardType'];
            $date = $_POST['date'];

            // Check if there are any existing bookings for the same ward and date
            $check_query = "SELECT * FROM icubooking WHERE hospital='$hospital' AND wardType='$wardType' AND date='$date'";
            $result = $conn->query($check_query);
            if ($result->num_rows > 0) {
                echo "Sorry, this ward is already booked on the selected date. Please choose a different date or ward.";
            } else {
                // Prepare and bind the SQL statement
                $stmt = $conn->prepare("INSERT INTO icubooking (name, email, phone, hospital, wardType, date) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $name, $email, $phone, $hospital, $wardType, $date);

                // Execute the statement
                if ($stmt->execute()) {
                    echo "Booking successful. Thank you!";
                } else {
                    echo "Error: " . $stmt->error;
                }

                // Close statement
                $stmt->close();
            }
        }

        // Close connection
        $conn->close();
        ?>
    </section>

</body>
</html>
