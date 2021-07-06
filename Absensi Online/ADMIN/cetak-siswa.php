<?php

require 'function.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link rel="icon" href="./">
    <link rel="stylesheet" href="../CSS/style_admin.css">
    <link rel="stylesheet" href="../CSS/style_user.css">
    <script>
        window.print();
    </script>
</head>
<body>
        <div class="card-print">
        <h1>DATA SISWA</h1>

            <div class="cetak absen">
        
                <table class="tableAbsen" border="1">
                        <tr class="judul">
                            <td class="">No</td>
                            <td class="">Nama Siswa</td>
                            <td class="">Nomor Induk Siswa</td>
                            <td class="">Kelas</td>
                            <td class="">Kelamin</td>
                            <td class="">Alamat</td>
                            <td class="">Tanggal Lahir</td>
                            <td class="">Tempat Lahir</td>
                        </tr>

                    <?php
                        // Cek Level
                        $no = 0;
                        $result = mysqli_query($conn, "SELECT * FROM tambah_siswa");
                        
                        while($data = mysqli_fetch_assoc($result)){
                            $no++;
                            
                            $kelamin = $data['kelamin'];
                                if($kelamin == 'L'){
                                    $data['kelamin'] = "Laki-laki";
                                }
                                elseif($kelamin == 'P'){
                                    $data['kelamin'] = "Perempuan";
                                }
                    ?>
                    <tr class="daftar-absen">
                        <td class="nmr"><?php echo $no ?></td>
                        <td class="nmr"><?php echo $data['nama_siswa'] ?></td>
                        <td class="nmr"><?php echo $data['nis'] ?></td>
                        <td class="nmr"><?php echo $data['kelas_siswa'] ?></td>
                        <td class="nmr"><?php echo $data['kelamin'] ?></td>
                        <td class="nmr"><?php echo $data['alamat'] ?></td>
                        <td class="nmr"><?php echo $data['tempat_lahir'] ?></td>
                        <td class="nmr"><?php echo $data['tanggal_lahir'] ?></td>
                        <?php } ?>
                </table>
                
            </div>
        </div>
</body>
</html>