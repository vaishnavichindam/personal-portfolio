<?php
session_start();
$current_page = basename($_SERVER['PHP_SELF']); // gets current page name
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us - Personal Portfolio</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
body { font-family: 'Poppins', sans-serif; background: #f5f6fa; color: #333; }
.header { background: #1e2a38; color: #fff; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
.header a { color: #fff; text-decoration: none; margin-left: 20px; font-weight: 500; }
.header a:hover { color: #00b4d8; }
.contact-section { max-width: 900px; margin: 50px auto; background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
.contact-section h2 { margin-bottom: 25px; color: #1e2a38; }
.contact-section p { color: #555; }
.contact-section .form-control { margin-bottom: 15px; border-radius: 6px; }
.contact-section button { background: #1e2a38; color: #fff; border: none; border-radius: 6px; padding: 10px 20px; }
.contact-section button:hover { background: #334155; }
.contact-info { margin-top: 30px; }
.contact-info p { margin-bottom: 10px; font-weight: 500; }
.contact-info i { color: #1e2a38; margin-right: 10px; }
</style>
</head>
<body>

<header class="header">
    <div class="logo">Personal Portfolio</div>
    <div class="nav">
        <a href="index.php">Home</a>
        <a href="about.php">About Us</a>
        <?php if($current_page !== 'contact.php'): ?>
            <a href="contact.php">Contact Us</a>
        <?php endif; ?>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="profile.php">My Profile</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="#" onclick="openModal('loginModal')">Login</a>
        <?php endif; ?>
    </div>
</header>

<section class="contact-section">
    <h2>Contact Us</h2>
    <p>We'd love to hear from you! Please fill out the form below and we will get in touch with you shortly.</p>

    <form id="contactForm">
        <input type="text" class="form-control" name="name" placeholder="Your Name" required>
        <input type="email" class="form-control" name="email" placeholder="Your Email" required>
        <input type="text" class="form-control" name="subject" placeholder="Subject" required>
        <textarea class="form-control" name="message" rows="5" placeholder="Your Message" required></textarea>
        <button type="submit">Send Message</button>
    </form>

    <div class="contact-info">
        <p><i class="fas fa-envelope"></i> support@portfolio.com</p>
        <p><i class="fas fa-phone"></i> +91 98765 43210</p>
        <p><i class="fas fa-map-marker-alt"></i> 123 Main Street, City, Country</p>
    </div>
</section>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e){
    e.preventDefault();
    alert("Thank you! Your message has been sent.");
    this.reset();
});
</script>

</body>
</html>
