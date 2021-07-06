<?php
session_start();

if(!isset($_SESSION['admin'])){
    header('location: ./ADMIN/login.php');
    exit;
}

require './function.php';

if(isset($_POST['btnsiswa'])){
    
    if(btnsiswa($_POST)>0){
        echo "<script>
                alert('Siswa baru berhasil ditambahkan !');
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
            <h1>ISI DATA SISWA</h1>
                <div class="form">
                    <form class="siswa" method="post" action="">
                        <div class="menu">
                            
                            <div class="left-menu">

                                <div class="potition">
                                    <div class="input">
                                        <span><i class="fas fa-id-card"></i></span>
                                        <label for="username">Username</label>
                                    </div>
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan Username Sesuai Login" maxlength="10" required>
                                </div>

                                <div class="potition">
                                    <div class="input">
                                        <span><i class="far fa-user"></i></span>
                                        <label for="nama_siswa">Nama</label>
                                    </div>
                                        <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" placeholder="Nama Siswa" maxlength="100" required>
                                </div>
                                
                                <div class="potition">
                                    <div class="input">
                                        <span><i class="far fa-sticky-note"></i></span>
                                        <label for="nis">NIS</label>
                                    </div>
                                        <input type="text" name="nis" id="nis" class="form-control" placeholder="NIS Siswa" maxlength="15" required>
                                </div>

                                <div class="potition">
                                    <div class="input">
                                        <span><i class="fas fa-user-graduate"></i></span>
                                        <label for="kelas_siswa">Pilih Kelas</label>
                                    </div>
                                        <?php                                   
                                            $kelas = mysqli_query($conn, "SELECT * FROM tambah_kelas ORDER BY kelas ASC");
                                        ?>
                                        <select name="kelas_siswa" id="kelas_siswa">
                                            <option disabled selected>Pilih Kelas</option>
                                            <?php        
                                                while($tampil = mysqli_fetch_assoc($kelas)){
                                            ?>
                                                <option value="<?php echo $tampil['kelas'] ?>"><?php echo $tampil['kelas'] ?></option>    
                                            <?php
                                                }
                                            ?>
                                        </select>
                                </div>

                                <div class="potition">
                                    <div class="input">
                                        <span><i class="fas fa-user-friends"></i></span>
                                        <label for="kelamin">Jenis Kelamin</label>
                                    </div>
                                        <select name="kelamin" id="kelamin">
                                            <option disabled selected>Pilih Jenis Kelamin</option>
                                            <option value="L">Laki-Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                </div>
                            
                            </div>
                            
                            <div class="right-menu">
                                
                                <div class="potition">
                                    <div class="input">
                                        <span><i class="fas fa-home"></i></span>
                                        <label for="alamat">Alamat</label>
                                    </div>
                                    <textarea name="alamat" id="alamat" cols="" rows="" placeholder="Alamat Siswa" required ></textarea>
                                </div>

                                <div class="potition">
                                    <div class="input">
                                        <span><i class="fas fa-map-marker-alt"></i></span>
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                    </div>
                                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Tempat Lahir Siswa" maxlength="20" required>
                                </div>
                                
                                <div class="potition">
                                    <div class="input">
                                        <span><i class="far fa-calendar-alt"></i></span>
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                    </div>
                                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
                                </div>

                            </div>

                        </div> <!-- Tutup class menu -->
                        <br>
                        <input class="button" type="submit" name="btnsiswa" value="Daftar">
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>