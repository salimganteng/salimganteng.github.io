<?php
session_start(); 
include 'koneksi.php';

$menu = [
    'index' => 'Home',
    'sepatu' => 'Sepatu',
    'tentang' => 'Tentang'
];

// Proses pencarian
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$query = "SELECT * FROM tambah_barang";
if (!empty($search)) {
    $query .= " WHERE brand LIKE '%$search%' OR name LIKE '%$search%'";
}
$data = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Sepatu</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
/* Heading */
h2 {
    text-align: center;
    font-size: 2rem;
    margin: 30px 0 20px;
    color: #003049;
}

h2 a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
}

h2 a:hover {
    color: #ffba08;
}

/* Form Pencarian */
.search-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 30px auto 10px;
    padding: 10px;
    width: 100%;
}

.search-container form {
    display: flex;
    width: 90%;
    max-width: 600px;
    gap: 10px;
}

.search-container input[type="text"] {
    flex: 1;
    padding: 10px 14px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 1rem;
    outline: none;
    transition: border 0.3s;
}

.search-container input[type="text"]:focus {
    border-color: #003049;
}

.search-container button {
    background-color: #003049;
    color: white;
    border: none;
    padding: 10px 16px;
    border-radius: 6px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s;
}

.search-container button:hover {
    background-color: #ffba08;
    color: #003049;
}

/* Table Container */
.table-container {
    overflow-x: auto;
    margin: 0 auto;
    width: 95%;
}

/* Table Styles */
table {
    width: 100%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

th, td {
    padding: 14px 12px;
    border: 1px solid #e0e0e0;
    text-align: center;
    font-size: 0.95rem;
}

th {
    background-color: #003049;
    color: white;
    font-weight: 600;
}

tr:hover {
    background-color: #f9f9f9;
}

/* Gambar */
td img {
    width: 90px;
    height: auto;
    border-radius: 5px;
    transition: transform 0.3s ease;
    object-fit: cover;
}

td img:hover {
    transform: scale(1.05);
}

/* Tombol */
.btn-beli, .btn-edit, .btn-hapus {
    padding: 8px 12px;
    margin: 4px 2px;
    font-size: 0.85rem;
    font-weight: 600;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    display: inline-block;
    text-decoration: none;
}

/* Tombol Beli */
.btn-beli {
    background-color: #2ecc71;
    color: white;
}

.btn-beli:hover {
    background-color: #27ae60;
    transform: scale(1.03);
}

/* Tombol Edit */
.btn-edit {
    background-color: #f39c12;
    color: white;
}

.btn-edit:hover {
    background-color: #e67e22;
    transform: scale(1.03);
}

/* Tombol Hapus */
.btn-hapus {
    background-color: #e74c3c;
    color: white;
}

.btn-hapus:hover {
    background-color: #c0392b;
    transform: scale(1.03);
}



    </style>
</head>
<body>

    <div class="navbar">
        <?php foreach ($menu as $key => $value) : ?>
            <a href="<?= $key ?>.php"> <?= $value ?> </a>
        <?php endforeach; ?>

        <?php if (isset($_SESSION['user']) && $_SESSION['role'] === 'admin') : ?>
            <a href="data.php">Data</a>
        <?php endif; ?>

        <?php if (isset($_SESSION['user'])) : ?>
            <a href="logout.php">Logout</a>
        <?php else : ?>
            <a href="login.php">Login</a>
            <a href="register.php">Daftar</a>
        <?php endif; ?>
    </div>

    <!-- Form Pencarian -->
    <div class="search-container">
        <form action="" method="get">
            <input type="text" name="search" placeholder="Cari nama atau brand..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit"><i class="fas fa-search"></i> Cari</button>
        </form>
    </div>

    <h2><a href='sepatu.php'>Daftar Produk Sepatu</a></h2>
    
    <div class="table-container">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Brand</th>
                <th>Nama Produk</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Ket</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while ($row = mysqli_fetch_assoc($data)) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td>
                        <a href="uploads/<?= htmlspecialchars($row['image']) ?>" target="_blank">
                            <img src="uploads/<?= htmlspecialchars($row['image']) ?>" alt="Sepatu">
                        </a>
                    </td>
                    <td><?= htmlspecialchars($row['brand']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['stok']) ?></td>
                    <td>$ <?= number_format($row['harga'], 0, ',', '.') ?></td>
                    <td>
    <button class="btn-beli" onclick="window.location.href='pembayaran.php?id=<?= $row['id'] ?>'">Beli</button>

    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') : ?>
        <a href="edit_produk.php?id=<?= $row['id'] ?>" class="btn-edit">Edit</a>

        <form action="hapus produk.php" method="post" style="display:inline;">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <button type="submit" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
        </form>
    <?php endif; ?>
</td>

                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
                        </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; <?= date("Y"); ?> Yepatu. Semua Hak Dilindungi.</p>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-whatsapp"></i></a>
        </div>
    </footer>

</body>
</html>
