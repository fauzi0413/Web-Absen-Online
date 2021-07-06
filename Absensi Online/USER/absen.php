<?php
error_reporting(0);

session_start();

if(!isset($_SESSION['user'])){
    header('location: ../login.php');
    exit;
}

require '../ADMIN/function.php';


// 
// Absen Masuk
// 

$sql = mysqli_query($conn, "SELECT * FROM tb_pengaturan_absen");
$jam_absen = mysqli_fetch_assoc($sql);


if(isset($_POST['masuk'])){

    $masuk = $_POST['waktu-masuk'];

    // Pisah data waktu masuk
    $pisah_waktu = explode(" ",$masuk);    
    $hari = $pisah_waktu[0];
    $tanggal = $pisah_waktu[1];
    $waktu = $pisah_waktu[2];
    
    // Pisah data untuk mengambil data jam
    $jam_lengkap = explode(":",$waktu);
    $jam = $jam_lengkap[0];
    $menit = $jam_lengkap[1];

    if($jam < $jam_absen['jam_masuk_awal']){
        echo "<script>
                alert('Belum Bisa Absen Masuk!!');
            </script>";
    }
    elseif( ($jam >= $jam_absen['jam_masuk_awal']) && ($jam < $jam_absen['jam_masuk_akhir']) ){
        header('location:./daftarAbsen.php');
        echo "<script>
                alert('Berhasil Absen Tepat Waktu!!');
            </script>";
    }
    elseif ($jam >= $jam_absen['jam_masuk_akhir']){
        header('location:./daftarAbsen.php');
        echo "<script>
                alert('Terlambat, Berhasil Absen!!');
            </script>";
    }

    if(absenMasuk($_POST)>0){
    }
    else{
        echo mysqli_error($conn);
    };
    
}

// 
// Akhir Absen Masuk
// 




// 
// Absen Pulang
// 

if(isset($_POST['pulang'])){

    $pulang = $_POST['waktu-pulang'];

    // Pisah data waktu masuk
    $pisah_waktu = explode(" ",$pulang);    
    $hari = $pisah_waktu[0];
    $tanggal = $pisah_waktu[1];
    $waktu = $pisah_waktu[2];

    // Pisah data untuk mengambil data jam
    $jam_lengkap = explode(":",$waktu);
    $jam = $jam_lengkap[0];

    if($jam < $jam_absen['jam_pulang_awal']){
        echo "<script>
                alert('Belum Bisa Absen Pulang !!');
            </script>";
    }
    elseif( ($jam >= $jam_absen['jam_pulang_awal']) && ($jam < $jam_absen['jam_pulang_akhir']) ){
        header('location:./daftarAbsen.php');
        echo "<script>
                alert('Berhasil Absen Pulang!!');
            </script>";
    }
    elseif ($jam >= $jam_absen['jam_pulang_akhir']){
        header('location:./daftarAbsen.php');
        echo "<script>
                alert('Terlambat, Berhasil Absen Pulang!!');
            </script>";
    }


    if(absenPulang($_POST)>0){

    }
    else{
        echo mysqli_error($conn);
    }
    
}

// 
// Akhir Absen Pulang
// 

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
                    <?php
                    ?>
                    <span></span>
                    <a href="./user.php"><li>Profil</li></a>
                    <a href="./absen.php"><li>Absen</li></a>
                    <a href="./daftarAbsen.php"><li>Absenku</li></a>
                </ul>
            </div>
        </aside>

        <div class="container">
            <div class="card-absen">
            <h1>ABSEN SISWA</h1>

                <div class="absen">
            
                    <table class="tableAbsen" border="1">
                            <tr class="judul">
                                <td class="status">Status</td>
                                <td class="tanggal">Tanggal</td>
                                <td class="masuk">Absen Masuk</td>
                                <td class="pulang">Absen Pulang</td>
                            </tr>

                            <tr class="daftar-absen">
                                <td class="status">
                                    <?php 
                                        $nama = $_SESSION['nama'];
                                        $sql = mysqli_query($conn, "SELECT * FROM tb_absen WHERE id = (SELECT MAX(id) FROM tb_absen) && username = '$nama' ");
                                        $cek = mysqli_fetch_assoc($sql);
                                        
                                        if(($cek['status'] != "") && ($cek['datetime_keluar'] != "") ){
                                    ?> 
                                        <span><i class="fas fa-check-square"></i></span>
                                    <?php
                                        }
                                        elseif(($cek['status'] != "") && ($cek['datetime_keluar'] == "")){
                                    ?>
                                        <span><i class="fas fa-exclamation-triangle"></i></span>
                                    <?php
                                        }
                                        elseif($cek['status'] == "" ){
                                    ?>
                                        <span><i class="fas fa-times-circle"></i></span>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td class="tanggal"><?php echo tanggal_indonesia($waktu_lengkap); ?></td>
                                <td class="masuk">
                                    <form action="" method="post">
                                    <?php
                                        $hari_ini = date('j/n/Y');
                                        $sql = mysqli_query($conn, "SELECT * FROM tb_absen WHERE id = (SELECT MAX(id) FROM tb_absen) && username = '$nama' ");
                                        $cek_btn = mysqli_fetch_assoc($sql);    
                                        
                                        $masuk = $cek_btn['datetime_masuk'];
                                        
                                        $pisah_waktu = explode(" ",$masuk);    
                                        $hari = $pisah_waktu[0];
                                        $tanggal = $pisah_waktu[1];
                                        
                                        if($hari_ini == $tanggal){
                                    ?>
                                        <input type="hidden" name="waktu-masuk" value="<?php echo date("N j/n/Y H:i:s");?>" >
                                        <input type="submit" name="masuk" class="btn" value="Absen Masuk" disabled>
                                    <?php
                                        }
                                        else{
                                    ?>
                                        <input type="hidden" name="waktu-masuk" value="<?php echo date("N j/n/Y H:i:s");?>" >
                                        <input type="submit" name="masuk" class="btn" value="Absen Masuk">
                                    <?php
                                        }
                                    ?>
                                    </form>
                                </td>
                                <td class="pulang">
                                    <form action="" method="post">
                                    <?php
                                        $hari_ini = date('j/n/Y');
                                        $sql = mysqli_query($conn, "SELECT * FROM tb_absen WHERE id = (SELECT MAX(id) FROM tb_absen) && username = '$nama' ");
                                        $cek_btn = mysqli_fetch_assoc($sql);    
                                        
                                        $pulang = $cek_btn['datetime_keluar'];
                                        
                                        $pisah_waktu = explode(" ",$pulang);    
                                        $hari = $pisah_waktu[0];
                                        $tanggal = $pisah_waktu[1];
                                        
                                        if($hari_ini == $tanggal){
                                    ?>
                                        <input type="hidden" name="waktu-pulang" value="<?php echo date("N j/n/Y H:i:s");?>" >
                                        <input type="submit" name="pulang" class="btn" value="Absen Pulang" disabled>
                                    <?php
                                        }
                                        else{
                                    ?>
                                        <input type="hidden" name="waktu-pulang" value="<?php echo date("N j/n/Y H:i:s");?>" >
                                        <input type="submit" name="pulang" class="btn" value="Absen Pulang">
                                    <?php
                                        }
                                    ?>
                                    </form>
                                </td>
                            </tr>
                    </table>

                </div>
            
            </div>
        </div>
    </main>
</body>
</html>