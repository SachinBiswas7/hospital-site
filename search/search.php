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
if(isset($_GET['search'])) {
    $search_query = $_GET['search'];

    // Perform a database query to retrieve the link associated with the search query
    $sql = "SELECT link FROM search WHERE search_query LIKE '%$search_query%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // If search query matches, fetch the link from the database
        $row = $result->fetch_assoc();
        $link = $row['link'];

        // Redirect the user to the fetched link
        header("Location: $link");
        exit(); // Terminate the script after redirection
    } else {
        // If search query doesn't match, display a message or perform another action
        echo "No results found";
    }
}

$conn->close();
?>
