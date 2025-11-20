<?php
// Simple deployment script - DELETE AFTER USE!
// Run once to set up database on your hosting

 $host = 'localhost';
 $dbname = 'your_database_name';
 $username = 'your_username';
 $password = 'your_password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create tables
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS contact_messages (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            message TEXT NOT NULL,
            date_sent TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS admin_users (
            id INT PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        )
    ");
    
    // Insert admin user
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM admin_users WHERE username = 'admin'");
    $stmt->execute();
    $count = $stmt->fetchColumn();
    
    if ($count == 0) {
        $hashed_password = password_hash('123456', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?)");
        $stmt->execute(['admin', $hashed_password]);
        echo "Admin user created<br>";
    }
    
    echo "Database setup complete!";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>