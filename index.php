<?php
include "konek.php"; // Sesuaikan nama file dengan koneksi database Anda

// Proses pencarian
if (isset($_GET['search'])) {
    $cari = $_GET['search'];
    $data = mysqli_query($conn, "SELECT * FROM tblsiswa WHERE nama LIKE '%$cari%'");
} else {
    $data = mysqli_query($conn, "SELECT * FROM tblsiswa");
}

$no = 1;
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

    <!-- Formulir Penambahan Data -->
    <button onclick="tampilkanFormulir()">Tambah Data</button>

    <div id="formulirTambah" style="display: none;">
        <!-- Formulir Penambahan Data -->
        <form id="formTambah" class="tambah" action="tambah.php" method="post" onsubmit="return validateForm()">
            <label for="nis">NIS:</label>
            <input type="text" name="nis" id="nis" required>
            
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" required>

            <label for="jk">Jenis Kelamin:</label>
<select name="jk" id="jk" required>
    <option value="laki-laki">Laki-laki</option>
    <option value="perempuan">Perempuan</option>
</select>

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
            <td> nomor hp </td>
            <td>Action</td>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($data)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $row["nis"] . "</td>";
            echo "<td>" . $row["nama"] . "</td>";
            echo "<td>" . $row["jk"] . "</td>";
            echo "<td>" . $row["alamat"] . "</td>";
            echo "<td>" . $row["no_hp"] . "</td>";
            echo "<td>";
            echo "<a href='edit.php?id=" . $row["no"] . "'>Edit</a> | ";
            echo "<a href='hapus.php?nis=" . $row["nis"] . "' onclick='return confirm(\"Yakin anda hapus?\")'>Hapus</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <script>
        function konfirmasiHapus() {
            var konfirmasi = confirm("Apakah Anda yakin ingin menghapus data ini?");
            if (konfirmasi) {
                document.getElementById("formHapus").submit();
            }
        }

        function validateForm() {
            var nisValue = document.getElementById("nis").value;
            if (checkIfNisExists(nisValue)) {
                alert('Maaf, NIS sudah ada. Silakan gunakan NIS yang berbeda.');
                return false; // Mencegah pengiriman formulir
            }
            return true; // Mengizinkan pengiriman formulir
        }

        function tampilkanFormulir() {
            var formulir = document.getElementById("formulirTambah");
            var button = document.querySelector("button[onclick='tampilkanFormulir()']");

            if (formulir.style.display === "none") {
                formulir.style.display = "block";
                formulir.style.float = "left";
                button.innerHTML = "Kembali";
            } else {
                formulir.style.display = "none";
                button.innerHTML = "Tambah Data";
            }
        }
    </script>
</body>
</html>
