<?php
$message = ""; // Variabel untuk menyimpan pesan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $review = htmlspecialchars(trim($_POST['review']));

    // Memastikan semua field tidak kosong
    if (!empty($name) && !empty($email) && !empty($review)) {
        // Di sini Anda bisa menambahkan logika untuk menyimpan ulasan ke database jika diinginkan
        
        // Pesan sukses
        $message = "Ulasan Anda sudah terkirim! Terimakasih atas masukan Anda.";
    } else {
        $message = "Semua field harus diisi!";
    }
}
?>
