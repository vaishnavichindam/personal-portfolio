<?php
session_start();

// --- Database configuration ---
$host = 'localhost';
$db   = 'portfolio_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $gender = $_POST['gender'];

    $stmt = $pdo->prepare("UPDATE users SET fullname = :fullname, email = :email, contact = :contact, gender = :gender WHERE id = :id");
    $stmt->execute([
        ':fullname' => $fullname,
        ':email' => $email,
        ':contact' => $contact,
        ':gender' => $gender,
        ':id' => $userId
    ]);

    header("Location: profile.php");
    exit;
}

$stmt = $pdo->prepare("SELECT fullname, email, contact, gender FROM users WHERE id = :id");
$stmt->execute([':id' => $userId]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Profile</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
body {
    background: #f0f2f5;
    font-family: 'Poppins', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

/* Profile Card */
.profile-card {
    background: #fff;
    width: 420px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
}

.profile-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.25);
}

/* Header */
.profile-header {
    background: #001f4d; /* Navy Blue */
    padding: 25px 20px 60px 20px;
    text-align: center;
    color: #fff;
    position: relative;
}

.profile-header img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 4px solid #fff;
    object-fit: cover;
    position: absolute;
    bottom: -50px;
    left: 50%;
    transform: translateX(-50%);
    background: #fff;
}

/* Body */
.profile-body {
    padding: 60px 25px 25px 25px;
}

.profile-body h2 {
    text-align: center;
    margin-bottom: 15px;
    font-weight: 700;
    color: #001f4d;
}

.profile-body p {
    font-size: 15px;
    margin: 10px 0;
    display: flex;
    align-items: center;
    gap: 12px;
    color: #333;
}

/* Form */
.profile-body input, .profile-body select {
    width: 100%;
    padding: 8px 10px;
    margin-bottom: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

/* Buttons */
.btn-logout, .btn-edit, .btn-save, .btn-help {
    display: block;
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    margin-top: 10px;
    transition: 0.3s;
}

.btn-logout { background: #dc3545; color: #fff; }
.btn-logout:hover { background: #c82333; }

.btn-edit { background: #0077b6; color: #fff; }
.btn-edit:hover { background: #005f8f; }

.btn-save { background: #28a745; color: #fff; }
.btn-save:hover { background: #1e7e34; }

.btn-help { background: #ffc107; color: #001f4d; }
.btn-help:hover { background: #e0a800; }

/* Divider */
.divider { height: 1px; background: #ddd; margin: 20px 0; }
</style>
</head>
<body>

<div class="profile-card">
    <div class="profile-header">
        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['fullname']); ?>&background=random&size=128" alt="Profile Avatar">
    </div>
    <div class="profile-body">
        <form method="POST" id="profileForm">
            <h2><?php echo htmlspecialchars($user['fullname']); ?></h2>

            <div id="profileView">
                <p><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><i class="fas fa-phone"></i> <?php echo htmlspecialchars($user['contact']); ?></p>
                <p><i class="fas fa-venus-mars"></i> <?php echo htmlspecialchars($user['gender']); ?></p>
                <button type="button" class="btn-edit" onclick="toggleEdit(true)">Edit Profile</button>
            </div>

            <div id="profileEdit" style="display:none;">
                <input type="text" name="fullname" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                <input type="text" name="contact" value="<?php echo htmlspecialchars($user['contact']); ?>" required>
                <select name="gender" required>
                    <option value="Male" <?php if($user['gender']=='Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if($user['gender']=='Female') echo 'selected'; ?>>Female</option>
                    <option value="Other" <?php if($user['gender']=='Other') echo 'selected'; ?>>Other</option>
                </select>
                <button type="submit" name="update_profile" class="btn-save">Save Changes</button>
                <button type="button" class="btn-edit" onclick="toggleEdit(false)">Cancel</button>
            </div>
        </form>

        <div class="divider"></div>

        <h5>Help & Support</h5>
        <p><i class="fas fa-headset"></i> support@example.com</p>
        <p><i class="fas fa-phone-alt"></i> +91 9876543210</p>
        <button class="btn-help" onclick="alert('Redirecting to help page')">Get Help</button>

        <div class="divider"></div>
        <button class="btn-logout" onclick="window.location.href='logout.php'">Logout</button>
    </div>
</div>

<script>
function toggleEdit(editing) {
    document.getElementById('profileView').style.display = editing ? 'none' : 'block';
    document.getElementById('profileEdit').style.display = editing ? 'block' : 'none';
}
</script>

</body>
</html>
