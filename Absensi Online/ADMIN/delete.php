<?php

require './function.php';

$user = $_GET['username'];

if( hapusSiswa($user) > 0){

    echo "<script>
            alert('Data Berhasil Dihapus!!');
        </script>";
}
else{
    echo mysqli_error($conn);
}

header("location:dataSiswa.php");

if( hapusUser($user) > 0 ){
    echo "<script>
            alert('Data Berhasil Dihapus!!');
        </script>";
}
else{
    echo mysqli_error($conn);
};

header("location:dataUser.php");


?>