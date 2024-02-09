<?php
// Form submission handling
include "konek.php"; // Added a semicolon here

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if the search form is submitted
    if (isset($_GET["search"])) {
        $search = mysqli_real_escape_string($conn, $_GET["search"]);
        $query = "SELECT * FROM tblsiswa WHERE nis LIKE '%$search%' OR nama LIKE '%$search%' OR alamat LIKE '%$search%' OR no_hp LIKE '%$search%'";
    } else {
        $query = "SELECT * FROM tblsiswa";
    }

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check for query errors
    if (!$result) {
        die("Query error: " . mysqli_error($conn));
    }
}
?>
