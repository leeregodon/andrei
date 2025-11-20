<?php
session_start();
include 'config.php';

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
        } else {
            $error = 'Invalid username or password';
        }
    } catch(PDOException $e) {
        $error = 'Login failed. Please try again.';
    }
}

// Check if admin is logged in
 $logged_in = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// Fetch messages if logged in
if ($logged_in) {
    try {
        $stmt = $pdo->query("SELECT * FROM contact_messages ORDER BY date_sent DESC");
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $message_count = count($messages);
    } catch(PDOException $e) {
        $messages = [];
        $message_count = 0;
        $error = "Error fetching messages: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Portfolio</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="admin-dashboard">
    <?php if (!$logged_in): ?>
    <!-- Login Form -->
    <div class="admin-login">
        <div class="container">
            <div style="max-width: 400px; margin: 0 auto;">
                <a href="index.php" class="logo">Portfolio Admin</a>
                <div class="form-container">
                    <h2>Admin Login</h2>
                    
                    <?php if (isset($error)): ?>
                        <div class="message error"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <form method="POST" action="">
                        <input type="hidden" name="login" value="1">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-full">Login</button>
                    </form>
                    
                    <p>
                        <a href="index.php">← Back to Portfolio</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <!-- Dashboard -->
    <header class="admin-header">
        <div class="container">
            <h1>Admin Dashboard</h1>
            <div class="user-info">
                <span>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                <a href="index.php" class="btn">View Site</a>
                <a href="?logout" class="btn">Logout</a>
            </div>
        </div>
    </header>

    <main class="admin-content">
        <div class="container">
            <div class="admin-stats">
                <div class="stat-card">
                    <div class="stat-value"><?php echo $message_count; ?></div>
                    <div class="stat-label">Total Messages</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value"><?php echo date('M j'); ?></div>
                    <div class="stat-label">Today's Date</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value"><?php echo htmlspecialchars($_SESSION['admin_username']); ?></div>
                    <div class="stat-label">Logged in as</div>
                </div>
            </div>

            <div class="admin-card">
                <div class="admin-card-header">
                    <h2 class="admin-card-title">Contact Messages</h2>
                    <span><?php echo $message_count; ?> messages</span>
                </div>
                <div class="admin-card-body">
                    <?php if (isset($error)): ?>
                        <div class="message error"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <?php if (empty($messages)): ?>
                        <div class="empty-state">
                            <div class="empty-state-icon">📭</div>
                            <h3>No messages yet</h3>
                            <p>When visitors contact you, their messages will appear here.</p>
                        </div>
                    <?php else: ?>
                        <div style="overflow-x: auto;">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Date Sent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($messages as $message): ?>
                                        <tr>
                                            <td><?php echo $message['id']; ?></td>
                                            <td><?php echo htmlspecialchars($message['name']); ?></td>
                                            <td><?php echo htmlspecialchars($message['email']); ?></td>
                                            <td class="message-preview" title="<?php echo htmlspecialchars($message['message']); ?>">
                                                <?php echo htmlspecialchars(substr($message['message'], 0, 50)) . '...'; ?>
                                            </td>
                                            <td><?php echo date('M j, Y H:i', strtotime($message['date_sent'])); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
    <?php endif; ?>
</body>
</html>