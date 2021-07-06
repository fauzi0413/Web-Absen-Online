<?php
session_start();

if(isset($_SESSION['login'])){
    header('location: ./ADMIN/admin.php');
    exit;
}

elseif(isset($_SESSION['user'])){
    header('location: ./USER/user.php');
    exit;
}

require './ADMIN/function.php';

if(isset($_POST['daftar'])){
    
    if(daftar($_POST)>0){
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
    <title>Login</title>
    <link rel="icon" href="./">
    <link rel="stylesheet" href="./CSS/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>DAFTAR</h1>
            <div class="form">

            <?php if(isset($error)) : ?>
                    <?php
                    echo "<script>
                            alert('username atau password salah, silahkan di cek kembali');
                        </script>"
                    ?>
            <?php endif; ?>

                <form class="form-border" method="post" action="">
                    <div class="potition">
                        <label for="username">Username</label>
                        <div class="input">
                            <span><i class="fas fa-user"></i></span>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" maxlength="10" required>
                        </div>
                    </div>

                    <div class="potition">
                        <label for="password">Password</label>
                        <div class="input">
                            <span><i class="fas fa-lock"></i></span>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" maxlength="10" required>
                        </div>
                    </div>

                    <div class="potition">
                        <label for="password2">Konfirmasi Password</label>
                        <div class="input">
                            <span><i class="fas fa-lock"></i></span>
                            <input type="password" name="password2" id="password2" class="form-control" placeholder="Konfirmasi Password" maxlength="10" required>
                        </div>
                    </div>

                    <br>
                    <input class="button login" type="submit" name="daftar" value="Sign Up">
                    <br>
                    <br>
                    <a href="./login.php">Login</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>