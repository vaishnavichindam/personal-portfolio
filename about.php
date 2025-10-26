<?php
session_start();
$current_page = basename($_SERVER['PHP_SELF']); // gets current page name
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About Us - Personal Portfolio</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
body { font-family: 'Poppins', sans-serif; background: #f5f6fa; color: #333; }
.header { background: #1e2a38; color: #fff; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
.header a { color: #fff; text-decoration: none; margin-left: 20px; font-weight: 500; }
.header a:hover { color: #00b4d8; }
.about-section { max-width: 1000px; margin: 50px auto; background: #fff; padding: 50px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
.about-section h2 { margin-bottom: 25px; color: #1e2a38; }
.about-section p { color: #555; line-height: 1.8; margin-bottom: 20px; }
.team { display: flex; flex-wrap: wrap; gap: 30px; margin-top: 40px; justify-content: center; }
.team-member { flex: 1 1 250px; text-align: center; background: #f9fafc; padding: 20px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
.team-member h5 { margin-bottom: 5px; color: #1e2a38; }
.team-member p { font-size: 14px; color: #555; }
</style>
</head>
<body>

<header class="header">
    <div class="logo">Personal Portfolio</div>
    <div class="nav">
        <a href="index.php">Home</a>
        <?php if($current_page !== 'about.php'): ?>
            <a href="about.php">About Us</a>
        <?php endif; ?>
        <a href="contact.php">Contact Us</a>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="profile.php">My Profile</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="#" onclick="openModal('loginModal')">Login</a>
        <?php endif; ?>
    </div>
</header>

<section class="about-section">
    <h2>About Personal Portfolio</h2>
    <p>Our Personal Portfolio platform helps professionals, creatives, and developers showcase their work with style. We provide a variety of customizable templates to help you build an online presence quickly and professionally.</p>
    <p>Our mission is to simplify portfolio creation, giving you the tools to impress potential clients, employers, and collaborators.</p>

    <h3>Meet Our Team</h3>
    <div class="team">
        <div class="team-member">
            <h5>Vaishnavi Chindam</h5>
            <p>Developer</p>
        </div>
        <div class="team-member">
            <h5>Shainee</h5>
            <p>Designer</p>
        </div>
        <div class="team-member">
            <h5>Venkat Sai and Bhaskar</h5>
            <p>Team Members</p>
        </div>
    </div>
</section>

</body>
</html>
