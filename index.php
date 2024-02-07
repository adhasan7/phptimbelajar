<?php
include "konek.php"; // Sesuaikan nama file dengan koneksi database Anda
// Proses pencarian
if (isset($_GET['search'])) {
    $keyword = $_GET['search'];
    $query = "SELECT * FROM tblsiswa 
              WHERE nis LIKE '%$keyword%' 
              OR nama LIKE '%$keyword%' 
              OR jk LIKE '%$keyword%' 
              OR alamat LIKE '%$keyword%' 
              OR no_hp LIKE '%$keyword%'";
} else {
    $query = "SELECT * FROM tblsiswa";
}

$query = "SELECT * FROM tblsiswa"; // Gantilah "nama_tabel" dengan nama tabel yang sesuai
$result = mysqli_query($conn, $query);

// Memeriksa hasil query
if (!$result) {
    die("Query error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h2>Tampilkan Data Sekolah</h2>
    <br>
    <!-- Formulir Pencarian -->
    <form action="" method="get">
        <label for="search">Pencarian:</label>
        <input type="text" name="search" id="search">
        <button type="submit">Cari</button>
    </form>

    <!-- <a href="hello.php?kota=cirebon&buah=apel">Masuk ke hello </a> -->

    <!-- Formulir Penambahan Data -->
   <!-- Tampilkan formulir penambahan data setelah mengklik tombol tambah -->
   <button onclick="tampilkanFormulir()">Tambah Data</button>

<div id="formulirTambah" style="display: none;">
    <!-- Formulir Penambahan Data -->
    <form class="tambah" action="tambah.php" method="post" onsubmit="return validateForm()">
        <label for="nis">NIS:</label>
        <input type="text" name="nis" id="nis" required>
        
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" required>

        <label for="jk">Jenis Kelamin:</label>
        <input type="text" name="jk" id="jk" required>

        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" id="alamat" required>

        <label for="no_hp">Nomor HP:</label>
        <input type="text" name="no_hp" id="no_hp" required>

        <button type="submit">Tambah Data</button>
    </form>
</div>



    <table border="1">
        <tr>
            <td> no </td>
            <td> nis </td>
            <td> nama </td>
            <td> jenis kelamin </td>
            <td> alamat </td>
            <td> nomer hp </td>
            <td>Action</td>
        </tr>
        <script>
        function konfirmasiHapus() {
            var konfirmasi = confirm("Apakah Anda yakin ingin menghapus data ini?");
            if (konfirmasi) {
                document.getElementById("formHapus").submit();
            }
        }

        function validateForm() {
                // Tambahkan validasi tambahan jika diperlukan
                // Contohnya, Anda dapat memeriksa apakah NIS unik di sini
                var nisValue = document.getElementById("nis").value;
                if (checkIfNisExists(nisValue)) {
                    alert('Maaf, NIS sudah ada. Silakan gunakan NIS yang berbeda.');
                    return false; // Mencegah pengiriman formulir
                }
                return true; // Mengizinkan pengiriman formulir
            }
    </script>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            
            echo "<tr>";
            echo "<td>" . $row["no"] . "</td>";
            echo "<td>" . $row["nis"] . "</td>";
            echo "<td>" . $row["nama"] . "</td>";
            echo "<td>" . $row["jk"] . "</td>";
            echo "<td>" . $row["alamat"] . "</td>";
            echo "<td>" . $row["no_hp"] . "</td>";
            echo "<td>";
            echo "<a href='edit.php?id=" . $row["no"] . "'>Edit</a> | ";
           // echo "<a onclick="return confirm('Are you sure you want to search Google?');" href='hapus.php?id=" . $row["no"] . "'>Hapus</a>";
           echo "<a onclick=\"return confirm('Yakin anda hapus?');\" href='hapus.php?nis=" . $row["nis"] . "'>Hapus</a>";
           


            echo "</td>";
            
            echo "</tr>";
        }
        ?>
    </table>
    <script>
    function tampilkanFormulir() {
        var formulir = document.getElementById("formulirTambah");
        var button = document.querySelector("button[onclick='tampilkanFormulir()']");

        if (formulir.style.display === "none") {
            formulir.style.display = "block";
            button.innerHTML = "Kembali";
        } else {
            formulir.style.display = "none";
            button.innerHTML = "Tambah Data";
        }
    }
</script>

</body>
</html>
