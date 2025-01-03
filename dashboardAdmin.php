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
    <link href="styless.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <script>
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
                            <tr class="hover:bg-gray-100 transition duration-300">
                                <td>${surat.Judul}</td>
                                <td>${surat.Keterangan || 'N/A'}</td>
                                <td>${surat.Tanggal}</td>
                                <td>${surat.Jenis_surat}</td>
                                <td>
    <button onclick="deleteSurat(${surat.idSurat})" class="bg-red-500 text-white py-2 px-4 rounded-lg">Hapus</button>
    <button onclick="terimaSurat(${surat.idSurat})" class="bg-green-500 text-white py-2 px-4 rounded-lg ml-2">Terima</button>
    <button onclick="tolakSurat(${surat.idSurat})" class="bg-yellow-500 text-white py-2 px-4 rounded-lg ml-2">Tolak</button>
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

        function terimaSurat(idSurat) {
    fetch('koneksi.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: 'terima',
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

function tolakSurat(idSurat) {
    fetch('koneksi.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: 'tolak',
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

        function createSurat(event) {
            event.preventDefault();

            const judul = document.getElementById('judul').value;
            const tanggal = document.getElementById('tanggal').value;

            fetch('koneksi.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'create',
                    judul: judul,
                    tanggal: tanggal,
                }),
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    tampilHome();
                })
                .catch(error => console.error('Error:', error));
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

        function terimaSurat(idSurat) {
            fetch('koneksi.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'terima',
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

        function tolakSurat(idSurat) {
            fetch('koneksi.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'tolak',
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

        function tampilHome() {
            document.getElementById('content').innerHTML = `
                <h3 class="text-xl font-semibold mt-10 mb-6">Daftar Surat Tugas</h3>
                <table class="w-full table-auto shadow-md bg-white rounded-lg">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-4 text-left font-semibold">Judul Surat</th>
                            <th class="p-4 text-left font-semibold">Deskripsi</th>
                            <th class="p-4 text-left font-semibold">Tanggal</th>
                            <th class="p-4 text-left font-semibold">Jenis Surat</th>
                            <th class="p-4 text-left font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="suratTugasList">
                        <!-- Data Surat Tugas akan dimuat di sini -->
                    </tbody>
                </table>
            `;
            loadSurat(); 
        }
    </script>
</head>
<body class="bg-gray-100" onload="tampilHome()">
    
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

            
            <div class="ml-auto">
                <a href="login.php">
                    <button class="bg-red-500 text-white px-4 py-2 rounded">Logout</button>
                </a>
            </div>
        </div>
    </header>

    <main class="container p-6" id="content"></main>

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
</body>
</html>
