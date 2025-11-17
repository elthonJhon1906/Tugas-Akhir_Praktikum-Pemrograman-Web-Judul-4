# 📊 Sistem Manajemen Kontak Sederhana

<div align="center">

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![Arch Linux](https://img.shields.io/badge/Arch_Linux-1793D1?style=for-the-badge&logo=arch-linux&logoColor=white)

**Sistem manajemen kontak berbasis web dengan PHP Native dan Tailwind CSS**

[Fitur](#-fitur) • [Instalasi](#-instalasi) • [Penggunaan](#-penggunaan) • [Struktur](#-struktur-file)

</div>

## 🚀 Demo Cepat

````bash
# Jalankan dengan PHP built-in server
php -S localhost:8000
Login Default:

🔐 Username: Elthon Jhon Kevin

🔑 Password: panggoaran

✨ Fitur
Fitur	Status	Keterangan
✅	Authentication System	Login/Logout dengan session management
✅	CRUD Operations	Create, Read, Update, Delete kontak
✅	Form Validation	Validasi client & server side
✅	Responsive Design	Optimized untuk desktop & mobile
✅	Security	Input sanitization & XSS protection
🛠️ Instalasi
Metode 1: PHP Built-in Server (Recommended untuk Development)
bash
# Clone repository
git clone https://github.com/elthonJhon1906/Tugas-Akhir_Praktikum-Pemrograman-Web-Judul-4.git
cd Tugas-Akhir_Praktikum-Pemrograman-Web-Judul-4

# Jalankan server
php -S localhost:8000
Metode 2: Apache Web Server
bash
# Copy ke web directory
sudo cp -r . /srv/http/contact-manager

# Atau buat symlink
sudo ln -s $(pwd) /srv/http/contact-manager

# Start Apache & PHP-FPM
sudo systemctl start httpd php-fpm
Metode 3: Docker
bash
# Build image
docker build -t contact-manager .

# Run container
docker run -p 8080:80 contact-manager
📁 Struktur File
text
contact-manager/
├── 📄 index.php          # Login & Daftar Kontak
├── 📄 add.php            # Form Tambah Kontak
├── 📄 edit.php           # Form Edit Kontak
├── 📄 delete.php         # Hapus Kontak
├── 📄 logout.php         # Logout System
├── 🎨 style.css          # Custom Styles
└── 📖 README.md          # Dokumentasi ini
🎯 Penggunaan
1. Login System
Akses http://localhost:8000

Gunakan credentials default

Session management otomatis

2. Manajemen Kontak
Tambah: Klik "Tambah Kontak" → Isi form → Simpan

Edit: Klik "Edit" pada kontak → Modifikasi → Update

Hapus: Klik "Hapus" → Konfirmasi → Terhapus

3. Validasi Form
Nama, Email, Telepon wajib diisi

Format email harus valid

Feedback error yang informatif

🔧 Konfigurasi
Untuk Environment Lain:
<details> <summary><b>🖥️ XAMPP (Windows)</b></summary>
Copy folder ke C:\xampp\htdocs\contact-manager

Akses http://localhost/contact-manager

</details><details> <summary><b>🐧 Linux (Apache)</b></summary>
bash
# Buat virtual host
sudo nano /etc/httpd/conf/extra/httpd-vhosts.conf

# Tambahkan:
<VirtualHost *:80>
    ServerName contact-manager.local
    DocumentRoot "/path/to/contact-manager"
</VirtualHost>
</details><details> <summary><b>🍎 macOS</b></summary>
bash
# Gunakan built-in PHP
php -S localhost:8000

# Atau dengan MAMP
cp -r . /Applications/MAMP/htdocs/contact-manager
</details>
🐛 Troubleshooting
Masalah	Solusi
Session tidak bekerja	Cek session_start() di setiap file
Form validation error	Pastikan semua field required terisi
Style tidak load	Pastikan Tailwind CDN terakses
Git error di /mnt/	Gunakan git clone di home directory Linux
📝 Catatan Pengembangan
✅ Completed: All basic CRUD operations

✅ Completed: Session management & authentication

✅ Completed: Responsive UI with Tailwind CSS

🔄 Future: Database integration (MySQL)

🔄 Future: Photo upload feature

🔄 Future: Export contacts (CSV/PDF)

👥 Kontribusi
Fork repository

Buat feature branch (git checkout -b feature/AmazingFeature)

Commit changes (git commit -m 'Add some AmazingFeature')

Push to branch (git push origin feature/AmazingFeature)

Open Pull Request

📄 License
Distributed under the MIT License. See LICENSE for more information.

🤝 Credits
Dibuat oleh: elthonJhon1906
Mata Kuliah: Praktikum Pemrograman Web
Judul: Sistem Manajemen Kontak Sederhana

<div align="center">
⭐ Jangan lupa beri star jika project ini membantu!

⬆ Kembali ke atas

</div> ```
🎨 Bonus: Tambahkan file .gitignore
Buat juga file .gitignore:

gitignore
# System files
.DS_Store
Thumbs.db

# Logs
*.log
error_log

# Environment files
.env
config.php

# Temporary files
tmp/
sessions/

# IDE
.vscode/
.idea/
*.swp
*.swo

# OS generated files
._*
````
