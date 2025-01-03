<?php
include('koneksi.php');

$footer = getFooter();
$header = getHeader();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Tugas Ekternal/Internal</title>
    <link href="styles.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <script>
        function tampilHome() {
    document.getElementById('content').innerHTML = `
        <h2>CRUD Surat Tugas</h2>
        <form id="createForm" onsubmit="createSurat(event)" style="margin-bottom: 20px; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">
    <div style="margin-bottom: 15px;">
        <label for="judul" style="font-weight: bold;">Judul Surat:</label><br>
        <input type="text" id="judul" name="judul" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label for="keterangan" style="font-weight: bold;">Keterangan:</label><br>
        <textarea id="keterangan" name="keterangan" rows="3" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
    </div>
    <div style="margin-bottom: 15px;">
        <label for="tanggal" style="font-weight: bold;">Tanggal:</label><br>
        <input type="date" id="tanggal" name="tanggal" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label for="jenisSurat" style="font-weight: bold;">Jenis Surat:</label><br>
        <select id="jenisSurat" name="jenisSurat" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            <option value="">Pilih Jenis Surat</option>
            <option value="Internal">Internal</option>
            <option value="Eksternal">Eksternal</option>
        </select>
    </div>
    <div style="text-align: right;">
        <button class="btnTambah" type="submit" style="padding: 10px 15px; background-color: #43a047; color: white; border: none; border-radius: 4px; cursor: pointer;">Tambah Surat</button>
        <button type="reset" style="padding: 10px 15px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer;">Reset</button>
    </div>
</form>

        
        <h3>Daftar Surat Tugas</h3>
        <table id="suratTable" style="width: 100%; border-collapse: collapse; margin-top: 20px; background-color: white; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
            <thead style="background-color: #f1f1f1;">
                <tr>
                    <th style="padding: 10px; text-align: left; border-bottom: 1px solid #ccc;">Judul Surat</th>
                    <th style="padding: 10px; text-align: left; border-bottom: 1px solid #ccc;">Keterangan</th>
                    <th style="padding: 10px; text-align: left; border-bottom: 1px solid #ccc;">Tanggal</th>
                    <th style="padding: 10px; text-align: left; border-bottom: 1px solid #ccc;">Jenis Surat</th>
                    <th style="padding: 10px; text-align: left; border-bottom: 1px solid #ccc;">Aksi</th>
                </tr>
            </thead>
            <tbody id="suratTugasList">
                <!-- Data Surat Tugas akan dimuat di sini -->
            </tbody>
        </table>
    `;

    loadSurat(); // buat data surat tugas
}

       
function tampilAbout() {
    document.getElementById('content').innerHTML = `
        <h2 style="text-align: center; margin-bottom: 20px; font-family: Arial, sans-serif; color: #333;">Profil Kelompok</h2>
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; justify-content: center; align-items: center; max-width: 800px; margin: 0 auto;">
            <!-- Profil Anggota 1 -->
            <div style="text-align: center; display: flex; flex-direction: column; align-items: center;">
                <img src="fajar.png" alt="Foto Muhammad Fajar Rizkyulloh" 
                     style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);">
                <div style="margin-top: 15px; font-family: Arial, sans-serif; color: #555;">
                    <strong style="display: block; font-size: 18px; color: #222;">Muhammad Fajar Rizkyulloh</strong>
                    <span style="font-size: 14px;">NIM: 2023081055</span>
                </div>
            </div>
            
            <!-- Profil Anggota 2 -->
            <div style="text-align: center; display: flex; flex-direction: column; align-items: center;">
                <img src="satrio.jpg" alt="Foto Satrio Hutama MW" 
                     style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);">
                <div style="margin-top: 15px; font-family: Arial, sans-serif; color: #555;">
                    <strong style="display: block; font-size: 18px; color: #222;">Satrio Hutama MW</strong>
                    <span style="font-size: 14px;">NIM: 202308160</span>
                </div>
            </div>

            <!-- Profil Anggota 3 -->
            <div style="text-align: center; display: flex; flex-direction: column; align-items: center;">
                <img src="verro.png" alt="Foto Muhammad Averroes" 
                     style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);">
                <div style="margin-top: 15px; font-family: Arial, sans-serif; color: #555;">
                    <strong style="display: block; font-size: 18px; color: #222;">Muhammad Averroes</strong>
                    <span style="font-size: 14px;">NIM: 2023081041</span>
                </div>
            </div>

            <!-- Profil Anggota 4 -->
            <div style="text-align: center; display: flex; flex-direction: column; align-items: center;">
                <img src="rehan.jpg" alt="Foto Muhammad Rayhan" 
                     style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);">
                <div style="margin-top: 15px; font-family: Arial, sans-serif; color: #555;">
                    <strong style="display: block; font-size: 18px; color: #222;">Muhammad Rayhan</strong>
                    <span style="font-size: 14px;">NIM: 2023081059</span>
                </div>
            </div>
        </div>
    `;
}

        // ini CRUD nya
        function createSurat(event) {
    event.preventDefault();

    const judul = document.getElementById('judul').value;
    const keterangan = document.getElementById('keterangan').value;
    const tanggal = document.getElementById('tanggal').value;
    const jenisSurat = document.getElementById('jenisSurat').value;

    if (!judul || !tanggal || !jenisSurat) {
        alert("Judul, Tanggal, dan Jenis Surat wajib diisi.");
        return;
    }

    fetch('koneksi.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: 'create',
            judul,
            keterangan,
            tanggal,
            jenisSurat,
        }),
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message || "Data berhasil ditambahkan");
            loadSurat();
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Gagal menambahkan data. Periksa koneksi.");
        });
}


function loadSurat() {
    fetch('koneksi.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: 'read',
        }),
    })
        .then(response => response.json())
        .then(data => {
            console.log(data); 

            if (!Array.isArray(data)) {
                alert("Gagal memuat data: " + (data.message || "Respon tidak valid"));
                return;
            }

            const suratTugasList = document.getElementById('suratTugasList');
            suratTugasList.innerHTML = '';

            data.forEach(surat => {
                const row = `
                    <tr>
                        <td>${surat.Judul}</td>
                        <td>${surat.Keterangan}</td>
                        <td>${surat.Tanggal}</td>
                        <td>${surat.Jenis_surat}</td>
                        <td>
                            <button style="padding: 10px 15px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer;"onclick="deleteSurat(${surat.idSurat})">Hapus</button>
                        </td>
                    </tr>
                `;
                suratTugasList.innerHTML += row;
            });
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Gagal memuat data. Periksa koneksi.");
        });
}


function deleteSurat(idSurat) {
    fetch('koneksi.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: 'delete',
            idSurat: idSurat,
        }),
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            loadSurat();
        })
        .catch(error => console.error('Error:', error));
}

// Fungsi untuk memuat status surat
function loadStatus() {
            fetch('koneksi.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'status', // Panggil aksi status
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (!Array.isArray(data)) {
                    alert("Gagal memuat data: " + (data.message || "Respon tidak valid"));
                    return;
                }

                const statusList = document.getElementById('status-list');
                statusList.innerHTML = ''; // Kosongkan daftar status

                data.forEach(item => {
                    const statusItem = `
                        <li class="status-item">
                            <span class="status-text">${item.Judul}: ${item.status}</span>
                        </li>
                    `;
                    statusList.innerHTML += statusItem;
                });
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Gagal memuat data status. Periksa koneksi.");
            });
        }

        // Memuat data surat dan status saat halaman dimuat
        window.onload = function() {
            loadStatus();
        }
    </script>

</head>
<body class="bg-gray-100">
    <header>
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <?php if ($header): ?>
                    <img src="<?php echo $header['logo_url']; ?>" alt="Logo" class="w-10 h-10 mr-3 rounded">
                    <div class="header-container">
                        <h1 class="site-name"><?php echo $header['site_name']; ?></h1>
                        <p class="slogan"><?php echo $header['slogan']; ?></p>
                        <p class="address"><?php echo $header['address']; ?></p>
                    </div>
                <?php else: ?>
                    <p>Header tidak tersedia</p>
                <?php endif; ?>
            </div>

            <!-- Tombol Logout-->
            <div class="ml-auto">
                <a href="login.php">
                    <button class="bg-red-500 text-white px-4 py-2 rounded">Logout</button>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Layout -->
    <div class="container flex">
        <!-- Nav (Sidebar) -->
        <nav class="nav w-1/4 p-4 ">
            <div class="mb-6">
                <h1 class="text-xl font-bold">Dashboard</h1>
            </div>
            <ul class="btnSamping">
                <li><a href="#" onclick="tampilHome()">Home</a></li>
                <li><a href="#" onclick="tampilAbout()">About</a></li>
            </ul>
        </nav>

        <!-- Main Section -->
        <section class="section w-3/4 p-4">
            <div id="content">
                <h3>Selamat Datang</h3>
                <p>Klik menu di sebelah kiri untuk melihat informasi yang lainnya.</p>
            </div>
        </section>

        <!-- Aside (Sidebar kanan) -->
        <aside class="aside w-1/4 p-4 bg-gray-200">
        <h2 class="text-xl font-bold mb-4">Status Surat Tugas</h2>
        <ul id="status-list" class="status-list">
            <!-- Status akan dimasukkan di sini -->
        </ul>
    </aside>
    </div>

    <footer>
        <div class="footer-content">
            <?php if ($footer): ?>
                <div class="follow-us">
                    <p><?php echo $footer['follow_us_title']; ?></p>
                    <div class="social-links">
                        <a href="<?php echo $footer['facebook_url']; ?>" target="_blank" class="text-blue-500">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="<?php echo $footer['twitter_url']; ?>" target="_blank" class="text-blue-400">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="<?php echo $footer['instagram_url']; ?>" target="_blank" class="text-pink-600">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="<?php echo $footer['tiktok_url']; ?>" target="_blank" class="text-black">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>
                <div class="copyright">
                    <p><?php echo $footer['copyright_text']; ?></p>
                </div>
            <?php else: ?>
                <p>Footer tidak tersedia</p>
            <?php endif; ?>
        </div>
    </footer>
