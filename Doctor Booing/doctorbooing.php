<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Booking</title>
  <link rel="stylesheet" href="doctorbooking.css">
  <style>
    /* Style for the message div */
    #message {
      display: none;
      color: green;
      font-weight: bold;
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <header>
    <a href="index.php" id="backButton"> Back</a>
    <h1>Doctor Booking</h1>
  </header>

  <section>
    <h2>Book an Appointment</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="appointmentForm">

      <label for="name">Your Name:</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="phone">Phone Number:</label>
      <input type="tel" id="phone" name="phone" required>

      <label for="specialty">Select Doctor's Specialty:</label>
      <select id="specialty" name="specialty" required>
        <option value="cardiologist">Cardiologist</option>
        <option value="dermatologist">Dermatologist</option>
      </select>

      <label for="doctor">Select Doctor's Name:</label>
      <select id="doctor" name="doctor" required>
      </select>

      <label for="date">Select Date:</label>
      <input type="date" id="date" name="date" required>

      <label for="time">Select Time:</label>
      <input type="time" id="time" name="time" required>

      <button type="submit">Book Appointment</button>
    </form>

    <!-- Message div to display success message -->
    <div id="message"></div>

    <?php
    $connection = mysqli_connect('localhost', 'root', '', 'test1');

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['specialty']) && isset($_POST['doctor']) && isset($_POST['date']) && isset($_POST['time'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $specialty = $_POST['specialty'];
            $doctor = $_POST['doctor'];
            $date = $_POST['date'];
            $time = $_POST['time'];

            // Check if there are any existing bookings for the same doctor at the same date and time
            $check_query = "SELECT * FROM doctor_booking WHERE doctor='$doctor' AND date='$date' AND time='$time'";
            $result = mysqli_query($connection, $check_query);
            if (mysqli_num_rows($result) > 0) {
                echo '<script>document.getElementById("message").innerText = "Sorry, this time slot is already booked by another patient. Please choose a different time."; document.getElementById("message").style.display = "block";</script>';
            } else {
                // If no conflicting bookings, proceed with inserting the new booking
                $request = "INSERT INTO doctor_booking (name, email, phone, specialty, doctor, date, time) VALUES ('$name', '$email', '$phone', '$specialty', '$doctor', '$date', '$time')";

                if (mysqli_query($connection, $request)) {
                    echo '<script>document.getElementById("message").innerText = "Record inserted successfully"; document.getElementById("message").style.display = "block";</script>';
                } else {
                    echo "Error: " . $request . "<br>" . mysqli_error($connection);
                }
            }
        } else {
            echo 'All fields are required';
        }
    }

    mysqli_close($connection);
    ?>

  </section>

  <script src="doctorbooking.js"></script>
  <script>
    const backButton = document.getElementById("backButton");

    backButton.addEventListener("click", () => {
      // Implement your back button functionality here
      // For example, redirect to the previous page using history.back()
      history.back();
    });
  </script>
</body>
</html>
