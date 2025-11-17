<?php
session_start();

// Redirect ke login jika belum login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit();
}

// Cek apakah ID kontak diberikan
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$contactId = (int)$_GET['id'];
$contacts = $_SESSION['contacts'];

// Cek apakah kontak dengan ID tersebut ada
if (isset($contacts[$contactId])) {
    // Hapus kontak
    unset($_SESSION['contacts'][$contactId]);
    // Reindex array untuk menghindari celah dalam indeks
    $_SESSION['contacts'] = array_values($_SESSION['contacts']);
    
    $_SESSION['success_message'] = 'Kontak berhasil dihapus!';
}

// Redirect kembali ke halaman utama
header('Location: index.php');
exit();
?>