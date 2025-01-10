<?php
session_start();
include_once("config.php");

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Pastikan ID pasien ada
if (!isset($_GET['id'])) {
    echo "<script>alert('ID pasien tidak valid!'); window.location.href='index.php';</script>";
    exit();
}

// Ambil ID pasien
$id = $_GET['id'];

// Ambil data pasien dari database
$stmt = $mysqli->prepare("SELECT * FROM pasien_klinik WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Jika data pasien tidak ditemukan
if ($result->num_rows == 0) {
    echo "<script>alert('Pasien tidak ditemukan!'); window.location.href='index.php';</script>";
    exit();
}

$pasien = $result->fetch_assoc();
$stmt->close();

// Proses form jika ada perubahan data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_ibu = trim($_POST['nama_ibu']);
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin_bayi = $_POST['jenis_kelamin_bayi'];
    $status_kehamilan = $_POST['status_kehamilan'];

    // Validasi input
    if (empty($nama_ibu) || empty($tanggal_lahir) || empty($alamat)) {
        echo "<script>alert('Semua field wajib diisi!');</script>";
    } else {
        // Update data pasien di database
        $stmt = $mysqli->prepare("UPDATE pasien_klinik SET nama_ibu = ?, tanggal_lahir = ?, alamat = ?, jenis_kelamin_bayi = ?, status_kehamilan = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $nama_ibu, $tanggal_lahir, $alamat, $jenis_kelamin_bayi, $status_kehamilan, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Data pasien berhasil diperbarui!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan. Coba lagi!');</script>";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pasien Klinik Bersalin</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Nunito:wght@600&display=swap" rel="stylesheet">
    <style>
        /* Styles here (similar to previous page styles) */
    </style>
</head>
<body>
    <header>
        <h1>✏️ Edit Data Pasien Klinik Bersalin</h1>
    </header>

    <!-- Edit Form -->
    <form action="edit_pasien.php?id=<?php echo htmlspecialchars($pasien['id']); ?>" method="post">
        <div class="form-container">
            <label for="nama_ibu">Nama Ibu:</label>
            <input type="text" id="nama_ibu" name="nama_ibu" value="<?php echo htmlspecialchars($pasien['nama_ibu']); ?>" required><br>

            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo htmlspecialchars($pasien['tanggal_lahir']); ?>" required><br>

            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" required><?php echo htmlspecialchars($pasien['alamat']); ?></textarea><br>

            <label for="jenis_kelamin_bayi">Jenis Kelamin Bayi:</label>
            <select id="jenis_kelamin_bayi" name="jenis_kelamin_bayi" required>
                <option value="Laki-laki" <?php echo $pasien['jenis_kelamin_bayi'] == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                <option value="Perempuan" <?php echo $pasien['jenis_kelamin_bayi'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
            </select><br>

            <label for="status_kehamilan">Status Kehamilan:</label>
            <select id="status_kehamilan" name="status_kehamilan" required>
                <option value="Normal" <?php echo $pasien['status_kehamilan'] == 'Normal' ? 'selected' : ''; ?>>Normal</option>
                <option value="Berisiko Tinggi" <?php echo $pasien['status_kehamilan'] == 'Berisiko Tinggi' ? 'selected' : ''; ?>>Berisiko Tinggi</option>
            </select><br>

            <button type="submit">Simpan Perubahan</button>
        </div>
    </form>

    <footer>
        <p>Dibuat dengan 💖 oleh <span>Tim Klinik Bersalin</span></p>
    </footer>
</body>
</html>
