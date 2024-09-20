<?php
$connection = mysqli_connect('localhost', 'root', '', 'test1');

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get doctor information from the form
    $name = $_POST['doctor_name'];
    $department = $_POST['doctor_department'];
    $qualification = $_POST['doctor_qualification'];

    // Handle image upload
    $image_dir = 'doctor_images/'; // Directory to store uploaded images
    $image_name = $_FILES['doctor_image']['name'];
    $image_tmp = $_FILES['doctor_image']['tmp_name'];
    $image_type = $_FILES['doctor_image']['type'];

    // Check if the uploaded file is a JPEG
    if ($image_type == 'image/jpeg') {
        // Move the uploaded image to the specified directory
        move_uploaded_file($image_tmp, $image_dir . $image_name);

        // Insert doctor information into the database
        $insert_query = "INSERT INTO doctor (name, department, qualification, image_url) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $insert_query);
        $image_url = $image_dir . $image_name;
        mysqli_stmt_bind_param($stmt, "ssss", $name, $department, $qualification, $image_url);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Redirect back to the admin page after insertion
        header("Location: admin.php");
        exit();
    } else {
        // If the uploaded file is not a JPEG, show an error message
        echo "Only JPEG files are allowed.";
    }
}

mysqli_close($connection);
?>
