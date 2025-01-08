<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "surat_tugas";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die(json_encode(["message" => "Koneksi ke database gagal: " . mysqli_connect_error()]));
}

$query_header = "SELECT * FROM tbl_header WHERE id = 1";
$result_header = mysqli_query($conn, $query_header);
$header = mysqli_fetch_assoc($result_header);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_header'])) {
    $site_name = $_POST['site_name'];
    $slogan = $_POST['slogan'];
    $address = $_POST['address'];

    $update_query = "UPDATE tbl_header SET site_name = '$site_name', slogan = '$slogan', address = '$address' WHERE id = 1";
    if (mysqli_query($conn, $update_query)) {
    } else {
       mysqli_error($conn);
    }
}

$query_footer = "SELECT * FROM tbl_footer WHERE id = 1";
$result_footer = mysqli_query($conn, $query_footer);
$footer = mysqli_fetch_assoc($result_footer);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_footer'])) {
    $follow_us_title = $_POST['follow_us_title'];
    $facebook_url = $_POST['facebook_url'];
    $twitter_url = $_POST['twitter_url'];
    $instagram_url = $_POST['instagram_url'];
    $tiktok_url = $_POST['tiktok_url'];
    $copyright_text = $_POST['copyright_text'];

    $update_query = "UPDATE tbl_footer SET follow_us_title = '$follow_us_title', facebook_url = '$facebook_url', twitter_url = '$twitter_url', instagram_url = '$instagram_url', tiktok_url = '$tiktok_url', copyright_text = '$copyright_text' WHERE id = 1";
    if (mysqli_query($conn, $update_query)) {
        echo "Footer updated successfully";
        header("Location: " . $_SERVER['PHP_SELF']); 
        exit();
    } else {
        echo "Error updating footer: " . mysqli_error($conn);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel_edit'])) {
    header("Location: " . $_SERVER['PHP_SELF']); 
    exit();
}
