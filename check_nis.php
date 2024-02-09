<?php
include "konek.php"; // Sesuaikan dengan file koneksi Anda

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nis = $_POST["nis"];

    // Lakukan pengecekan ke database
    $checkQuery = "SELECT COUNT(*) as count FROM tblsiswa WHERE nis = '$nis'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (!$checkResult) {
        die("Query error: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($checkResult);
    $count = $row["count"];

    if ($count > 0) {
        echo "exists";
    } else {
        echo "not_exists";
    }
}
?>
