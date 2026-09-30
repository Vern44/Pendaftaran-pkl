                        <!-- // ANALISIS VIDEO
1.	Perhatikan URL browser pada menit [08:24]. Apa yang terjadi pada URL saat data dikirim menggunakan metode GET?
Jawab:data tersebut dikirimkan dengan cara ditempelkan langsung di bagian ujung URL
2.	Berdasarkan penjelasan di menit [10:31], mengapa kita dilarang keras menggunakan metode GET untuk form yang berisi password atau data sensitif?
Jawab:Karena apa yang kita masukkan saat menggunakan metode get, akan terlihat jelas url, sehingga data sensitive akan langusng terlihat secara transparan
3.	Apa fungsi utama dari pengecekan isset() yang dipraktikkan pada menit [09:00]?
Jawab: Untuk mengecek apakah data dari metode GET sudah dimasukkan atau belum sebelum memprosesnya, dan mencegah muncul error undefined variable //
 -->
<?php 

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $NIS = $_POST['NIS'];
    $jurusan = $_POST['jurusan'];
    $perusahaan = $_POST['perusahaan'];
    $kompetensi = $_POST['kompetensi'];
    $alasan = $_POST['alasan'];
}
echo "<h1>Form Pendaftaran PKL</h1>";
    if(!empty($nama) && !empty($NIS)) {
        echo "Pendaftaran berhasil!";
    } else {
        echo "Pastikan Nama dan NIS diisi.";
    }


?>

<form action="pendaftaran.php" method="POST">
    <label for="nama">Nama:</label> 
    <input type="text" name="nama" ><br>

    <label for="email">Email:</label>
    <input type="email" name="email" ><br>

    <label for="NIS">NIS:</label>
    <input type="number" name="NIS" ><br>

    <label for="jurusan">Jurusan:</label>
    <input type="radio" name="jurusan" value="TKJ"> SIJA
    <input type="radio" name="jurusan" value="RPL"> TJAT<br>

    <label for="perusahaan">Perusahaan:</label>
    <input type="text" name="perusahaan" ><br>

    <label for="kompetensi">Kompetensi:</label>
    <input type="checkbox" name="kompetensi[]" value="Programming"> Programming
    <input type="checkbox" name="kompetensi[]" value="Design"> Design<br>

    <label for="alasan">Alasan:</label>
    <textarea name="alasan"></textarea><br>

    <input type="submit" name="submit" value="Daftar">
</form>

<?php
{
echo "<h1>Data yang disubmit:</h1>";
echo $_POST['nama'] . "<br>";
echo $_POST['email'] . "<br>";
echo $_POST['NIS'] . "<br>";
echo $_POST['jurusan'] . "<br>";
echo $_POST['perusahaan'] . "<br>";
echo implode(", ", $_POST['kompetensi']) . "<br>";
echo $_POST['alasan'] . "<br>";

}

?>