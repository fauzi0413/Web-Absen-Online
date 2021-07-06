<?php
session_start();

// Disarankan menggunakan error_reporting saat projek sudah selesai
// Fungsi error_reporting di bawah untuk mematikan/menghilangkan semua error yang terbaca
error_reporting(0);

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
                <h1>DETAIL USER</h1>
                
                <div class="detail">
                    <table class="table" border="1">
                        
                        <?php
                            $user = $_GET['username'];

                            // Cek Level

                            $result = mysqli_query($conn, "SELECT *
                                FROM data_admin INNER JOIN user
                                ON user.username  = '$user'
                            ");
                            $data = mysqli_fetch_assoc($result);

                            if($data['level'] == 'admin'){
                                $sql = mysqli_query($conn, "SELECT * FROM data_admin WHERE username = '$user'");
                                $admin = mysqli_fetch_assoc($sql);
                        ?>
                        
                        <tr>
                            <td>Nama</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $admin['nama_admin'] ?></td>
                        </tr>
                        
                        <tr>
                            <td>Nomor Induk</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $admin['no_induk'] ?></td>
                        </tr>
                        
                        <?php
                            }

                            elseif($data['level'] == 'user'){
                                $sql = mysqli_query($conn, "SELECT * FROM tambah_siswa WHERE username = '$user'");
                                $user = mysqli_fetch_assoc($sql);
                        ?>

                        <tr>
                            <td>Nama</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $user['nama_siswa'] ?></td>
                        </tr>
                        
                        <tr>
                            <td>NIS</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $user['nis'] ?></td>
                        </tr>
                        
                        <?php
                                
                            }
                        ?>
                        
                        <tr>
                            <td>Username</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $data['username'] ?></td>
                        </tr>
                        
                        <tr>
                            <td>Password</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $data['password'] ?></td>
                        </tr>
                        
                        <tr>
                            <td>Level</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $data['level'] ?></td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </main>
</body>
</html>