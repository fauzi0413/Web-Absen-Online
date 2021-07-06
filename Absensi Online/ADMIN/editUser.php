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


if(isset($_POST['editUser'])){
    
    if(editUser($_POST)>0){
        echo "<script>
                alert('Data Berhasil di Ubah !!');
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
                <h1>EDIT USER</h1>
                <form class="siswa" method="post" action="">
                    <div class="edit">
                            
                            <?php
                                $user = $_GET['username'];

                                
                                $result = mysqli_query($conn, "SELECT *
                                    FROM data_admin INNER JOIN user
                                    ON user.username  = '$user'
                                ");
                                $data = mysqli_fetch_assoc($result);
                                
                                // Cek Level
                            if($data['level'] == 'admin'){
                                $sql = mysqli_query($conn, "SELECT * FROM data_admin WHERE username = '$user'");
                                $admin = mysqli_fetch_assoc($sql);
                            ?>
                            
                            <div class="potition">
                                <div class="input">
                                    <span><i class="fas fa-id-card"></i></span>
                                    <label for="nama_admin">Nama</label>
                                </div>
                                <input type="text" name="nama_admin" id="nama_admin" class="form-control" value="<?php echo $admin['nama_admin'] ?>" maxlength="100" required>
                            </div>
                            
                            <div class="potition">
                                <div class="input">
                                    <span><i class="fas fa-id-card"></i></span>
                                    <label for="no_induk">Nomor Induk</label>
                                </div>
                                <input type="text" name="no_induk" id="no_induk" class="form-control" disabled="disabled" value="<?php echo $admin['no_induk'] ?>" maxlength="10" required>
                            </div>

                            <?php
                                }

                                elseif($data['level'] == 'user'){
                                    $sql = mysqli_query($conn, "SELECT * FROM tambah_siswa WHERE username = '$user'");
                                    $user = mysqli_fetch_assoc($sql);
                            ?>

                            <div class="potition">
                                <div class="input">
                                    <span><i class="fas fa-id-card"></i></span>
                                    <label for="nama_siswa">Nama</label>
                                </div>
                                <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" value="<?php echo $user['nama_siswa'] ?>" maxlength="100" required>
                            </div>

                            <div class="potition">
                                <div class="input">
                                    <span><i class="fas fa-id-card"></i></span>
                                    <label for="nis">NIS</label>
                                </div>
                                <input type="text" name="nis" id="nis" class="form-control" disabled="disabled" value="<?php echo $user['nis'] ?>" maxlength="15"> 
                            </div>
                            
                            <?php
                                    
                                }
                            ?>
                            
                            <!--                        -->
                            <!-- Memberikan Hidden ID -->
                            <!--                        -->

                            <input type="hidden" name="id" value = "<?= $data['id']; ?>">

                            <div class="potition">
                                <div class="input">
                                    <span><i class="fas fa-id-card"></i></span>
                                    <label for="username">Username</label>
                                </div>
                                <input type="text" name="username" id="username" class="form-control" value="<?php echo $data['username'] ?>" maxlength="10" required>
                            </div>
                            
                            <div class="potition">
                                <div class="input">
                                    <span><i class="fas fa-id-card"></i></span>
                                    <label for="password">Password</label>
                                </div>
                                <input type="text" name="password" id="password" class="form-control" value="<?php echo $data['password'] ?>" maxlength="10" required>
                            </div>
                            
                            <div class="potition">
                                <div class="input">
                                    <span><i class="fas fa-id-card"></i></span>
                                    <label for="level">Level</label>
                                </div>
                                <input type="text" name="level" id="level" class="form-control" disabled="disabled" value="<?php echo $data['level'] ?>" maxlength="10" required>
                            </div>

                            
                            <br>
                            <input class="button" type="submit" name="editUser" value="UBAH">
                    </div>
                </form>

            </div>
        </div>
    </main>
</body>
</html>