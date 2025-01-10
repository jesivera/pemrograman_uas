<?php
session_start();
include_once("config.php");

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);

    $result = mysqli_query($mysqli, "SELECT * FROM users WHERE username = '$username'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        header("Location: data_pasien_klinik.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Klinik Bersalin</title>
    <style>
        /* Styling Global */
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

        .login-container {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #ff7eb9; /* Warna pink lembut */
            font-weight: bold;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .login-container label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .login-container input {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #f0c6d6; /* Warna border lembut */
            border-radius: 25px;
            width: 100%;
            font-size: 16px;
        }

        .login-container button {
            padding: 12px;
            background: #ff7eb9; /* Warna tombol sesuai tema */
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        .login-container button:hover {
            background: #f50057; /* Warna hover */
        }

        .login-container .message {
            margin-top: 10px;
            color: red;
        }

        .login-container p {
            margin-top: 20px;
            color: #666;
        }

        .login-container p a {
            color: #ff7eb9;
            text-decoration: none;
            font-weight: bold;
        }

        .login-container p a:hover {
            text-decoration: underline;
        }

        /* Menambahkan gambar emosi ibu hamil dan bayi */
        .stickers {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .stickers img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        .logo {
            width: 80px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="stickers">
            <!-- Stiker Ibu Hamil (Bahagia) -->
            <img src="ibu.jpg" alt="Ibu Hamil Bahagia">
            <!-- Stiker Bayi (Lucu) -->
            <img src="bayi.jpg" alt="Bayi Lucu">
        </div>
        <img src="logo.jpg" alt="Logo Klinik" class="logo">
        <h1>Selamat Datang di Klinik Bersalin</h1>
        
        <?php if (isset($error)): ?>
            <p class="message"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit" name="submit">Login</button>
        </form>

        <p>Belum punya akun? <a href="register.php">Daftar di sini</a>.</p>
    </div>
</body>
</html>
