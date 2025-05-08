<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek apakah email terdaftar di database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Pastikan password sesuai (disarankan gunakan password_hash() untuk keamanan)
        if ($user['password'] === $password) { 
            $_SESSION['user'] = $user['email'];  // Simpan email ke session
            $_SESSION['role'] = $user['role'];   // Simpan role ke session
            
            header("Location: index.php"); // Redirect ke halaman utama
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Akun Anda belum terdaftar, silakan daftar terlebih dahulu!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <style>
        /* Gaya umum body */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(to right, #f1f1f1, #e4ecf9);
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    padding: 20px;
}

/* Container form login */
.form-container {
    background-color: white;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

.form-container h2 {
    margin-bottom: 20px;
    color: #1e1e2f;
}

/* Input fields */
.form-container input[type="email"],
.form-container input[type="password"] {
    width: 100%;
    padding: 12px 15px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    outline: none;
    transition: border 0.3s;
}

.form-container input:focus {
    border-color: #1e1e2f;
}

/* Button login */
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
    transition: background 0.3s;
}

.form-container button:hover {
    background-color: #ffc300;
    color: #1e1e2f;
}

/* Link daftar */
.form-container p {
    margin-top: 15px;
    font-size: 14px;
}

.form-container a {
    color: #1e1e2f;
    text-decoration: none;
    font-weight: bold;
}

.form-container a:hover {
    color: #ffc300;
}

/* Error & success message */
.success {
    color: green;
    margin-bottom: 15px;
    font-size: 14px;
}

.error {
    color: red;
    margin-bottom: 15px;
    font-size: 14px;
}

/* Tombol back */
.back-button {
    position: absolute;
    top: 20px;
    left: 20px;
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

</style>
    <div class="back-button">
        <a href="index.php"><i class="fa-solid fa-arrow-left"></i></a>
    </div>

    <div class="form-container">
        <h2>Login</h2>

        <?php
        // Tampilkan pesan sukses jika ada
        if (isset($_SESSION['success'])) {
            echo "<p class='success'>" . $_SESSION['success'] . "</p>";
            unset($_SESSION['success']); // Hapus session agar tidak muncul lagi setelah refresh
        }

        // Tampilkan pesan error jika ada
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>

        <form action="login.php" method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Belum punya akun? <a href="register.php">Daftar</a></p>
    </div>
</body>
</html>
