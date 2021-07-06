<?php
error_reporting(0);

require 'function.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <link rel="icon" href="./">
    <link rel="stylesheet" href="../CSS/style_user.css">
    <script>
        window.print();
    </script>
</head>
<body>
<div class="container">
            <div class="card-absen">
            <h1>DATA USER</h1>

                <div class="absen">
            
                    <table class="tableAbsen" border="1">
                            <tr class="judul">
                                <td class="">No</td>
                                <td class="">Nama</td>
                                <td class="">Nomor Induk</td>
                                <td class="">Username</td>
                                <td class="">Password</td>
                                <td class="">Level</td>
                            </tr>

                        <?php
                            $user = $_GET['username'];

                            // Cek Level
                            $result = mysqli_query($conn, "SELECT * FROM user ORDER BY level ASC");
                            $no = 0;

                            while($data = mysqli_fetch_assoc($result)){
                                $no++;
                                $user = $data['username'];
                        ?>
                        <tr class="daftar-absen">
                            <td class="nmr"><?php echo $no ?></td>
                            
                            <?php
                                if($data['level'] == 'admin'){
                                    $sql = mysqli_query($conn, "SELECT * FROM data_admin WHERE username = '$user' ");
                                    $admin = mysqli_fetch_assoc($sql);
                            ?> 
                                <td class=""><?php echo $admin['nama_admin'] ?></td>
                                <td class="pass"><?php echo $admin['no_induk'] ?></td>
                            <?php
                                }
                                elseif($data['level'] == 'user'){
                                    $sql = mysqli_query($conn, "SELECT * FROM tambah_siswa WHERE username = '$user' ");
                                    $user = mysqli_fetch_assoc($sql);
                            ?>
                                <td class=""><?php echo $user['nama_siswa'] ?></td>
                                <td class="pass"><?php echo $user['nis'] ?></td>
                            <?php } ?>

                            <td class="level"><?php echo $data['username'] ?></td>
                            <td class="pass"><?php echo $data['password'] ?></td>
                            <td class="level"><?php echo $data['level'] ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
</body>
</html>