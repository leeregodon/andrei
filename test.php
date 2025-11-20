<?php
include 'config.php';
echo "<h2 style='color: green;'>Database Connection Successful!</h2>";
echo "<p>Connected to database: $dbname</p>";

// Test a query
 $stmt = $pdo->query("SELECT COUNT(*) FROM contact_messages");
 $count = $stmt->fetchColumn();
echo "<p>Messages in database: $count</p>";
?>