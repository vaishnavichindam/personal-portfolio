<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $fullname = $_POST['fullname'] ?? '';
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $contact  = $_POST['contact'] ?? '';
    $gender   = $_POST['gender'] ?? '';

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        echo json_encode(['status'=>'error','message'=>'Email already exists']);
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password, contact, gender) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$fullname,$email,$hashed_password,$contact,$gender])) {
        echo json_encode(['status'=>'success','message'=>'Signup successful']);
    } else {
        echo json_encode(['status'=>'error','message'=>'Signup failed']);
    }
}
?>
