<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Find a Doctor</title>
  <link rel="stylesheet" href="finddoctor.css">
</head>

<body>

  <header>
    <nav>
        <div class="logo-container">
            <img src="healthhublogo.png.jpg" alt="HealthHub Logo" class="logo-img">
            <div class="logo">HealthHub</div>
        </div>
        <!-- Add the search bar in the middle -->
        <div class="search-form">
          <form action="search.php" method="GET">
              <input type="text" placeholder="Search..." name="search">
              <button type="submit">Search</button>
          </form>
      </div>
        <!-- Add the login, about us, services, and contract buttons on the right -->
        <div class="nav-buttons">
            <button onclick="window.location.href='./login.php'">Login</button>
            <button onclick="window.location.href='aboutus.html'">About Us</button>
            <button onclick="window.location.href='#contract'">Contact</button>
        </div>
    </nav>
</header>


  <main>
    <div class="department-buttons">
        <div class="department-buttons">
            <button id="surgeon" onclick="showDoctors('surgeon')">Surgeon</button>
            <button onclick="window.location.href='#medicine'">Medicine</button>
            <button onclick="window.location.href='#cardiologist'">Cardiologist</button>
            <button onclick="window.location.href='#dermatologist'">Dermatologist</button>
          </div>
          
    </div>

    <?php
      // Assuming you have already established a database connection
      $connection = mysqli_connect('localhost', 'root', '', 'test1');
      
      if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
      }
      
      // Function to display doctors for a specific department
      function displayDoctors($department, $connection) {
        $query = "SELECT * FROM doctor WHERE department = '$department'";
        $result = mysqli_query($connection, $query);
        
        if (mysqli_num_rows($result) > 0) {
          echo "<section id='$department' class='doctor-section'>";
          echo "<h2>$department Department</h2>";
          echo "<div class='doctor-profiles'>";
          
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='doctor-profile'>";
            echo "<img src='" . $row['image_url'] . "' alt='" . $row['name'] . "' style='max-width: 200px;'>";
            echo "<h3>" . $row['name'] . "</h3>";
            echo "<p>Qualification: " . $row['qualification'] . "</p>";
            echo "</div>";
          }
          
          echo "</div>";
          echo "</section>";
        }
      }
      
      // Display doctors for each department
      displayDoctors('Surgeon', $connection);
      displayDoctors('Medicine', $connection);
      displayDoctors('Cardiologist', $connection);
      displayDoctors('Dermatologist', $connection);
      
      mysqli_close($connection);
    ?>

      
    <footer class="footer">
      <div class="container">
          <div class="footer-content">
            
              <div class="footer-section links">
                  <h2>Quick Links</h2>
                  <ul>
                      <li><a href="./index.php">Home</a></li>
                      <li><a href="./aboutus.html">About</a></li>
                      <li><a href="#contract">Contact</a></li>
                      <li><a href="./logout.html">logout</a></li>
                    
                     
                  </ul>
              </div>
              <div class="footer-section contact-form">
                  <h2>Contact Us</h2>
                  <form action="#" class="contact-form-container">
                      <input id = "contract" type="email" name="email" class="text-input contact-input"
                          placeholder="Your email address">
                      <textarea name="message" class="text-input contact-input" placeholder="Your message"></textarea>
                      <button type="submit" class="btn btn-big">Send</button>
                  </form>
              </div>
          </div>
      </div>
      <div class="footer-bottom">
          &copy; 2024 Hospital Name. All rights reserved.
      </div>
  </footer>

    </main>

</body>

<script src="findadoctor.js"></script>

</html>
