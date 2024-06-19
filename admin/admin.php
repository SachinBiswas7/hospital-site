<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    
    <title>Admin Page</title>
    <style>
              
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
    }
    .container {
        max-width: 1500px;
        margin: 20px auto;
        padding: 0px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
        font-size: 60px;
        margin-bottom: 30px;
    
        color: rgb(11, 11, 93);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
    }
    th {
        background-color: #f2f2f2;
    }
    .action-buttons {
        display: flex;
        gap: 10px;
    }
    form {
        display: inline-block;
    }
    .form-group {
        margin-bottom: 10px;
    }
    .form-group label {
        display: inline-block;
        width: 70px;
    }
    .form-group input {
        padding: 5px;
    }
    /* Styling for the update button */
    button.update-button {
        padding: 5px 10px;
        cursor: pointer;
        background-color: green;
        color: white;
        border: none;
    }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Panel</h1>


        <!-- Doctor Bookings Section -->

    <h2>Doctor Bookings</h2>
    <table>
        <tr>
            <th>Email</th>
            <th>Doctor Name</th>
            <th>Patient Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Action</th>
        </tr>
        <?php
        $connection = mysqli_connect('localhost', 'root', '', 'test1');
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['delete_doctor_email'])) {
                $email_doctor = $_POST['delete_doctor_email'];
                $delete_query_doctor = "DELETE FROM doctor_booking WHERE email = ?";
                $stmt_doctor = mysqli_prepare($connection, $delete_query_doctor);
                mysqli_stmt_bind_param($stmt_doctor, "s", $email_doctor);
                mysqli_stmt_execute($stmt_doctor);
                mysqli_stmt_close($stmt_doctor);
                header("Location: admin.php");
                exit();
            } elseif (isset($_POST['update_doctor_email'])) {
                $email = $_POST['update_doctor_email'];
                $doctor = $_POST['update_doctor'];
                $name = $_POST['update_name'];
                $date = $_POST['update_date'];
                $time = $_POST['update_time'];
                $update_query_doctor = "UPDATE doctor_booking SET doctor = ?, name = ?, date = ?, time = ? WHERE email = ?";
                $stmt_doctor = mysqli_prepare($connection, $update_query_doctor);
                mysqli_stmt_bind_param($stmt_doctor, "sssss", $doctor, $name, $date, $time, $email);
                mysqli_stmt_execute($stmt_doctor);
                mysqli_stmt_close($stmt_doctor);
                header("Location: admin.php");
                exit();
            }
        }
        $doctorBookingsQuery = "SELECT * FROM doctor_booking";
        $doctorBookingsResult = mysqli_query($connection, $doctorBookingsQuery);
        while ($row = mysqli_fetch_assoc($doctorBookingsResult)) {
            echo "<tr>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['doctor'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . $row['time'] . "</td>";
            echo "<td class='action-buttons'>";
            echo "<form action='' method='POST'>";
            echo "<input type='hidden' name='delete_doctor_email' value='" . $row['email'] . "'>";
            echo "<button type='submit' style='background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;'>Delete</button>";
            echo "</form>";
            echo "<form action='' method='POST'>";
            echo "<input type='hidden' name='update_doctor_email' value='" . $row['email'] . "'>";
            echo "<br>"; // Adding a line break for spacing
            echo "Doctor: <input type='text' name='update_doctor' value='" . $row['doctor'] . "'>";
            echo "<br>"; // Adding a line break for spacing
            echo "Name: <input type='text' name='update_name' value='" . $row['name'] . "'>";
            echo "<br>"; // Adding a line break for spacing
            echo "Date: <input type='date' name='update_date' value='" . $row['date'] . "'>";
            echo "<br>"; // Adding a line break for spacing
            echo "Time: <input type='time' name='update_time' value='" . $row['time'] . "'>";
            echo "<br>"; // Adding a line break for spacing
            echo "<button class='update-button' type='submit'>Update</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
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
                <th>Action</th>
            </tr>
            <?php
            $connection = mysqli_connect('localhost', 'root', '', 'test1');
            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['delete_icu_email'])) {
                    $email_icu = $_POST['delete_icu_email'];
                    $delete_query_icu = "DELETE FROM icubooking WHERE email = ?";
                    $stmt_icu = mysqli_prepare($connection, $delete_query_icu);
                    mysqli_stmt_bind_param($stmt_icu, "s", $email_icu);
                    mysqli_stmt_execute($stmt_icu);
                    mysqli_stmt_close($stmt_icu);
                    header("Location: admin.php");
                    exit();
                } elseif (isset($_POST['update_icu_email'])) {
                    $email = $_POST['update_icu_email'];
                    $name = $_POST['update_name'];
                    $phone = $_POST['update_phone'];
                    $hospital = $_POST['update_hospital'];
                    $wardType = $_POST['update_wardType'];
                    $date = $_POST['update_date'];
                    $update_query_icu = "UPDATE icubooking SET name = ?, phone = ?, hospital = ?, wardType = ?, date = ? WHERE email = ?";
                    $stmt_icu = mysqli_prepare($connection, $update_query_icu);
                    mysqli_stmt_bind_param($stmt_icu, "ssssss", $name, $phone, $hospital, $wardType, $date, $email);
                    mysqli_stmt_execute($stmt_icu);
                    mysqli_stmt_close($stmt_icu);
                    header("Location: admin.php");
                    exit();
                }
            }
            $icuBookingsQuery = "SELECT * FROM icubooking";
            $icuBookingsResult = mysqli_query($connection, $icuBookingsQuery);
            while ($row = mysqli_fetch_assoc($icuBookingsResult)) {
                echo "<tr>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['hospital'] . "</td>";
                echo "<td>" . $row['wardType'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td class='action-buttons'>";
                echo "<form action='' method='POST'>";
                echo "<input type='hidden' name='delete_icu_email' value='" . $row['email'] . "'>";
                echo "<button type='submit' style='background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;'>Delete</button>";
                echo "</form>";
                echo "<form action='' method='POST'>";
                echo "<input type='hidden' name='update_icu_email' value='" . $row['email'] . "'>";
                echo "<div class='form-group'>";
                echo "<label>Name:</label>";
                echo "<input type='text' name='update_name' value='" . $row['name'] . "'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label>Phone:</label>";
                echo "<input type='text' name='update_phone' value='" . $row['phone'] . "'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label>Hospital:</label>";
                echo "<input type='text' name='update_hospital' value='" . $row['hospital'] . "'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label>Ward Type:</label>";
                echo "<input type='text' name='update_wardType' value='" . $row['wardType'] . "'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label>Date:</label>";
                echo "<input type='date' name='update_date' value='" . $row['date'] . "'>";
                echo "</div>";
                echo "<button type='submit' class='update-button'>Update</button>";

                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
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
                <th>Action</th>
            </tr>
            <?php
            $connection = mysqli_connect('localhost', 'root', '', 'test1');
            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['delete_package_email'])) {
                    $email_package = $_POST['delete_package_email'];
                    $delete_query_package = "DELETE FROM packagebooking WHERE email = ?";
                    $stmt_package = mysqli_prepare($connection, $delete_query_package);
                    mysqli_stmt_bind_param($stmt_package, "s", $email_package);
                    mysqli_stmt_execute($stmt_package);
                    mysqli_stmt_close($stmt_package);
                    header("Location: admin.php");
                    exit();
                } elseif (isset($_POST['update_package_email'])) {
                    $email = $_POST['update_package_email'];
                    $name = $_POST['update_name'];
                    $phone = $_POST['update_phone'];
                    $package = $_POST['update_package'];
                    $date = $_POST['update_date'];
                    $update_query_package = "UPDATE packagebooking SET name = ?, phone = ?, package = ?, date = ? WHERE email = ?";
                    $stmt_package = mysqli_prepare($connection, $update_query_package);
                    mysqli_stmt_bind_param($stmt_package, "sssss", $name, $phone, $package, $date, $email);
                    mysqli_stmt_execute($stmt_package);
                    mysqli_stmt_close($stmt_package);
                    header("Location: admin.php");
                    exit();
                }
            }
            $packageBookingsQuery = "SELECT * FROM packagebooking";
            $packageBookingsResult = mysqli_query($connection, $packageBookingsQuery);
            while ($row = mysqli_fetch_assoc($packageBookingsResult)) {
                echo "<tr>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['package'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td class='action-buttons'>";
                echo "<form action='' method='POST'>";
                echo "<input type='hidden' name='delete_package_email' value='" . $row['email'] . "'>";
                echo "<button type='submit' style='background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;'>Delete</button>";
                echo "</form>";
                echo "<form action='' method='POST'>";
                echo "<input type='hidden' name='update_package_email' value='" . $row['email'] . "'>";
                echo "<div class='form-group'>";
                echo "<label>Name:</label>";
                echo "<input type='text' name='update_name' value='" . $row['name'] . "'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label>Phone:</label>";
                echo "<input type='text' name='update_phone' value='" . $row['phone'] . "'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label>Package:</label>";
                echo "<input type='text' name='update_package' value='" . $row['package'] . "'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label>Date:</label>";
                echo "<input type='date' name='update_date' value='" . $row['date'] . "'>";
                echo "</div>";
                echo "<button type='submit' class='update-button'>Update</button>";

                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            mysqli_close($connection);
            ?>
        </table>














        <!-- Contact Messages Section -->
        <h2>Contact Messages</h2>
        <table>
            <tr>
                <th>Email</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
            <?php
            $connection = mysqli_connect('localhost', 'root', '', 'test1');
            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['delete_contact_email'])) {
                    $email_contact = $_POST['delete_contact_email'];
                    $delete_query_contact = "DELETE FROM contacts WHERE email = ?";
                    $stmt_contact = mysqli_prepare($connection, $delete_query_contact);
                    mysqli_stmt_bind_param($stmt_contact, "s", $email_contact);
                    mysqli_stmt_execute($stmt_contact);
                    mysqli_stmt_close($stmt_contact);
                    header("Location: admin.php");
                    exit();
                } elseif (isset($_POST['update_contact_email'])) {
                    $email = $_POST['update_contact_email'];
                    $message = $_POST['update_message'];
                    $update_query_contact = "UPDATE contacts SET message = ? WHERE email = ?";
                    $stmt_contact = mysqli_prepare($connection, $update_query_contact);
                    mysqli_stmt_bind_param($stmt_contact, "ss", $message, $email);
                    mysqli_stmt_execute($stmt_contact);
                    mysqli_stmt_close($stmt_contact);
                    header("Location: admin.php");
                    exit();
                }
            }
            $contactQuery = "SELECT * FROM contacts";
            $contactResult = mysqli_query($connection, $contactQuery);
            while ($row = mysqli_fetch_assoc($contactResult)) {
                echo "<tr>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['message'] . "</td>";
                echo "<td class='action-buttons'>";
                echo "<form action='' method='POST'>";
                echo "<input type='hidden' name='delete_contact_email' value='" . $row['email'] . "'>";
                echo "<button type='submit' style='background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;'>Delete</button>";
                echo "</form>";
            }
        
            ?>
        </table>






        <!-- Inquiry Section -->
        <h2>Inquiries</h2>
        <table>
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
            <?php
            $connection = mysqli_connect('localhost', 'root', '', 'test1');
            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['delete_inquiry_email'])) {
                    $email_inquiry = $_POST['delete_inquiry_email'];
                    $delete_query_inquiry = "DELETE FROM inquiry WHERE email = ?";
                    $stmt_inquiry = mysqli_prepare($connection, $delete_query_inquiry);
                    mysqli_stmt_bind_param($stmt_inquiry, "s", $email_inquiry);
                    mysqli_stmt_execute($stmt_inquiry);
                    mysqli_stmt_close($stmt_inquiry);
                    header("Location: admin.php");
                    exit();
                } elseif (isset($_POST['update_inquiry_email'])) {
                    $email = $_POST['update_inquiry_email'];
                    $name = $_POST['update_name'];
                    $message = $_POST['update_message'];
                    $update_query_inquiry = "UPDATE inquiry SET name = ?, message = ? WHERE email = ?";
                    $stmt_inquiry = mysqli_prepare($connection, $update_query_inquiry);
                    mysqli_stmt_bind_param($stmt_inquiry, "sss", $name, $message, $email);
                    mysqli_stmt_execute($stmt_inquiry);
                    mysqli_stmt_close($stmt_inquiry);
                    header("Location: admin.php");
                    exit();
                }
            }
            $inquiryQuery = "SELECT * FROM inquiry";
            $inquiryResult = mysqli_query($connection, $inquiryQuery);
            while ($row = mysqli_fetch_assoc($inquiryResult)) {
                echo "<tr>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['message'] . "</td>";
                echo "<td class='action-buttons'>";
                echo "<form action='' method='POST'>";
                echo "<input type='hidden' name='delete_inquiry_email' value='" . $row['email'] . "'>";
                echo "<button type='submit' style='background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;'>Delete</button>";
                echo "</form>";
            }
            mysqli_close($connection);
            ?>
        </table>
    </div>
</body>
</html>














<!-- Add a form to input doctor information including image upload -->
<h2>Add Doctor</h2>
<form action="add_doctor.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="doctor_name">
    </div>
    <div class="form-group">
        <label>Department:</label>
        <input type="text" name="doctor_department">
    </div>
    <div class="form-group">
        <label>Qualification:</label>
        <input type="text" name="doctor_qualification">
    </div>
    <div class="form-group">
        <label>Image:</label>
        <input type="file" name="doctor_image">
    </div>
    <button type="submit">Add Doctor</button>
</form>




<!-- Ambulance Bookings Section -->
<h2>Ambulance Bookings</h2>
<table>
    <tr>
        <th>Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Emergency Type</th>
        <th>Action</th>
    </tr>
    <?php
    // Establish database connection
    $connection = mysqli_connect('localhost', 'root', '', 'test1');

    // Check if connection was successful
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Delete functionality
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_ambulance_id'])) {
        $id = $_POST['delete_ambulance_id'];
        $delete_query = "DELETE FROM ambulance_bookings WHERE id = ?";
        $stmt = mysqli_prepare($connection, $delete_query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        // Redirect back to the same page to avoid re-submitting form data
       
       
    }

    // Example code for retrieving and displaying ambulance bookings
    $ambulanceBookingsQuery = "SELECT * FROM ambulance_bookings";
    $ambulanceBookingsResult = mysqli_query($connection, $ambulanceBookingsQuery);

    // Check if query execution was successful
    if (!$ambulanceBookingsResult) {
        die("Query failed: " . mysqli_error($connection));
    }

    // Display results if there are rows returned
    if (mysqli_num_rows($ambulanceBookingsResult) > 0) {
        while ($row = mysqli_fetch_assoc($ambulanceBookingsResult)) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['emergency_type'] . "</td>";
            echo "<td class='action-buttons'>";
            echo "<form action='' method='POST'>";
            echo "<input type='hidden' name='delete_ambulance_id' value='" . $row['id'] . "'>";
            echo "<button type='submit' style='background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;'>Delete</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No ambulance bookings found</td></tr>";
    }

    // Close connection
    mysqli_close($connection);
    ?>
</table>
