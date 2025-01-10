<?php
session_start();
include_once("config.php");

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($mysqli, $_POST['confirm_password']);

    // Validasi input
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = "Semua kolom harus diisi!";
    } elseif ($password !== $confirm_password) {
        $error = "Password dan Konfirmasi Password tidak cocok!";
    } else {
        // Hash password untuk keamanan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Periksa apakah username sudah ada
        $check_username = mysqli_query($mysqli, "SELECT * FROM users WHERE username = '$username'");
        if (mysqli_num_rows($check_username) > 0) {
            $error = "Username sudah digunakan. Silakan pilih username lain.";
        } else {
            // Tambahkan pengguna baru ke database
            $result = mysqli_query($mysqli, "INSERT INTO users(username, password) VALUES('$username', '$hashed_password')");
            if ($result) {
                $success = "Registrasi berhasil! Silakan <a href='login.php'>login</a>.";
            } else {
                $error = "Terjadi kesalahan saat registrasi. Silakan coba lagi.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Klinik Bersalin</title>
    <style>
        /* Styling Form */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ffeff1; /* Warna pastel lembut */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }

        .register-container h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #ff7eb9; /* Warna pink lembut */
            font-weight: bold;
        }

        .register-container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .register-container label {
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        .register-container input {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #f0c6d6; /* Warna border lembut */
            border-radius: 25px;
            width: 80%;
            font-size: 16px;
        }

        .register-container button {
            padding: 12px;
            background: #ff7eb9; /* Warna tombol sesuai tema */
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            width: 80%;
        }

        .register-container button:hover {
            background: #f50057; /* Warna hover */
        }

        .register-container .message {
            margin-top: 10px;
            color: red;
        }

        .success {
            color: green;
        }

        .register-container p {
            margin-top: 20px;
            color: #666;
        }

        .register-container p a {
            color: #ff7eb9;
            text-decoration: none;
            font-weight: bold;
        }

        .register-container p a:hover {
            text-decoration: underline;
        }

        /* Menambahkan elemen stiker ibu hamil dan bayi */
        .stickers {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .stickers img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

    </style>
</head>
<body>
    <div class="register-container">
        <!-- Stiker Ibu Hamil dan Bayi -->
        <div class="stickers">
            <img src="ibu.jpg" alt="Ibu Hamil Bahagia">
            <img src="bayi.jpg" alt="Bayi Lucu">
        </div>

        <h1>Registrasi Akun Klinik Bersalin</h1>
        <?php if (isset($error)): ?>
            <p class="message"><?= $error ?></p>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <p class="message success"><?= $success ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <label for="confirm_password">Konfirmasi Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>

            <button type="submit" name="submit">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="login.php">Login di sini</a>.</p>
    </div>
</body>
</html>
