<?php
session_start();

if(!isset($_SESSION['admin'])){
    header('location: ./ADMIN/login.php');
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
            <h1>DATA USER</h1>
                <div class="data-user">
                    
                    <div class="print">
                        <a href="./cetak-user.php" class="button-print" target="_blank">Print</a>
                    </div>

                    <table class="table-user">
                        <tr class="judul">
                            <td class="nmr">No</td>
                            <td class="user">Username</td>
                            <td class="pass">Password</td>
                            <td class="level">Level</td>
                            <td><span><i class="fas fa-cog"></i></span></td>
                        </tr>  

                        <?php
                            $no = 0;

                            $result = mysqli_query($conn, "SELECT * FROM user ORDER BY level ASC");
                            while($data = mysqli_fetch_assoc($result)){
                                $no++
                        ?>
                        <tr>
                            <td class="nmr"><?php echo $no ?></td>
                            <td class="user"><?php echo $data['username'] ?></td>
                            <td class="pass"><?php echo $data['password'] ?></td>
                            <td class="level"><?php echo $data['level'] ?></td>
                            <td class="edit">
                                <span><a href=" ./detailUser.php?username=<?php echo $data['username']; ?>"><i class="far fa-eye"></i></a></span>
                                <span><a href="./editUser.php?username=<?php echo $data['username']; ?>"><i class="far fa-edit"></i></a></span>
                                <span><a href="./delete.php?username=<?php echo $data['username']; ?>"><i class="far fa-trash-alt"></i></a></span>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>