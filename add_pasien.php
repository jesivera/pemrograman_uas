<?php
session_start();
include_once("config.php");

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $nama_ibu = mysqli_real_escape_string($mysqli, $_POST['nama_ibu']);
    $tanggal_lahir = mysqli_real_escape_string($mysqli, $_POST['tanggal_lahir']);
    $alamat = mysqli_real_escape_string($mysqli, $_POST['alamat']);
    $jenis_kelamin_bayi = mysqli_real_escape_string($mysqli, $_POST['jenis_kelamin_bayi']);
    $status_kehamilan = mysqli_real_escape_string($mysqli, $_POST['status_kehamilan']);

    // Query untuk menambahkan data pasien
    $result = mysqli_query($mysqli, "INSERT INTO pasien_klinik(nama_ibu, tanggal_lahir, alamat, jenis_kelamin_bayi, status_kehamilan) VALUES('$nama_ibu', '$tanggal_lahir', '$alamat', '$jenis_kelamin_bayi', '$status_kehamilan')");

    if ($result) {
        header("Location: data_pasien_klinik.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat menambah data pasien.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pasien Klinik Bersalin</title>
    <style>
        /* Styling Form */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .form-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
        }

        .form-container label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-container input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-container button {
            padding: 10px;
            background: #008080;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-container button:hover {
            background: #005555;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Tambah Pasien Baru</h1>
        <form method="POST" action="">
            <label for="nama_ibu">Nama Ibu:</label>
            <input type="text" name="nama_ibu" id="nama_ibu" required>

            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" required>

            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" id="alamat" required>

            <label for="jenis_kelamin_bayi">Jenis Kelamin Bayi:</label>
            <select name="jenis_kelamin_bayi" id="jenis_kelamin_bayi" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <label for="status_kehamilan">Status Kehamilan:</label>
            <input type="text" name="status_kehamilan" id="status_kehamilan" required>

            <button type="submit" name="submit">Tambah Pasien</button>
        </form>
    </div>
</body>
</html>
