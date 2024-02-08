<?php
include "konek.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nis = mysqli_real_escape_string($conn, $_POST['nis']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jk = mysqli_real_escape_string($conn, $_POST['jk']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);

    // Check if the NIS already exists
    $nisExists = checkIfNisExists($nis);

    if ($nisExists) {
      
      echo "<script>alert('Maaf, NIS sudah ada. Silakan gunakan NIS yang berbeda.');</script>";
       
        echo "<script>window.location.href = 'index.php';</script>";
        exit();
    
    } else {
        // If NIS doesn't exist, proceed with adding the data to the database
        $query = "INSERT INTO tblsiswa (nis, nama, jk, alamat, no_hp) VALUES ('$nis', '$nama', '$jk', '$alamat', '$no_hp')";

        if (mysqli_query($conn, $query)) {
            echo "Data berhasil ditambahkan.";
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);

// Function to check if NIS exists in the database (replace with your actual logic)
function checkIfNisExists($nis) {
    global $conn; // Assuming $conn is your database connection object
    $result = mysqli_query($conn, "SELECT * FROM tblsiswa WHERE nis = '$nis'");
    return mysqli_num_rows($result) > 0;
}
?>
