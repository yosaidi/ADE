<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ade ziri oujda</title>    <!-- Bootstrap CSS CDN -->
    <link rel="icon" href="img/logo.jpg" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

</head>

<body>

   <!-- Header -->
<header class="container-fluid py-3">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <a class="navbar-brand" href="index.html">
            <img src="img/logo.jpg" alt="ENCGO Student Association Logo" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.html">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="events.html">Events</a></li>
                <li class="nav-item"><a class="nav-link" href="clubs.php">Clubs</a></li>
                <li class="nav-item"><a class="nav-link" href="partners.html">Partners</a></li>
                <li class="nav-item"><a class="nav-link" href="ticketing.html">Ticketing</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.html">Contact Us</a></li>
            </ul>
        </div>
    </nav>
</header>

    <!-- Clubs Section -->
    <section id="clubs" class="clubs-section py-5">
        <div class="container">
            <h2 >Our Clubs</h2>
            <div class="club-grid row">
                <?php
                // Database connection (replace with your database credentials)
                $dsn = 'mysql:host=localhost;dbname=clubs;charset=utf8mb4';
                $username = 'root';
                $password = 'younes1629';

                try {
                    $conn = new PDO($dsn, $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // SQL query to fetch all clubs
                    $sql = "SELECT club_name, img_path, instagram_link FROM clubs";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    // Check if there are any results
                    if ($stmt->rowCount() > 0) {
                        // Output data for each club
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            // Sanitize output to prevent XSS
                            $clubName = htmlspecialchars($row["club_name"]);
                            $imgPath = htmlspecialchars($row["img_path"]);
                            $instagramLink = htmlspecialchars($row["instagram_link"]);
                        
                            echo '<div class="club-card col-md-3 text-center">';
                            echo '<img src="' . $imgPath . '" alt="' . $clubName . ' Logo" class="img-fluid mb-3">';
                            echo '<h4>' . $clubName . '</h4>';
                            echo '<a href="' . $instagramLink . '" target="_blank" class="btn btn-outline-primary">Instagram Page</a>';
                            echo '</div>';
                        }
                        
                    } else {
                        echo '<p>No clubs found.</p>';
                    }

                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }

                // Close the connection
                $conn = null;
                ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="footer">
        <div class="container">
            <p>Follow us on social media!</p>
            <a href="https://www.instagram.com/ade.encgo" target="_blank" class="social-link">
                <i class="fab fa-instagram fa-lg"></i> Instagram
            </a>
            <p>&copy; 2024 ENCGO Student Association. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
