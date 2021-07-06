<?php
error_reporting(0);

session_start();

if(!isset($_SESSION['user'])){
    header('location: ../login.php');
    exit;
}

require '../ADMIN/function.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="icon" href="./">
    <link rel="stylesheet" href="../CSS/style_admin.css">
    <link rel="stylesheet" href="../CSS/style_user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
    <header>
        <div class="title">
            <h1>SELAMAT DATANG <?php echo $_SESSION['nama']; ?></h1>
        </div>
        
        <div class="logout">
            <a href="../logout.php">Logout</a>
        </div>
    </header>

    <main>
        <aside>
            <div class="aside">
                <ul>
                    <a href="./user.php"><li>Profil</li></a>
                    <a href="./absen.php"><li>Absen</li></a>
                    <a href="./daftarAbsen.php"><li>Absenku</li></a>
                </ul>
            </div>
        </aside>

        <div class="container">
            <div class="card">
                <h1>DAFTAR ABSEN SISWA</h1>

                <div class="daftar-absen">
            
                    <table class="table-absen">
                            <tr class="judul">
                                <td class="no">No</td>
                                <td class="tanggal">Tanggal</td>
                                <td class="masuk">Absen Masuk</td>
                                <td class="pulang">Absen Pulang</td>
                                <td class="status">Status</td>
                            </tr>
                            
                            <?php
                                $username = $_SESSION['nama'];
                                
                                $result = mysqli_query($conn, "SELECT * FROM tb_absen WHERE username = '$username' ");
                                $no = 0;
                                
                                while($data = mysqli_fetch_assoc($result)){
                                    
                                /*------------------------------------------------------*/
                                // Jam Masuk
                                $masuk = $data['datetime_masuk'];

                                // Pisah data waktu masuk
                                $pisah_waktu = explode(" ",$masuk);    
                                $hari = $pisah_waktu[0];
                                $tanggal = $pisah_waktu[1];
                                $waktu = $pisah_waktu[2];

                                // Pisah data untuk mengambil data jam
                                $jam_lengkap = explode(":",$waktu);
                                $jam = $jam_lengkap[0];
                                $menit = $jam_lengkap[1];
                                $detik = $jam_lengkap[2];

                                /*------------------------------------------------------*/                                
                                // Jam Keluar
                                $keluar = $data['datetime_keluar'];

                                // Pisah data waktu masuk
                                $waktu_keluar = explode(" ",$keluar);    
                                $hari_keluar = $waktu_keluar[0];
                                $tanggal_keluar = $waktu_keluar[1];
                                $waktu_pulang = $waktu_keluar[2];

                                // Pisah data untuk mengambil data jam
                                $keluar_lengkap = explode(":",$waktu_pulang);
                                $jam_keluar = $keluar_lengkap[0];
                                $menit_keluar = $keluar_lengkap[1];
                                $detik_keluar = $keluar_lengkap[2];

                                /*------------------------------------------------------*/ 
                                // Ubah Tanggal menjadi Tanggal Indonesia
                                $nama_hari = array( 1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu');
                                $nama_bulan = array( 1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                                                            'September', 'Oktober', 'November', 'Desember');
                                
                                $pisah_tanggal = explode("/",$tanggal);
                                $data_tanggal = $pisah_tanggal[0]." ".$nama_bulan[$pisah_tanggal[1]]." ".$pisah_tanggal[2];
                                

                                $datetime_masuk = $jam.":".$menit.":".$detik;
                                $datetime_keluar = $jam_keluar.":".$menit_keluar.":".$detik_keluar;
                                
                                    $no++
                            ?>
                            <tr>
                                <td class="nmr"><?php echo $no ?></td>
                                <td class="tanggal"><?php echo $data_tanggal; ?></td>
                                <td class="masuk"><?php echo $datetime_masuk ?></td>
                                <td class="keluar"><?php echo $datetime_keluar?></td>
                                <td class="status"><?php echo $data['status'] ?></td>
                            </tr>
                            <?php
                                }
                            ?>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>