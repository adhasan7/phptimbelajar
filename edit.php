<?php
include "konek.php";

// Memeriksa apakah parameter 'id' ada dan bukan null
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data berdasarkan ID
    $query = "SELECT * FROM tblsiswa WHERE no = $id"; // Gantilah "nama_tabel" dengan nama tabel yang sesuai
    $result = mysqli_query($conn, $query);

    // Memeriksa hasil query
    if (!$result) {
        die("Query error: " . mysqli_error($conn));
    }

    // Mengambil data satu baris
    $row = mysqli_fetch_assoc($result);
} else {
    // Jika parameter 'id' tidak ada, redirect atau sesuaikan sesuai kebutuhan
    header("Location: index.php");
    exit();
}

// Proses form edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data yang di-submit dari form
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    // Query untuk melakukan update data
    $update_query = "UPDATE tblsiswa 
                     SET nis = '$nis', nama = '$nama', jk = '$jk', alamat = '$alamat', no_hp = '$no_hp' 
                     WHERE no = $id";
    
    $update_result = mysqli_query($conn, $update_query);

    // Memeriksa hasil query update
    if (!$update_result) {
        die("Update query error: " . mysqli_error($conn));
    }

    // Redirect ke halaman utama setelah update
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Sekolah</title>
</head>
<body>
    <h2>Edit Data Sekolah</h2>

    <!-- Formulir Edit -->
    <form action="" method="post">
        <label for="nis">NIS:</label>
        <input type="text" name="nis" value="<?php echo $row['nis']; ?>"><br>

        <label for="nama">Nama:</label>
        <input type="text" name="nama" value="<?php echo $row['nama']; ?>"><br>

        <label for="jk">Jenis Kelamin:</label>
        <input type="text" name="jk" value="<?php echo $row['jk']; ?>"><br>

        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" value="<?php echo $row['alamat']; ?>"><br>

        <label for="no_hp">Nomor HP:</label>
        <input type="text" name="no_hp" value="<?php echo $row['no_hp']; ?>"><br>

        <button type="submit">Simpan Perubahan</button>
        <a href="index.php">Batal</a>
    </form>
</body>
</html>


