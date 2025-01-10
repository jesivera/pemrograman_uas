<?php
session_start();
include_once("config.php");

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil data pasien dari database
$result = mysqli_query($mysqli, "SELECT * FROM pasien_klinik ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien Klinik Bersalin</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Nunito:wght@600&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #fff5f8;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background-color: #ff7eb9;
            color: white;
            text-align: center;
            padding: 20px;
            border-bottom: 5px solid #f50057;
        }

        header h1 {
            font-size: 2.5rem;
        }

        /* Table Styles */
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        table th {
            background-color: #ff7eb9;
            color: white;
            font-size: 1rem;
        }

        table tr:nth-child(even) {
            background-color: #ffeef5;
        }

        table tr:hover {
            background-color: #ffdde1;
        }

        /* Button Styles */
        .button-container {
            display: flex;
            justify-content: flex-end;
            margin: 20px;
        }

        .button {
            background-color: #ff7eb9;
            color: white;
            padding: 10px 20px;
            text-align: center;
            display: inline-block;
            border-radius: 25px;
            margin: 0 10px;
            transition: all 0.3s ease;
            font-size: 1rem;
            text-decoration: none;
        }

        .button:hover {
            background-color: #f50057;
            transform: translateY(-2px);
        }

        .logout-button {
            background-color: #ff1744;
        }

        .logout-button:hover {
            background-color: #d50000;
        }

        /* Cute Footer */
        footer {
            text-align: center;
            padding: 10px;
            background-color: #ff7eb9;
            color: white;
            margin-top: 20px;
            border-top: 5px solid #f50057;
        }

        footer p {
            font-size: 0.9rem;
        }

        footer p span {
            font-weight: bold;
            color: #ffeef5;
        }
    </style>
</head>
<body>
    <header>
        <h1>👩‍⚕️ Data Pasien Klinik Bersalin 👨‍⚕️</h1>
    </header>

    <div class="button-container">
        <a href="add_pasien.php" class="button">Tambah Pasien ➕</a>
        <a href="logout.php" class="button logout-button">Keluar 👋</a>
    </div>

    <!-- Patient Data Table -->
    <table>
        <thead>
            <tr>
                <th>Nama Ibu</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Jenis Kelamin Bayi</th>
                <th>Status Kehamilan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($pasien = mysqli_fetch_array($result)) : ?>
                <tr>
                    <td><?= htmlspecialchars($pasien['nama_ibu']) ?></td>
                    <td><?= htmlspecialchars($pasien['tanggal_lahir']) ?></td>
                    <td><?= htmlspecialchars($pasien['alamat']) ?></td>
                    <td><?= htmlspecialchars($pasien['jenis_kelamin_bayi']) ?></td>
                    <td><?= htmlspecialchars($pasien['status_kehamilan']) ?></td>
                    <td>
                        <a href="edit_pasien.php?id=<?= htmlspecialchars($pasien['id']) ?>" class="button">✏️ Edit</a>
                        <a href="delete.php?id=<?= htmlspecialchars($pasien['id']) ?>" class="button logout-button" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini? 🥺')">🗑️ Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <footer>
        <p>Dibuat dengan 💖 oleh <span>Tim Klinik Bersalin</span></p>
    </footer>
</body>
</html>
