<?php
// Database Configuration
 $host = 'localhost';
 $dbname = 'portfolio_db';
 $username = 'root'; // Change to your database username
 $password = ''; // Change to your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Detailed error for development
    $error_message = $e->getMessage();
    
    // Check for specific errors
    if (strpos($error_message, 'Unknown database') !== false) {
        die("
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 100px auto; padding: 20px; background: #f8f9fa; border-radius: 10px;'>
                <h2 style='color: #dc3545;'>Database Not Found</h2>
                <p>The database 'portfolio_db' doesn't exist.</p>
                <h3>Quick Fix:</h3>
                <ol>
                    <li>Run the setup script: <a href='setup.php' style='color: #007bff;'>Click here to create database</a></li>
                    <li>Or create it manually in phpMyAdmin</li>
                </ol>
                <p><strong>Error Details:</strong> $error_message</p>
            </div>
        ");
    } elseif (strpos($error_message, 'Access denied') !== false) {
        die("
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 100px auto; padding: 20px; background: #f8f9fa; border-radius: 10px;'>
                <h2 style='color: #dc3545;'>Database Access Denied</h2>
                <p>Check your database username and password in config.php</p>
                <p><strong>Common solutions:</strong></p>
                <ul>
                    <li>For XAMPP/MAMP: username='root', password=''</li>
                    <li>For cPanel: username='cpanel_username', password='your_db_password'</li>
                </ul>
                <p><strong>Error Details:</strong> $error_message</p>
            </div>
        ");
    } else {
        die("Database connection failed: " . $error_message);
    }
}
?>