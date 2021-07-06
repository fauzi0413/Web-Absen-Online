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
            <div class="card">
            <h1>DETAIL SISWA</h1>

                <div class="detail">
                    <table class="table" border="1">
                        
                        <?php
                            $user = $_GET['username'];

                            $result = mysqli_query($conn, "SELECT * FROM tambah_siswa WHERE username = '$user' ");
                            $data = mysqli_fetch_assoc($result);
                            
                            // Pergantian Nilai Kelamin
                            
                            $kelamin = $data['kelamin'];
                            if($kelamin == 'L'){
                                $data['kelamin'] = "Laki-laki";
                            }
                            elseif($kelamin == 'P'){
                                $data['kelamin'] = "Perempuan";
                            }

                        ?>
                        
                        <tr>
                            <td>Nama</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $data['nama_siswa'] ?></td>
                        </tr>
                        
                        <tr>
                            <td>NIS</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $data['nis'] ?></td>
                        </tr>
                        
                        <tr>
                            <td>Kelas Siswa</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $data['kelas_siswa'] ?></td>
                        </tr>
                        
                        <tr>
                            <td>Kelamin</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $data['kelamin'] ?></td>
                        </tr>
                        
                        <tr>
                            <td>Alamat</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $data['alamat'] ?></td>
                        </tr>
                        
                        <tr>
                            <td>Tempat Lahir</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $data['tempat_lahir'] ?></td>
                        </tr>
                        
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $data['tanggal_lahir'] ?></td>
                        </tr>

                    </table>
                </div>

            </div>
        </div>
    </main>
</body>
</html>