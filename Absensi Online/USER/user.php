<?php
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
            <h1>PROFIL <?php echo $_SESSION['nama']; ?></h1>
                <?php
                    $nama = $_SESSION['nama'];
                    $result = mysqli_query($conn, "SELECT * FROM tambah_siswa WHERE username = '$nama' ");
                    $cek = mysqli_fetch_assoc($result);

                    $kelamin = $cek['kelamin'];
                    if($kelamin == 'L'){
                        $kelamin = "Laki-laki";
                    }
                    elseif($kelamin == 'P'){
                        $kelamin = "Perempuan";
                    }
                    
                ?>

                <div class="profile-admin">
                    <table class="table" border="1">
                        <tr>
                            <td>Nama</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $cek['nama_siswa'] ?></td>
                        </tr>
                        
                        <tr>
                            <td>Username</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $cek['username'] ?></td>
                        </tr>
                        
                        <tr>
                            <td>NIS</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $cek['nis'] ?></td>
                        </tr>
                        
                        <tr>
                            <td>Kelas Siswa</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $cek['kelas_siswa'] ?></td>
                        </tr>                    
                        
                        <tr>
                            <td>kelamin</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $kelamin ?></td>
                        </tr>
                        
                        <tr>
                            <td>Alamat</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $cek['alamat'] ?></td>
                        </tr>
                        
                        <tr>
                            <td>Tempat Lahir</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $cek['tempat_lahir'] ?></td>
                        </tr>
                        
                        <tr>
                            <td>Tangal Lahir</td>
                            <td class="profile-tengah">:</td>
                            <td class="profile-kanan"><?php echo $cek['tanggal_lahir'] ?></td>
                        </tr>
                        
                    </table>
                </div>

            </div>
        </div>

    </main>
</body>
</html>