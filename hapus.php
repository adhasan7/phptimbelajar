
<?php

include "konek.php";

$nis = $_GET["nis"];

$hapus = mysqli_query($conn,"DELETE FROM tblsiswa WHERE nis = '$nis'");

header("Location: index.php");
die();

?>