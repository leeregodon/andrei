<?php
// Database Setup Script
// Run this once to create your database and tables

 $host = 'localhost';
 $username = 'root'; // Change to your database username
 $password = ''; // Change to your database password
 $dbname = 'portfolio_db';

echo "<h2>Database Setup for Portfolio</h2>";

try {
    // Connect to MySQL without specifying database
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color: green;'>✓ Connected to MySQL server</p>";
    
    // Create database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    echo "<p style='color: green;'>✓ Database '$dbname' created or already exists</p>";
    
    // Select the database
    $pdo->exec("USE $dbname");
    
    // Create contact_messages table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS contact_messages (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            message TEXT NOT NULL,
            date_sent TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    echo "<p style='color: green;'>✓ Table 'contact_messages' created</p>";
    
    // Create admin_users table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS admin_users (
            id INT PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        )
    ");
    echo "<p style='color: green;'>✓ Table 'admin_users' created</p>";
    
    // Insert admin user if not exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM admin_users WHERE username = 'admin'");
    $stmt->execute();
    $count = $stmt->fetchColumn();
    
    if ($count == 0) {
        $hashed_password = password_hash('123456', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?)");
        $stmt->execute(['admin', $hashed_password]);
        echo "<p style='color: green;'>✓ Admin user created (username: admin, password: 123456)</p>";
    } else {
        echo "<p style='color: blue;'>ℹ Admin user already exists</p>";
    }
    
    echo "<h3 style='color: green;'>Setup Complete!</h3>";
    echo "<p><strong>Next Steps:</strong></p>";
    echo "<ol>";
    echo "<li>Delete this setup.php file for security</li>";
    echo "<li>Update config.php with your database credentials</li>";
    echo "<li>Test your portfolio website</li>";
    echo "</ol>";
    
    echo "<p><a href='index.php' style='background: #2563eb; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Portfolio</a></p>";
    
} catch(PDOException $e) {
    echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
    
    echo "<h3>Troubleshooting Tips:</h3>";
    echo "<ul>";
    echo "<li>Check your MySQL server is running</li>";
    echo "<li>Verify your database username and password</li>";
    echo "<li>Make sure your MySQL user has CREATE DATABASE privileges</li>";
    echo "<li>For cPanel: Use 'cpanelusername_databasename' format</li>";
    echo "<li>For XAMPP/MAMP: Username is usually 'root', password is empty</li>";
    echo "</ul>";
}
?>