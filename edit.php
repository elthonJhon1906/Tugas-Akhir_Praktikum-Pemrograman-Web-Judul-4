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
if (!isset($contacts[$contactId])) {
    header('Location: index.php');
    exit();
}

$errors = [];
$success = '';

// Proses form edit kontak
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    
    // Validasi
    if (empty($name)) {
        $errors['name'] = 'Nama harus diisi';
    }
    
    if (empty($email)) {
        $errors['email'] = 'Email harus diisi';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Format email tidak valid';
    }
    
    if (empty($phone)) {
        $errors['phone'] = 'Telepon harus diisi';
    }
    
    // Jika tidak ada error, update kontak
    if (empty($errors)) {
        $_SESSION['contacts'][$contactId] = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address
        ];
        
        $success = 'Kontak berhasil diperbarui!';
    }
} else {
    // Ambil data kontak untuk ditampilkan di form
    $contact = $contacts[$contactId];
    $name = $contact['name'];
    $email = $contact['email'];
    $phone = $contact['phone'];
    $address = $contact['address'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kontak - Sistem Manajemen Kontak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="min-h-screen bg-gray-100">
    <div class="container px-4 py-8 mx-auto">
        <!-- Header -->
        <header class="p-6 mb-8 bg-white rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-blue-600">Sistem Manajemen Kontak</h1>
                    <p class="mt-2 text-gray-600">Edit Kontak</p>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">Halo, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <a href="index.php" class="px-4 py-2 text-white transition duration-200 bg-gray-500 rounded-md hover:bg-gray-600">
                        Kembali
                    </a>
                    <a href="logout.php" class="px-4 py-2 text-white transition duration-200 bg-red-500 rounded-md hover:bg-red-600">
                        Logout
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
            <h2 class="mb-6 text-2xl font-semibold text-gray-800">Edit Kontak</h2>
            
            <?php if ($success): ?>
                <div class="px-4 py-3 mb-6 text-green-700 bg-green-100 border border-green-400 rounded">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="grid grid-cols-1 gap-6">
                    <!-- Nama -->
                    <div>
                        <label for="name" class="block mb-1 text-sm font-medium text-gray-700">Nama *</label>
                        <input type="text" id="name" name="name" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php echo isset($errors['name']) ? 'border-red-500' : ''; ?>"
                               value="<?php echo htmlspecialchars($name); ?>"
                               required>
                        <?php if (isset($errors['name'])): ?>
                            <p class="mt-1 text-xs text-red-500"><?php echo $errors['name']; ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Email -->
                    <div>
                        <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email *</label>
                        <input type="email" id="email" name="email" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php echo isset($errors['email']) ? 'border-red-500' : ''; ?>"
                               value="<?php echo htmlspecialchars($email); ?>"
                               required>
                        <?php if (isset($errors['email'])): ?>
                            <p class="mt-1 text-xs text-red-500"><?php echo $errors['email']; ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Telepon -->
                    <div>
                        <label for="phone" class="block mb-1 text-sm font-medium text-gray-700">Telepon *</label>
                        <input type="tel" id="phone" name="phone" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php echo isset($errors['phone']) ? 'border-red-500' : ''; ?>"
                               value="<?php echo htmlspecialchars($phone); ?>"
                               required>
                        <?php if (isset($errors['phone'])): ?>
                            <p class="mt-1 text-xs text-red-500"><?php echo $errors['phone']; ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Alamat -->
                    <div>
                        <label for="address" class="block mb-1 text-sm font-medium text-gray-700">Alamat</label>
                        <textarea id="address" name="address" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo htmlspecialchars($address); ?></textarea>
                    </div>
                    
                    <!-- Tombol -->
                    <div class="flex justify-end pt-4 space-x-3">
                        <a href="index.php" class="px-6 py-2 text-white transition duration-200 bg-gray-500 rounded-md hover:bg-gray-600">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 text-white transition duration-200 bg-blue-600 rounded-md hover:bg-blue-700">
                            Update Kontak
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>