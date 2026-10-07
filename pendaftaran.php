<!-- // ANALISIS VIDEO
1. Perhatikan URL browser pada menit [08:24]. Apa yang terjadi pada URL saat data dikirim menggunakan metode GET?
Jawab: Data tersebut dikirimkan dengan cara ditempelkan langsung di bagian ujung URL.
2. Berdasarkan penjelasan di menit [10:31], mengapa kita dilarang keras menggunakan metode GET untuk form yang berisi password atau data sensitif?
Jawab: Karena apa yang kita masukkan saat menggunakan metode GET akan terlihat jelas di URL, sehingga data sensitif langsung terlihat secara transparan.
3. Apa fungsi utama dari pengecekan isset() yang dipraktikkan pada menit [09:00]?
Jawab: Untuk mengecek apakah data dari metode GET/POST sudah dikirim/dibuat sebelum memprosesnya, dan mencegah muncul error undefined variable.
-->

<?php 
include 'koneksi.php';

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    
    $nama       = $_POST['nama'] ?? '';
    $email      = $_POST['email'] ?? '';
    $NIS        = $_POST['NIS'] ?? '';
    $jurusan    = $_POST['jurusan'] ?? '';
    $perusahaan = $_POST['perusahaan'] ?? '';
    $alasan     = $_POST['alasan'] ?? '';

    if (isset($_POST['kompetensi']) && is_array($_POST['kompetensi'])) {
        $kompetensi = implode(", ", $_POST['kompetensi']);
    } else {
        $kompetensi = "";
    }

    if (!empty($nama) && !empty($NIS)) {
        try {
            // Query simpan data dengan PDO Prepared Statement
            $sql = "INSERT INTO siswa (nama, email, nis, jurusan, perusahaan, kompetensi, alasan) 
                    VALUES (:nama, :email, :nis, :jurusan, :perusahaan, :kompetensi, :alasan)";
            
            $stmt = $koneksi->prepare($sql);
            
            // Eksekusi query dengan memasukkan array data
            $stmt->execute([
                ':nama'       => $nama,
                ':email'      => $email,
                ':nis'        => $NIS,
                ':jurusan'    => $jurusan,
                ':perusahaan' => $perusahaan,
                ':kompetensi' => $kompetensi,
                ':alasan'     => $alasan
            ]);

            $pesan = "<p style='color: green; font-weight: bold;'>Pendaftaran berhasil dan data tersimpan ke database!</p>";
        } catch (PDOException $e) {
            // Error code 23000 di PDO menandakan Integrity Constraint Violation (misal: Email/NIS Duplikat)
            if ($e->getCode() == '23000') {
                $pesan = "<p style='color: red; font-weight: bold;'>Gagal: Email atau NIS sudah terdaftar!</p>";
            } else {
                $pesan = "<p style='color: red; font-weight: bold;'>Gagal menyimpan data: " . $e->getMessage() . "</p>";
            }
        }
    } else {
        $pesan = "<p style='color: red; font-weight: bold;'>Error: Pastikan Nama dan NIS diisi!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran PKL</title>
</head>
<body>

    <h1>Form Pendaftaran PKL</h1>

    <?php 
   
    if (!empty($pesan)) {
        echo $pesan;
    } 
    ?>

    
    <form action="" method="POST">
        <label for="nama">Nama:</label><br> 
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="NIS">NIS:</label><br>
        <input type="number" id="NIS" name="NIS" required><br><br>

        <label>Jurusan:</label><br>
        <input type="radio" name="jurusan" value="SIJA" id="sija"> <label for="sija">SIJA</label>
        <input type="radio" name="jurusan" value="TJAT" id="tjat"> <label for="tjat">TJAT</label><br><br>

        <label for="perusahaan">Perusahaan:</label><br>
        <input type="text" id="perusahaan" name="perusahaan"><br><br>

        <label>Kompetensi:</label><br>
        <input type="checkbox" name="kompetensi[]" value="Programming" id="prog"> <label for="prog">Programming</label>
        <input type="checkbox" name="kompetensi[]" value="Design" id="des"> <label for="des">Design</label><br><br>

        <label for="alasan">Alasan:</label><br>
        <textarea id="alasan" name="alasan"></textarea><br><br>

        <input type="submit" name="submit" value="Daftar">
    </form>

    <?php
  
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        echo "<h2>Data yang Disubmit:</h2>";
        echo "<strong>Nama:</strong> " . htmlspecialchars($nama) . "<br>";
        echo "<strong>Email:</strong> " . htmlspecialchars($email) . "<br>";
        echo "<strong>NIS:</strong> " . htmlspecialchars($NIS) . "<br>";
        echo "<strong>Jurusan:</strong> " . htmlspecialchars($jurusan) . "<br>";
        echo "<strong>Perusahaan:</strong> " . htmlspecialchars($perusahaan) . "<br>";
        echo "<strong>Kompetensi:</strong> " . htmlspecialchars($kompetensi) . "<br>";
        echo "<strong>Alasan:</strong> " . htmlspecialchars($alasan) . "<br>";
    }
    ?>

</body>
</html>