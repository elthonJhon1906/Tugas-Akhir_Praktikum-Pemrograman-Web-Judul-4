<?php
session_start();

// Inisialisasi daftar kontak jika belum ada
if (!isset($_SESSION['contacts'])) {
    $_SESSION['contacts'] = [];
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Validasi sederhana
    if (empty($username) || empty($password)) {
        $error = "Username dan password harus diisi!";
    } else {
        // Login sederhana (dalam aplikasi nyata, gunakan database)
        if ($username === 'Elthon Jhon Kevin' && $password === 'panggoaran') {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            
        } else {
            $error = "Username atau password salah!";
        }
    }
}

// Redirect jika sudah login
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Tampilkan daftar kontak
    $contacts = $_SESSION['contacts'];
} else {
    // Tampilkan form login
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Sistem Manajemen Kontak</title>
        <link href="../output.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="p-8 bg-white rounded-lg shadow-md w-96">
            <h1 class="mb-6 text-2xl font-bold text-center text-blue-600">Sistem Manajemen Kontak</h1>
            <h2 class="mb-6 text-xl font-semibold text-center">Login</h2>
            
            <?php if (isset($error)): ?>
                <div class="px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="mb-4">
                    <label for="username" class="block mb-2 text-sm font-bold text-gray-700">Username</label>
                    <input type="text" id="username" name="username" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                           required>
                </div>
                
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-bold text-gray-700">Password</label>
                    <input type="password" id="password" name="password" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>
                
                <button type="submit" name="login" 
                        class="w-full px-4 py-2 font-bold text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                    Login
                </button>
            </form>
            
            <div class="mt-4 text-sm text-center text-gray-600">
                <p>Tolong gunakan username: <strong>Elthon Jhon Kevin</strong> dan password: <strong>panggoaran</strong> soalnya blom integrasi database</p>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kontak - Sistem Manajemen Kontak</title>
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
                    <p class="mt-2 text-gray-600">Kelola kontak Anda dengan mudah</p>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">Halo, <?= htmlspecialchars(preg_replace('/(\s+)\S+/', '', $_SESSION['username'])) ?></span>
                    <a href="logout.php" class="px-4 py-2 text-white transition duration-200 bg-red-500 rounded-md hover:bg-red-600">
                        Logout
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="p-6 bg-white rounded-lg shadow">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Daftar Kontak</h2>
                <a href="add.php" class="px-4 py-2 text-white transition duration-200 bg-blue-600 rounded-md hover:bg-blue-700">
                    Tambah Kontak
                </a>
            </div>

            <?php if (empty($contacts)): ?>
                <div class="py-12 text-center">
                    <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">Belum ada kontak</h3>
                    <p class="mt-1 text-gray-500">Mulai dengan menambahkan kontak pertama Anda.</p>
                    <div class="mt-6">
                        <a href="add.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Tambah Kontak
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Telepon</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Alamat</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($contacts as $index => $contact): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($contact['name']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500"><?php echo htmlspecialchars($contact['email']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500"><?php echo htmlspecialchars($contact['phone']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500"><?php echo htmlspecialchars($contact['address']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                        <a href="edit.php?id=<?php echo $index; ?>" class="mr-3 text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <a href="delete.php?id=<?php echo $index; ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus kontak ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
