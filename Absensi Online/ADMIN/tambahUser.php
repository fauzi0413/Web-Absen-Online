<?php
session_start();

if(!isset($_SESSION['admin'])){
    header('location: ./ADMIN/login.php');
    exit;
}

require './function.php';

if(isset($_POST['register'])){

    if(registrasi($_POST)>0){
        echo "<script>
                alert('User baru berhasil ditambahkan !');
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
                <h1>TAMBAH USER</h1>
                <div class="form">
                    <form class="form1" method="post" action="">
                        <div class="menu">
                            <div class="user-menu">
                                <div class="potition">
                                    <div class="input">
                                        <span><i class="fas fa-user"></i></span>
                                        <label for="username">Username</label>                        
                                    </div>
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" maxlength="10" required>
                                </div>

                                <div class="potition">
                                    <div class="input">
                                        <span><i class="fas fa-lock"></i></span>
                                        <label for="password">Password</label>
                                    </div>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" maxlength="15" required>
                                </div>

                                <div class="potition">
                                    <div class="input">
                                        <span><i class="fas fa-lock"></i></span>
                                        <label for="password2">Konfirmasi Password</label>
                                    </div>
                                        <input type="password" name="password2" id="password2" class="form-control" placeholder="Konfirmasi Password" maxlength="15" required>
                                </div>

                                <div class="potition">
                                    <div class="input">
                                        <span><i class="fas fa-users"></i></span>
                                        <label for="level">Level</label>
                                    </div>
                                        <select name="level" id="level" required>
                                            <option disabled selected>Pilih Level</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                </div>
                            </div>
                            
                        </div> <!-- div tutup punya class menu -->
                        <br>
                        <input class="button login" type="submit" name="register" value="Daftar">
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>