<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Website</title>
    <link rel="stylesheet" href="labstyle.css">
</head>

<body>

<header>
    <nav>
        <div class="logo-container">
            <img src="healthhublogo.png.jpg" alt="HealthHub Logo" class="logo-img">
            <div class="logo">HealthHub</div>
        </div>
        <div class="search-form">
            <form action="search.php" method="GET">
                <input type="text" placeholder="Search..." name="search">
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="nav-buttons">
            <button onclick="window.location.href='./login.php'">Login</button>
            <button onclick="window.location.href='aboutus.html'">About Us</button>
            <button onclick="window.location.href='#service'">Services</button>
            <button onclick="window.location.href='#contract'">Contact</button>
        </div>
    </nav>
</header>

<main>
    <section class="hospital-description">
        <img class="hospital-img" src="./5.png" alt="">
        <div id="service">Discover a holistic approach to wellness, personalized care, and a supportive community at HealthHub – because your health deserves the very best."</div>
    </section>
</main>

<div class="box">
    <div class="box1">
        <img src="1.png" class="box1-img" alt="Emergency Services">
        <h2 class="boxheader"><a href="finddoctor.html">Find a Doctor</a></h2>
    </div>
    <div class="box1">
        <img src="22.png" class="box1-img" alt="Send a inquiry">
        <h2 class="boxheader"><a href="./inqurey.php">Send an inquiry</a></h2>
    </div>
    <div class="box1">
        <img src="33.png" class="box1-img" alt="Book an appointment">
        <h2 class="boxheader"><a href="./doctorbooking.php">Book a Doctor</a></h2>
    </div>
    <div class="box1">
        <img src="8.png" class="box1-img" alt="icu booking">
        <h2 class="boxheader"><a href="icubooking.php">Book ICU/CCU</a></h2>
    </div>
</div>

<div class="recommendation-bar">
    <p>Check out our recommended packages for personalized care and exclusive benefits! <a href="package.html" class="btn">Explore Packages</a></p>
</div>

<div class="container">
    <div class="card">
        <img src="./OIP-removebg-preview.png" class="card-img" alt="Emergency Services">
        <h2>Emergency Services</h2>
        <p>24/7 emergency medical care</p>
    </div>
    <div class="card">
     <img src="./istockphoto-1167539456-612x612-removebg-preview (1).png" class="card-img" alt="Specialized Care">
     <h2>Specialized Care</h2>
     <p>Expert care for various medical conditions</p>
 </div>
 <div class="card">
     <img src="7.png" class="card-img" alt="Diagnostic Imaging">
     <h2>Diagnostic Imaging</h2>
     <p>State-of-the-art imaging technology</p>
 </div>
 <div class="card">
     <img src="./Vector-Pregnancy-PNG-Image-HD-removebg-preview.png" class="card-img" alt="Maternity Services">
     <h2>Maternity Services</h2>
     <p>Comprehensive maternity care</p>
 </div>
 <div class="card">
     <img src="./83e65ee110ba7abe01a06d472e5acd94-removebg-preview.png" class="card-img" alt="Surgery Department">
     <h2>Surgery Department</h2>
     <p>Advanced surgical procedures</p>
 </div>
 <div class="card">
     <img src="6.png" class="card-img" alt="Rehabilitation">
     <h2>Rehabilitation</h2>
     <p>Personalized rehabilitation programs</p>
 </div>
    <!-- Add more cards here -->
</div>

<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section links">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="./aboutus.html">About</a></li>
                    <li><a href="#service">Services</a></li>
                    <li><a href="#contract">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section contact-form">
                <h2>Contact Us</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="contact-form-container">
                    <input type="email" id= "contract" name="email" class="text-input contact-input" placeholder="Your email address">
                    <textarea name="message" class="text-input contact-input" placeholder="Your message"></textarea>
                    <button type="submit" name="submit" class="btn btn-big">Send</button>
                </form>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; 2024 Hospital Name. All rights reserved.
    </div>
</footer>

</body>

</html>

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
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Insert data into database
    $sql = "INSERT INTO contacts (email, message) VALUES ('$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>document.getElementById("message").innerText = "Message inserted successfully"; document.getElementById("message").style.display = "block";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
