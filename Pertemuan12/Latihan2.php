<?php
$con = mysqli_connect("localhost", "root", "", "pemrogramanweb2");

if (!$con) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$sql = "DELETE FROM tbl_mhs WHERE LastName = 'Prabowo'";

if (mysqli_query($con, $sql)) {
    echo "Data berhasil dihapus";
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);
?>