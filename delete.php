<?php
session_start();
include_once("config.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = mysqli_query($mysqli, "DELETE FROM pasien_klinik WHERE id = $id");

    if ($result) {
        header("Location: data_pasien_klinik.php");
        exit();
    } else {
        echo "Gagal menghapus data pasien.";
    }
} else {
    header("Location: data_pasien_klinik.php");
    exit();
}
?>
