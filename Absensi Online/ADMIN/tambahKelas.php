<?php
session_start();

if(!isset($_SESSION['admin'])){
    header('location: ./ADMIN/login.php');
    exit;
}

require './function.php';

if(isset($_POST['btnkelas'])){

    if(btnkelas($_POST)>0){
            echo "<script>
                    alert('Kelas baru berhasil ditambahkan !');
                </script>";
            }

    else{
        echo mysqli_error($conn);
    }
}


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
            <h1>TAMBAH KELAS</h1>
                <div class="form">
                    <form class="kelas" method="post" action="">

                        <div class="potition">
                            <div class="input">
                                <span><i class="fas fa-user-graduate"></i></span>
                                <label for="kelas">Nama Kelas</label>
                            </div>
                                <input type="text" name="kelas" id="kelas" class="form-control" placeholder="Nama Kelas ( Wajib Menggunakan Huruf Besar )" maxlength="20" required>
                        </div>
                        <p>*Contoh penulisan nama kelas ( X RPL 1, XI MM 2, XII TKJ 3)</p>
                        
                        <br>
                        <input class="button" type="submit" name="btnkelas" value="Daftar">
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>