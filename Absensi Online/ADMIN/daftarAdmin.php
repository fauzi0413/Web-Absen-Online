<?php
session_start();

if(!isset($_SESSION['admin1'])){
    header('location: ../login.php');
    exit;
}

elseif(isset($_SESSION['admin'])){
    header('location: ./admin.php');
    exit;
}

require './function.php';

if(isset($_POST['daftarAdmin'])){
    
    if(daftarAdmin($_POST)>0){
        $_SESSION['admin'] = true;
        header("Location: admin.php");
        
        echo "<script>
                alert('Data berhasil ditambahkan !');
            </script>";
        }
        
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
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
            </div>
        </aside>

        <div class="container">
            <div class="card">
            <h1>ISI DATA ADMIN</h1>
            <div class="form">
                    <form class="form1" method="post" action="">
                        <div class="menu">
                            <div class="user-menu">

                                <div class="potition">
                                    <div class="input">
                                        <span><i class="fas fa-id-card"></i></span>
                                        <label for="username">Username</label>                        
                                    </div>
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan Username Sesuai Login" maxlength="10" required>
                                </div>

                                <div class="potition">
                                    <div class="input">
                                        <span><i class="fas fa-user"></i></span>
                                        <label for="nama_admin">Nama Admin</label>                        
                                    </div>
                                        <input type="text" name="nama_admin" id="nama_admin" class="form-control" placeholder="Masukkan Nama Admin" maxlength="100" required>
                                </div>

                                <div class="potition">
                                    <div class="input">
                                        <span><i class="far fa-sticky-note"></i></span>
                                        <label for="no_induk">Nomor Induk</label>                        
                                    </div>
                                        <input type="text" name="no_induk" id="no_induk" class="form-control" placeholder="Masukkan Nomor Induk" maxlength="15" required>
                                </div>
                                
                            </div>
                            
                        </div> <!-- div tutup punya class menu -->
                        <br>
                        <input class="button login" type="submit" name="daftarAdmin" value="Daftar">
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>