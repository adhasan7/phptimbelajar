<?php
include "konek.php"; // Sesuaikan nama file dengan koneksi database Anda

$query = "SELECT * FROM tblsiswa"; // Gantilah "tblsiswa" dengan nama tabel yang sesuai
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function konfirmasiHapus() {
            var konfirmasi = confirm("Apakah Anda yakin ingin menghapus data ini?");
            if (konfirmasi) {
                document.getElementById("formHapus").submit();
            }
        }

        function validateForm() {
            var nisValue = document.getElementById("nis").value;

            // Get the value of 'no_hp'
            var noHpValue = document.getElementById("no_hp").value;

            // Check if 'no_hp' is not numeric
            if (!isNumeric(noHpValue)) {
                alert('Nomor HP harus berupa angka.');
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }

        function isNumeric(value) {
            return /^\d+$/.test(value);
        }

        $(document).ready(function() {
            // Attach a submit event handler to the form
            $("#formTambah").submit(function() {
                // Get the value of 'nis' and 'no_hp'
                var nisValue = $("#nis").val();
                var noHpValue = $("#no_hp").val();

                // Check if 'no_hp' is not numeric
                if (!isNumeric(noHpValue)) {
                    alert('Nomor HP harus berupa angka.');
                    return false; // Prevent form submission
                }

                // Allow form submission
                return true;
            });
        });


        // tampilkan

        function konfirmasiHapus() {
            var konfirmasi = confirm("Apakah Anda yakin ingin menghapus data ini?");
            if (konfirmasi) {
                document.getElementById("formHapus").submit();
            }
        }

  
        function validateForm() {
            var nisValue = document.getElementById("nis").value;
            var noHpValue = document.getElementById("no_hp").value;

            // Check if 'no_hp' is not numeric
            if (!isNumeric(noHpValue)) {
            alert('Nomor HP harus berupa angka.');
             return false; // Prevent form submission
        }

           // Check if NIS exists using AJAX
        if (checkIfNisExists(nisValue)) {
            alert('Maaf, NIS sudah ada. Silakan gunakan NIS yang berbeda.');
              return false; // Prevent form submission
        }

           // Allow form submission
       return true;
}


       
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

        function isNumeric(value) {
            return /^\d+$/.test(value);
        }
        // yang baru
        $(document).ready(function() {
            // Attach a submit event handler to the form
            $("#formTambah").submit(function() {
                // Get the value of 'nis' and 'no_hp'
                var nisValue = $("#nis").val();
                var noHpValue = $("#no_hp").val();

                // Check if 'nis' is unique
                if (checkIfNisExists(nisValue)) {
                    alert('Maaf, NIS sudah ada. Silakan gunakan NIS yang berbeda.');
                    return false; // Prevent form submission
                }

                // Check if 'no_hp' is not numeric
                if (!isNumeric(noHpValue)) {
                    alert('Nomor HP harus berupa angka.');
                    return false; // Prevent form submission
                }

                // Allow form submission
                return true;
            });

            function isNumeric(value) {
                return /^\d+$/.test(value);
            }

            function checkIfNisExists(nis) {
                // Perform the check for existing NIS values using AJAX
                // Replace the URL with the actual server-side script or endpoint
                return $.ajax({
                    url: 'check_nis.php',
                    method: 'POST',
                    data: { nis: nis },
                    async: false, // Make the request synchronous for simplicity
                    success: function(response) {
                        return response === 'exists';
                    }
                }).responseText === 'exists';
            }
        });
        // 
    </script>
</head>
<body>
    <?php
    // Include the header file
include("header.php");
// Set the condition based on your logic
session_start();

?>
    <h2>Tampilkan Data Sekolah</h2>
    <br>
    <!-- Formulir Pencarian -->
    <?php 
      include "pencarian.php"
    ?>
    <form action="" method="get">
        <label for="search">Pencarian:</label>
        <input type="text" name="search" id="search">
        <button type="submit">Cari</button>
    </form>

    <!-- Formulir Penambahan Data -->
    <button onclick="tampilkanFormulir()">Tambah Data</button>

    <div id="formulirTambah" style="display: none;">
        <!-- Formulir Penambahan Data -->
     <form class="tambah" action="tambah.php" method="post" onsubmit="return validateForm()" id="formTambah">
    <label for="nis">NIS:</label>
    <input type="text" name="nis" id="nis" required>
    
    <label for="nama">Nama:</label>
    <input type="text" name="nama" id="nama" required>
    
    <label for="jk">Pilih jenis kelamin:</label>
    <select name="jk" id="jk" required>
        <option value="" disabled selected hidden>Pilih jenis kelamin</option>
        <option value="laki">Laki-Laki</option>
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
            <td> nomer hp </td>
            <td>Action</td>
        </tr>

        <?php
        // Fetch data from the database
        $result = mysqli_query($conn, $query);

        // Check for query errors
        if (!$result) {
            die("Query error: " . mysqli_error($conn));
        }

        // Check if no rows were returned
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Check if 'no_hp' is not numeric
                if (is_numeric($row["no_hp"])) {
                    echo "<tr>";
                    echo "<td>" . $row["no"] . "</td>";
                    echo "<td>" . $row["nis"] . "</td>";
                    echo "<td>" . $row["nama"] . "</td>";
                    echo "<td>" . $row["jk"] . "</td>";
                    echo "<td>" . $row["alamat"] . "</td>";
                    echo "<td>" . $row["no_hp"] . "</td>";
                    echo "<td>";
                    echo "<a href='edit.php?id=" . $row["no"] . "'>Edit</a> | ";
                    echo "<a onclick=\"return confirm('Yakin anda hapus?');\" href='hapus.php?nis=" . $row["nis"] . "'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
        } else {
            echo "No data found"; // Handle case when no data is returned
        }
        ?>
    </table>
</body>
</html>
