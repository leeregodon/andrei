<?php
session_start();
include 'config.php';

 $message = '';
 $step = 1;
 $userName = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['step']) && $_POST['step'] == '1') {
        // Step 1: Get user name
        $userName = trim($_POST['name']);
        if (!empty($userName)) {
            $_SESSION['user_name'] = $userName;
            $step = 2;
        } else {
            $message = '<div class="message error">Please enter your name.</div>';
        }
    } elseif (isset($_POST['step']) && $_POST['step'] == '2') {
        // Step 2: Submit contact form
        $name = $_SESSION['user_name'] ?? '';
        $email = trim($_POST['email']);
        $message_text = trim($_POST['message']);
        
        if (!empty($email) && !empty($message_text) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
                $stmt->execute([$name, $email, $message_text]);
                $message = '<div class="message success">Thank you! Your message has been sent successfully.</div>';
                unset($_SESSION['user_name']);
                $step = 1;
            } catch(PDOException $e) {
                $message = '<div class="message error">Error: Could not save your message. Please try again.</div>';
            }
        } else {
            $message = '<div class="message error">Please fill in all fields with valid information.</div>';
        }
    }
}

if (isset($_SESSION['user_name']) && !isset($_POST['step'])) {
    $userName = $_SESSION['user_name'];
    $step = 2;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Lee Andrei Regodon Portfolio</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="container">
            <div class="nav-container">
                <a href="index.php" class="logo">JD</a>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index.php#projects">Projects</a></li>
                    <li><a href="index.php#skills">Skills</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="admin.php">Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contact Section -->
    <section style="padding: 4rem 0; min-height: calc(100vh - 200px);">
        <div class="container">
            <h2 class="section-title">Get In Touch</h2>
            
            <?php echo $message; ?>
            
            <?php if ($step == 1): ?>
                <!-- Step 1: Ask for name -->
                <div class="form-container">
                    <h3 style="margin-bottom: 1.5rem; text-align: center;">Welcome! Let's start with your name</h3>
                    <form method="POST" action="">
                        <input type="hidden" name="step" value="1">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" required autofocus>
                        </div>
                        <button type="submit" class="btn btn-full">Continue</button>
                    </form>
                </div>
            <?php else: ?>
                <!-- Step 2: Show welcome and contact form -->
                <div class="welcome-message">
                    Welcome <?php echo htmlspecialchars($userName); ?> to my Portfolio!
                </div>
                
                <div class="form-container">
                    <h3 style="margin-bottom: 1.5rem; text-align: center;">Send me a message</h3>
                    <form method="POST" action="">
                        <input type="hidden" name="step" value="2">
                        <div class="form-group">
                            <label for="email">Your Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-full">Send Message</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Lee Andrei Regodon. All rights reserved. | Built with PHP, MySQL & CSS</p>
        </div>
    </footer>
</body>
</html>