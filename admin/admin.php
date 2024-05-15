<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to Hospital Admin Panel</h1>

        <!-- Doctor Bookings Section -->
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
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['doctor_email'])) {
                // Retrieve email from the form
                $email_doctor = $_POST['doctor_email'];
                // Prepare SQL statement to delete the booking based on email
                $delete_query_doctor = "DELETE FROM doctor_booking WHERE email = ?";
                $stmt_doctor = mysqli_prepare($connection, $delete_query_doctor);
                // Bind parameters
                mysqli_stmt_bind_param($stmt_doctor, "s", $email_doctor);
                // Execute the statement
                mysqli_stmt_execute($stmt_doctor);
                // Close statement
                mysqli_stmt_close($stmt_doctor);
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
                // Display other columns
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['doctor'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['time'] . "</td>";
                // Add delete button with form for each booking
                echo "<td>";
                echo "<form action='' method='POST'>"; // Corrected form action
                echo "<input type='hidden' name='doctor_email' value='" . $row['email'] . "'>"; // Changed name to doctor_email
                echo "<button type='submit'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            // Close database connection
            mysqli_close($connection);
            ?>
        </table>






        <!-- ICU Bookings Section -->
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
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['icu_email'])) {
                // Retrieve email from the form
                $email_icu = $_POST['icu_email'];
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
                // Display other columns
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['hospital'] . "</td>";
                echo "<td>" . $row['wardType'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                // Add delete button with form for each booking
                echo "<td>";
                echo "<form action='' method='POST'>"; // Corrected form action
                echo "<input type='hidden' name='icu_email' value='" . $row['email'] . "'>"; // Changed name to icu_email
                echo "<button type='submit'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            // Close database connection
            mysqli_close($connection);
            ?>
        </table>




        <!-- Package Bookings Section -->
<h2>Package Bookings</h2>
<table>
    <tr>
        <th>Email</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Package</th>
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
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['package_email'])) {
        // Retrieve email from the form
        $email_package = $_POST['package_email'];
        // Prepare SQL statement to delete the booking based on email
        $delete_query_package = "DELETE FROM packagebooking WHERE email = ?";
        $stmt_package = mysqli_prepare($connection, $delete_query_package);
        // Bind parameters
        mysqli_stmt_bind_param($stmt_package, "s", $email_package);
        // Execute the statement
        mysqli_stmt_execute($stmt_package);
        // Close statement
        mysqli_stmt_close($stmt_package);
        // Redirect back to the admin panel
        header("Location: admin.php");
        exit();
    }
    // Fetch package bookings from the database
    $packageBookingsQuery = "SELECT * FROM packagebooking";
    $packageBookingsResult = mysqli_query($connection, $packageBookingsQuery);
    // Display package bookings
    while ($row = mysqli_fetch_assoc($packageBookingsResult)) {
        echo "<tr>";
        // Display other columns
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['package'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        // Add delete button with form for each booking
        echo "<td>";
        echo "<form action='' method='POST'>"; // Corrected form action
        echo "<input type='hidden' name='package_email' value='" . $row['email'] . "'>"; // Changed name to package_email
        echo "<button type='submit'>Delete</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    // Close database connection
    mysqli_close($connection);
    ?>
</table>


<!-- Inquiry Section -->
<h2>Inquiries</h2>
<table>
    <tr>
        <th>Email</th>
        <th>Name</th>
        <th>Message</th>
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
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['inquiry_email'])) {
        // Retrieve email from the form
        $email_inquiry = $_POST['inquiry_email'];
        // Prepare SQL statement to delete the inquiry based on email
        $delete_query_inquiry = "DELETE FROM inquiry WHERE email = ?";
        $stmt_inquiry = mysqli_prepare($connection, $delete_query_inquiry);
        // Bind parameters
        mysqli_stmt_bind_param($stmt_inquiry, "s", $email_inquiry);
        // Execute the statement
        mysqli_stmt_execute($stmt_inquiry);
        // Close statement
        mysqli_stmt_close($stmt_inquiry);
        // Redirect back to the admin panel
        header("Location: admin.php");
        exit();
    }
    // Fetch inquiries from the database
    $inquiryQuery = "SELECT * FROM inquiry";
    $inquiryResult = mysqli_query($connection, $inquiryQuery);
    // Display inquiries
    while ($row = mysqli_fetch_assoc($inquiryResult)) {
        echo "<tr>";
        // Display other columns
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['message'] . "</td>";
        // Add delete button with form for each inquiry
        echo "<td>";
        echo "<form action='' method='POST'>"; // Corrected form action
        echo "<input type='hidden' name='inquiry_email' value='" . $row['email'] . "'>"; // Changed name to inquiry_email
        echo "<button type='submit'>Delete</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    // Close database connection
    mysqli_close($connection);
    ?>
</table>


<!-- Contacts Section -->
<h2>Contacts</h2>
<table>
    <tr>
        <th>Email</th>
        <th>Message</th>
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
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact_email'])) {
        // Retrieve email from the form
        $email_contact = $_POST['contact_email'];
        // Prepare SQL statement to delete the contact based on email
        $delete_query_contact = "DELETE FROM contacts WHERE email = ?";
        $stmt_contact = mysqli_prepare($connection, $delete_query_contact);
        // Bind parameters
        mysqli_stmt_bind_param($stmt_contact, "s", $email_contact);
        // Execute the statement
        mysqli_stmt_execute($stmt_contact);
        // Close statement
        mysqli_stmt_close($stmt_contact);
        // Redirect back to the admin panel
        header("Location: admin.php");
        exit();
    }
    // Fetch contacts from the database
    $contactQuery = "SELECT * FROM contacts";
    $contactResult = mysqli_query($connection, $contactQuery);
    // Display contacts
    while ($row = mysqli_fetch_assoc($contactResult)) {
        echo "<tr>";
        // Display other columns
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['message'] . "</td>";
        // Add delete button with form for each contact
        echo "<td>";
        echo "<form action='' method='POST'>"; // Corrected form action
        echo "<input type='hidden' name='contact_email' value='" . $row['email'] . "'>"; // Changed name to contact_email
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
    </div>
</body>
</html>
