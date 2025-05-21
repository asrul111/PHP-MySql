<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    // Ambil data dari form
    $fullName = $_POST['fullName'] ?? '';
    $email    = $_POST['email'] ?? '';
    $phone    = $_POST['phone'] ?? '';
    $message  = $_POST['message'] ?? '';

    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "db_contact");

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO contacts (fullName, email, phone, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullName, $email, $phone, $message);

    if ($stmt->execute()) {
      
    } else {
        echo '<div style="margin:40px auto;max-width:400px;padding:30px 20px;background:#ffe0e0;color:#a00;border-radius:8px;text-align:center;font-size:1.2em;">Gagal menyimpan pesan: ' . htmlspecialchars($conn->error) . '</div>';
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Metode tidak diizinkan.";
}
?>

