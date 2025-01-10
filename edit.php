<?php
session_start();
include_once("config.php");

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil ID pasien dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: data_pasien_klinik.php");
    exit();
}

// Ambil data pasien berdasarkan ID
$result = mysqli_query($mysqli, "SELECT * FROM pasien_klinik WHERE id=$id");

if (mysqli_num_rows($result) == 1) {
    $pasien = mysqli_fetch_array($result);
} else {
    echo "Data pasien tidak ditemukan!";
    exit();
}

// Proses pembaruan data pasien
if (isset($_POST['submit'])) {
    $nama_ibu = mysqli_real_escape_string($mysqli, $_POST['nama_ibu']);
    $tanggal_lahir = mysqli_real_escape_string($mysqli, $_POST['tanggal_lahir']);
    $alamat = mysqli_real_escape_string($mysqli, $_POST['alamat']);
    $jenis_kelamin_bayi = mysqli_real_escape_string($mysqli, $_POST['jenis_kelamin_bayi']);
    $status_kehamilan = mysqli_real_escape_string($mysqli, $_POST['status_kehamilan']);

    // Query untuk memperbarui data pasien
    $update = mysqli_query($mysqli, "UPDATE pasien_klinik SET nama_ibu='$nama_ibu', tanggal_lahir='$tanggal_lahir', alamat='$alamat', jenis_kelamin_bayi='$jenis_kelamin_bayi', status_kehamilan='$status_kehamilan' WHERE id=$id");

    if ($update) {
        header("Location: data_pasien_klinik.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat memperbarui data pasien.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pasien Klinik Bersalin</title>
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

        .form-container input,
        .form-container select {
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
        <h1>Edit Data Pasien</h1>
        <form method="POST" action="">
            <!-- Input Form untuk Mengedit Data Pasien -->
            <label for="nama_ibu">Nama Ibu:</label>
            <input type="text" name="nama_ibu" id="nama_ibu" value="<?= htmlspecialchars($pasien['nama_ibu']) ?>" required>

            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?= htmlspecialchars($pasien['tanggal_lahir']) ?>" required>

            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" id="alamat" value="<?= htmlspecialchars($pasien['alamat']) ?>" required>

            <label for="jenis_kelamin_bayi">Jenis Kelamin Bayi:</label>
            <select name="jenis_kelamin_bayi" id="jenis_kelamin_bayi" required>
                <option value="Laki-laki" <?= $pasien['jenis_kelamin_bayi'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= $pasien['jenis_kelamin_bayi'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>

            <label for="status_kehamilan">Status Kehamilan:</label>
            <input type="text" name="status_kehamilan" id="status_kehamilan" value="<?= htmlspecialchars($pasien['status_kehamilan']) ?>" required>

            <button type="submit" name="submit">Perbarui Data</button>
        </form>
    </div>
</body>
</html>
