<?php
session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lee Andrei Regodon - Portfolio</title>
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Hi, I'm Lee Andrei Regodon</h1>
                    <p>Full Stack Developer & UI/UX Designer</p>
                    <p>I create beautiful, functional websites and applications that help businesses grow and succeed in the digital world.</p>
                    <a href="contact.php" class="btn">Get In Touch</a>
                </div>
                <div class="hero-image">
                    <img src="https://scontent.fmnl17-2.fna.fbcdn.net/v/t39.30808-6/475887591_1161059292347188_5525287589594889373_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeEFmp2DZsIvf4MBzOD1SFuc-CVbYQTBlFX4JVthBMGUVa9ZkeNaoaklpCgDaY1T7-F9VEOUpGFj25gemd4nujSY&_nc_ohc=_rIBRn6ePvYQ7kNvwEkAMci&_nc_oc=Adnoze3gEeCwpekLmOjaJBrQo1RsastNun4ZjOQdBp70oRWcHupYE3sseQji3SVpb_w&_nc_zt=23&_nc_ht=scontent.fmnl17-2.fna&_nc_gid=a_CQ5cUjoSfnbuUu6Xsxrw&oh=00_Afgiu50-I00HYQ_UcYhrXLLhB0EUcFNp9aB6qE2arq8yeA&oe=69245BBC" alt="Lee Andrei" class="profile-img">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <h2 class="section-title">About Me</h2>
            <div style="max-width: 800px; margin: 0 auto; text-align: center;">
                <p style="font-size: 1.1rem; line-height: 1.8; color: var(--text-light);">
                    With over 5 years of experience in web development, I specialize in creating modern, responsive websites 
                    using the latest technologies. My passion lies in solving complex problems and delivering exceptional 
                    user experiences that drive business results.
                </p>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" style="background: white;">
        <div class="container">
            <h2 class="section-title">Featured Projects</h2>
            <div class="projects-grid">
                <div class="project-card">
                    <img src="data:image/jpeg;base64,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" alt="E-Commerce Platform" class="project-img">
                    <div class="project-content">
                        <h3>E-Commerce Platform</h3>
                        <p>A full-featured online shopping platform with payment integration and inventory management.</p>
                    </div>
                </div>
                <div class="project-card">
                    <img src="https://i.pinimg.com/736x/f5/9f/64/f59f64e6886553c9f516237d64abee8b.jpg" alt="Task Management App" class="project-img">
                    <div class="project-content">
                        <h3>Task Management App</h3>
                        <p>Collaborative project management tool with real-time updates and team features.</p>
                    </div>
                </div>
                <div class="project-card">
                    <img src="https://i.pinimg.com/1200x/ac/3a/b2/ac3ab29efc8dd2c0f688c9c355aaa7f6.jpg" alt="Social Media Dashboard" class="project-img">
                    <div class="project-content">
                        <h3>Social Media Dashboard</h3>
                        <p>Analytics dashboard for tracking social media performance across multiple platforms.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills">
        <div class="container">
            <h2 class="section-title">Skills & Technologies</h2>
            <div class="skills-container">
                <div class="skill-item">
                    <h4>PHP</h4>
                </div>
                <div class="skill-item">
                    <h4>MySQL</h4>
                </div>
                <div class="skill-item">
                    <h4>JavaScript</h4>
                </div>
                <div class="skill-item">
                    <h4>React</h4>
                </div>
                <div class="skill-item">
                    <h4>HTML/CSS</h4>
                </div>
                <div class="skill-item">
                    <h4>Node.js</h4>
                </div>
                <div class="skill-item">
                    <h4>Python</h4>
                </div>
                <div class="skill-item">
                    <h4>Git</h4>
                </div>
            </div>
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