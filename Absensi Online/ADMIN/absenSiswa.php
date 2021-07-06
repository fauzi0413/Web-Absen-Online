<?php

session_start();

if(!isset($_SESSION['admin'])){
    header('location: ../login.php');
    exit;
}

require './function.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
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
                    <a href="./admin.php"><li>Profil</li></a>
                    <a href="./tambahUser.php"><li>Tambah User</li></a>
                    <a href="./tambahKelas.php"><li>Tambah Kelas</li></a>
                    <a href="./tambahSiswa.php"><li>Tambah Siswa</li></a>
                    <a href="./dataUser.php"><li>Data User</li></a>
                    <a href="./dataSiswa.php"><li>Data Siswa</li></a>
                    <a href="./absenSiswa.php"><li>Absen Siswa</li></a>
                    <a href="./dataAbsen.php"><li>Data Absensi</li></a>
                </ul>
            </div>
        </aside>

        <div class="container">
            <div class="card-absen-edit">
            <h1>WAKTU ABSEN SISWA</h1>

                <div class="absen">
            
                    <table class="table-edit" border="1">
                            <?php
                                $sql = mysqli_query($conn, "SELECT * FROM tb_pengaturan_absen");
                                $jam = mysqli_fetch_assoc($sql);
                            ?>
                            <tr class="judul">
                                <td class="keterangan">Keterangan</td>
                                <td class="mulai">Jam Mulai</td>
                                <td class="selesai">Jam Selesai</td>
                                <td><span><i class="fas fa-cog"></i></span></td>
                            </tr>

                            <tr class="jam-absen">
                                <td class="keterangan">Masuk</td>
                                <td class="jam-mulai"><?php echo $jam['jam_masuk_awal'] ?>:00</td>
                                <td class="jam-selesai"><?php echo $jam['jam_masuk_akhir'] ?>:00</td>
                                <td class="edit">
                                    <span><a href="./editAbsenMasuk.php"><i class="far fa-edit"></i></a></span>
                                </td>
                            </tr>

                            <tr class="jam-absen">
                                <td class="keterangan">Pulang</td>
                                <td class="jam-mulai"><?php echo $jam['jam_pulang_awal'] ?>:00</td>
                                <td class="jam-selesai"><?php echo $jam['jam_pulang_akhir'] ?>:00</td>
                                <td class="edit">
                                    <span><a href="./editAbsenPulang.php"><i class="far fa-edit"></i></a></span>
                                </td>
                            </tr>
                    </table>

                </div>
            
            </div>
        </div>
    </main>
</body>
</html>