<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <h1>Welcome to Hospital Admin Panel</h1>

    <h2>Doctor Bookings</h2>
    <table>
        <tr>
            <th>Email</th>
            <th>Doctor Name</th>
            <th>Patient Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Action</th> <!-- New column for delete action -->
        </tr>
        <?php
        // Establish database connection
        $connection = mysqli_connect('localhost', 'root', '', 'test1');

        // Check if connection is successful
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if the form is submitted for delete action
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
            // Retrieve email from the form
            $email = $_POST['email'];

            // Prepare SQL statement to delete the booking based on email
            $delete_query = "DELETE FROM doctor_booking WHERE email = ?";
            $stmt = mysqli_prepare($connection, $delete_query);

            // Bind parameters
            mysqli_stmt_bind_param($stmt, "s", $email);

            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Close statement
            mysqli_stmt_close($stmt);

            // Redirect back to the admin panel
            header("Location: admin.php");
            exit();
        }

        // Fetch doctor bookings from the database
        $doctorBookingsQuery = "SELECT * FROM doctor_booking";
        $doctorBookingsResult = mysqli_query($connection, $doctorBookingsQuery);

        // Display doctor bookings
        while ($row = mysqli_fetch_assoc($doctorBookingsResult)) {
            echo "<tr>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['doctor'] . "</td>"; // Display doctor's name
            echo "<td>" . $row['name'] . "</td>"; // Display patient's name
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . $row['time'] . "</td>"; // Display booking time
            // Add delete button with form for each booking
            echo "<td>";
            echo "<form action='' method='POST'>"; // Corrected form action
            echo "<input type='hidden' name='email' value='" . $row['email'] . "'>";
            echo "<button type='submit'>Delete</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }

        // Close database connection
        mysqli_close($connection);
        ?>
    </table>




    
    <h2>ICU Bookings</h2>
    <table>
        <tr>
            <th>Email</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Hospital</th>
            <th>Ward Type</th>
            <th>Date</th>
            <th>Action</th> <!-- New column for delete action -->
        </tr>
        <?php
        // Establish database connection
        $connection = mysqli_connect('localhost', 'root', '', 'test1');

        // Check if connection is successful
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if the form is submitted for delete action
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
            // Retrieve email from the form
            $email_icu = $_POST['email'];

            // Prepare SQL statement to delete the booking based on email
            $delete_query_icu = "DELETE FROM icubooking WHERE email = ?";
            $stmt_icu = mysqli_prepare($connection, $delete_query_icu);

            // Bind parameters
            mysqli_stmt_bind_param($stmt_icu, "s", $email_icu);

            // Execute the statement
            mysqli_stmt_execute($stmt_icu);

            // Close statement
            mysqli_stmt_close($stmt_icu);

            // Redirect back to the admin panel
            header("Location: admin.php");
            exit();
        }

        // Fetch ICU bookings from the database
        $icuBookingsQuery = "SELECT * FROM icubooking";
        $icuBookingsResult = mysqli_query($connection, $icuBookingsQuery);

        // Display ICU bookings
        while ($row = mysqli_fetch_assoc($icuBookingsResult)) {
            echo "<tr>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['name'] . "</td>"; // Display patient's name
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['hospital'] . "</td>";
            echo "<td>" . $row['wardType'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            // Add delete button with form for each booking
            echo "<td>";
            echo "<form action='' method='POST'>"; // Corrected form action
            echo "<input type='hidden' name='email' value='" . $row['email'] . "'>";
            echo "<button type='submit'>Delete</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }

        // Close database connection
        mysqli_close($connection);
        ?>
    </table>

    <!-- Repeat similar blocks for inquiries, and packages -->

</body>

</html>
