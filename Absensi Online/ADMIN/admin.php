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
            <div class="profile">
                <div class="card">
                    <h1>PROFIL <?php echo $_SESSION['nama']; ?></h1>

                    <?php
                        $nama = $_SESSION['nama'];
                        $result = mysqli_query($conn, "SELECT * FROM data_admin WHERE username = '$nama' ");
                        $data = mysqli_fetch_assoc($result);
                    ?>

                    <div class="profile-admin">
                        <table class="table" border="1">
                            <tr>
                                <td>Nama</td>
                                <td class="profile-tengah">:</td>
                                <td class="profile-kanan"><?php echo $data['nama_admin'] ?></td>
                            </tr>
                            
                            <tr>
                                <td>Username</td>
                                <td class="profile-tengah">:</td>
                                <td class="profile-kanan"><?php echo $data['username'] ?></td>
                            </tr>
                            
                            <tr>
                                <td>Nomor Induk</td>
                                <td class="profile-tengah">:</td>
                                <td class="profile-kanan"><?php echo $data['no_induk'] ?></td>
                            </tr>
                            
                            <tr>
                                <td>Level</td>
                                <td class="profile-tengah">:</td>
                                <td class="profile-kanan"><?php echo $_SESSION['level'] ?></td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        
    </main>
</body>
</html>