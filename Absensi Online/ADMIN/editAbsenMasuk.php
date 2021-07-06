<?php
session_start();

if(!isset($_SESSION['admin'])){
    header('location: ./ADMIN/login.php');
    exit;
}

require './function.php';

if(isset($_POST['simpanJamMasuk'])){

    if(simpanJamMasuk($_POST)>0){
            echo "<script>
                    alert('Jam Berhasil Diubah!');
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
            <h1>EDIT JAM MASUK</h1>
                <div class="form">
                    <form class="kelas" method="post" action="">
                        <?php                                   
                            $sql = mysqli_query($conn, "SELECT * FROM tb_pengaturan_absen");
                            $jam_masuk = mysqli_fetch_assoc($sql);
                        ?>

                        <div class="potition">
                            <div class="input">
                                <span><i class="far fa-clock"></i></span>
                                <label for="jam_masuk_awal">Jam Mulai</label>
                            </div>
                                <select name="jam_masuk_awal" id="jam_masuk_awal">
                                    <option><?php echo $jam_masuk['jam_masuk_awal']; ?></option>
                                    <?php
                                        for($jam = 1; $jam<=24; $jam++){     
                                    ?>
                                        <option value="<?php echo $jam; ?>"><?php echo $jam; ?></option>    
                                    <?php
                                        }
                                    ?>
                                </select>
                        </div>

                        <div class="potition">
                            <div class="input">
                                <span><i class="far fa-clock"></i></span>
                                <label for="jam_masuk_akhir">Jam selesai</label>
                            </div>
                                <select name="jam_masuk_akhir" id="jam_masuk_akhir">
                                    <option><?php echo $jam_masuk['jam_masuk_akhir'] ?></option>
                                    <?php
                                        for($jam = 1; $jam<=24; $jam++){     
                                    ?>
                                        <option value="<?php echo $jam; ?>"><?php echo $jam; ?></option>    
                                    <?php
                                        }
                                    ?>
                                </select>
                        </div>
                        
                        <br>
                        <div class="btn-edit">
                            <a class="kembali" href="./absenSiswa.php"><span>Kembali</span></a>
                            <input class="button simpan" type="submit" name="simpanJamMasuk" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>