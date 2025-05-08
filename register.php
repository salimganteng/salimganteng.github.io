<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek apakah email sudah terdaftar
    $query_check = "SELECT * FROM users WHERE email = '$email'";
    $result_check = mysqli_query($conn, $query_check);
    
    if (mysqli_num_rows($result_check) > 0) {
        $error = "Email sudah terdaftar, silakan login!";
    } else {
        // Generate ID pelanggan dengan format "PA" + 4 angka random
        $id_pelanggan = "PA" . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        // Simpan ke database
        $query = "INSERT INTO users (id_pelanggan, nama, email, password) VALUES ('$id_pelanggan', '$nama', '$email', '$password')";
        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = "Akun Anda telah berhasil terdaftar. Silakan login!";
            header("Location: login.php");
            exit();
        } else {
            $error = "Pendaftaran gagal, coba lagi!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <style>
 /* Reset dasar */
 * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #f1f1f1, #e4ecf9);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .form-container {
            background-color: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            position: relative;
        }

        .form-container h2 {
            margin-bottom: 20px;
            color: #1e1e2f;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-container input:focus {
            border-color: #1e1e2f;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #1e1e2f;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            margin-top: 10px;
        }

        .form-container button:hover {
            background-color: #ffc300;
            color: #1e1e2f;
        }

        .form-container p {
            margin-top: 15px;
            font-size: 14px;
        }

        .form-container a {
            color: #1e1e2f;
            font-weight: bold;
            text-decoration: none;
        }

        .form-container a:hover {
            color: #ffc300;
        }

        .error {
            color: red;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .success {
            color: green;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .back-button {
            position: absolute;
            top: 15px;
            left: 15px;
        }

        .back-button a {
            color: #1e1e2f;
            font-size: 20px;
            text-decoration: none;
            transition: color 0.3s;
        }

        .back-button a:hover {
            color: #ffc300;
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 25px 20px;
            }
        }
</style>
    <div class="back-button">
        <a href="index.php"><i class="fa-solid fa-arrow-left"></i></a>
    </div>

    <div class="form-container">
        <h2>Daftar</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form action="register.php" method="post">
            <input type="text" name="nama" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
