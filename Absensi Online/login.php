<?php
session_start();

if(isset($_SESSION['admin'])){
    header('location: ./ADMIN/admin.php');
    exit;
}

elseif(isset($_SESSION['admin1'])){
    header('location: ./ADMIN/daftarAdmin.php');
    exit;
}

elseif(isset($_SESSION['daftar'])){
    header('location: ./USER/daftar.php');
    exit;
}

elseif(isset($_SESSION['user'])){
    header('location: ./USER/user.php');
    exit;
}


require './ADMIN/function.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND password = '$password' ");
    $level = mysqli_fetch_assoc($result);
    // Cek Username dan password
    if ( mysqli_num_rows($result) === 1 ){
        // set session
        if ($level['level'] == 'admin'){
            $username = $_POST['username'];

            $cek = mysqli_query($conn, "SELECT * FROM data_admin WHERE username = '$username' ");
            $name = mysqli_fetch_assoc($cek);

            if(mysqli_num_rows($cek) === 0 ){
                $_SESSION['admin1'] = true;
                $_SESSION['nama'] = strtoupper($level['username']);
                $_SESSION['level'] = 'admin';

                header("location: ./ADMIN/daftarAdmin.php");
                exit;
            }
            elseif(mysqli_num_rows($cek) === 1 ){
                $_SESSION['admin'] = true;
                $_SESSION['nama'] = strtoupper($level['username']);
                $_SESSION['level'] = 'admin';

                header("location: ./ADMIN/admin.php");
                exit;
            }
        }
        elseif ($level['level'] == 'user'){
            $username = $_POST['username'];

            $cek = mysqli_query($conn, "SELECT * FROM tambah_siswa WHERE username = '$username' ");
            $name = mysqli_fetch_assoc($cek);

            if(mysqli_num_rows($cek) === 0 ){
                $_SESSION['daftar'] = true;
                $_SESSION['nama'] = strtoupper($level['username']);
                $_SESSION['level'] = 'user';

                header("location: ./USER/daftar.php");
                exit;
            }
            elseif(mysqli_num_rows($cek) === 1 ){
                $_SESSION['user'] = true;
                $_SESSION['nama'] = strtoupper($name['username']);
                $_SESSION['level'] = 'user';
                
                header("location: ./USER/user.php");
                exit;
            }
        }
    }

    $error = true;
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
            <h1>LOGIN</h1>
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
                        <label>Username</label>
                        <div class="input">
                            <span><i class="fas fa-user"></i></span>
                            <input type="text" name="username" class="form-control" placeholder="Username" maxlength="10">
                        </div>
                    </div>

                    <div class="potition">
                        <label>Password</label>
                        <div class="input">
                            <span><i class="fas fa-lock"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Password" maxlength="10">
                        </div>
                    </div>
                    <br>
                    <input class="button login" type="submit" name="login" value="Sign In">
                    <br>
                    <br>
                    <a href="./signup.php">Daftar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>