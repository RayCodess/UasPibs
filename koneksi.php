<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "surat_tugas";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die(json_encode(["message" => "Koneksi ke database gagal: " . mysqli_connect_error()]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;

    switch ($action) {
        case 'create':
            createSurat($conn);
            break;
        case 'read':
            readSurat($conn);
            break;
        case 'delete':
            deleteSurat($conn);
            break;
        case 'status':
                readStatus($conn); 
                break;
        case 'terima':
                    terimaSurat($conn); 
                    break;
        case 'tolak':
                    tolakSurat($conn); 
                    break;
        default:
            echo json_encode(["message" => "Aksi tidak valid"]);
            break;
    }
}

function createSurat($conn) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul'] ?? '');
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan'] ?? '');
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal'] ?? '');
    $jenisSurat = mysqli_real_escape_string($conn, $_POST['jenisSurat'] ?? '');

    if (empty($judul) || empty($tanggal) || empty($jenisSurat)) {
        echo json_encode(["message" => "Judul, Tanggal, dan Jenis Surat tidak boleh kosong"]);
        return;
    }

    $sql = "INSERT INTO tbl_surat (Judul, Keterangan, Tanggal, Jenis_surat) VALUES ('$judul', '$keterangan', '$tanggal', '$jenisSurat')";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["message" => "Data berhasil ditambahkan"]);
    } else {
        echo json_encode(["message" => "Gagal menambahkan data: " . mysqli_error($conn)]);
    }
}


function readSurat($conn) {
    $sql = "SELECT idSurat, Judul, Tanggal, Keterangan, Jenis_surat FROM tbl_surat";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo json_encode(["message" => "Query gagal: " . mysqli_error($conn)]);
        return;
    }

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

function deleteSurat($conn) {
    $idSurat = intval($_POST['idSurat'] ?? 0);

    if ($idSurat <= 0) {
        echo json_encode(["message" => "ID Surat tidak valid"]);
        return;
    }

    $sql = "DELETE FROM tbl_surat WHERE idSurat = $idSurat";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["message" => "Data berhasil dihapus"]);
    } else {
        echo json_encode(["message" => "Gagal menghapus data: " . mysqli_error($conn)]);
    }
}

function readStatus($conn) {
    $sql = "SELECT s.idSurat, s.status, st.Judul FROM tbl_status s
            JOIN tbl_surat st ON s.idSurat = st.idSurat";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo json_encode(["message" => "Query gagal: " . mysqli_error($conn)]);
        return;
    }

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

function terimaSurat($conn) {
    $idSurat = intval($_POST['idSurat'] ?? 0);

    if ($idSurat <= 0) {
        echo json_encode(["message" => "ID Surat tidak valid"]);
        return;
    }

    $sql = "INSERT INTO tbl_status (idSurat, status) VALUES ($idSurat, 'disetujui')
            ON DUPLICATE KEY UPDATE status = 'disetujui'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["message" => "Surat disetujui"]);
    } else {
        echo json_encode(["message" => "Gagal mengubah status: " . mysqli_error($conn)]);
    }
}

function tolakSurat($conn) {
    $idSurat = intval($_POST['idSurat'] ?? 0);

    if ($idSurat <= 0) {
        echo json_encode(["message" => "ID Surat tidak valid"]);
        return;
    }

    $sql = "INSERT INTO tbl_status (idSurat, status) VALUES ($idSurat, 'ditolak')
            ON DUPLICATE KEY UPDATE status = 'ditolak'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["message" => "Surat ditolak"]);
    } else {
        echo json_encode(["message" => "Gagal mengubah status: " . mysqli_error($conn)]);
    }
} 

function getFooter() {
    global $conn;
    $sql = "SELECT * FROM tbl_footer WHERE id = 1"; 
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); 
    } else {
        return null;
    }
}

function getHeader() {
    global $conn;
    $sql = "SELECT * FROM tbl_header WHERE id = 1"; 
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); 
    } else {
        return null;
    }
}

?>
