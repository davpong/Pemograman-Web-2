<html>
<body>

<?php
// Array pertama
$x = array("one","two","three");

foreach ($x as $value) {
    echo $value . "<br />";
}

// Array kedua
$b["sayur"] = "wortel";
$b["daging"] = "ayam";
$b["utama"] = "nasi";

// Hitung jumlah elemen array
$jumlah = sizeof($b);

print "Jumlah array b = $jumlah <br>";
// variabel $jumlah akan bernilai 3
?>

</body>
</html>