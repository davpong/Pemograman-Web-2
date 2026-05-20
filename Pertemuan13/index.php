<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Mahasiswa</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>


    <div class="container">

        <h2>Form Input Data Mahasiswa</h2>

        <form method="POST">

            <div class="form-group">
                <label>ID Mahasiswa / NIM</label>
                <input type="text" name="nim">
            </div>

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama">
            </div>

            <div class="form-group">
                <label>Jurusan</label>

                <select name="jurusan">
                    <option>- Pilih Jurusan -</option>
                    <option>Teknik Informatika</option>
                    <option>Sistem Informasi</option>
                    <option>Manajemen Informatika</option>
                    <option>Akuntansi</option>
                </select>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat"></textarea>
            </div>

            <div class="form-group">
                <label>No. Telp</label>
                <input type="text" name="telp">
            </div>

            <div class="button-group">
                <button type="submit" class="submit">
                    Submit
                </button>

                <button type="reset" class="cancel">
                    Cancel
                </button>
            </div>

        </form>

        <?php

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $jurusan = $_POST['jurusan'];
            $alamat = $_POST['alamat'];
            $telp = $_POST['telp'];

            echo "<div class='hasil'>";
            echo "<h3>Data Mahasiswa</h3>";
            echo "NIM : $nim <br>";
            echo "Nama : $nama <br>";
            echo "Jurusan : $jurusan <br>";
            echo "Alamat : $alamat <br>";
            echo "No Telp : $telp";
            echo "</div>";
        }

        ?>

    </div>

</body>
</html>