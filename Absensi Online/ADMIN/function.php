<?php

// Koneksi ke database
$conn = mysqli_connect('localhost','root','','data_login');


//          
// Fungsi DELETE USER & Data Siswa
//

function hapusUser($user){
    global $conn;

    $sql = mysqli_query($conn, "DELETE FROM user WHERE username = '$user' ");

    $sql2 = mysqli_query($conn, "DELETE FROM tambah_siswa WHERE username = '$user' ");

    $sql3 = mysqli_query($conn, "DELETE FROM tb_absen WHERE username = '$user' ");

    return mysqli_affected_rows($conn);
}


//          
// Akhir Fungsi DELETE USER & Data Siswa
//




//          
// Fungsi DELETE Data Siswa
//

function hapusSiswa($user){
    global $conn;


    $sql2 = mysqli_query($conn, "DELETE FROM tambah_siswa WHERE username = '$user' ");
    
    $sql3 = mysqli_query($conn, "DELETE FROM tb_absen WHERE username = '$user' ");

    return mysqli_affected_rows($conn);
}


//          
// Akhir Fungsi DELETE Data Siswa
//





//          
// Fungsi Menu Daftar User
//
function daftar($data){
    global $conn;
        
    $username = htmlspecialchars(strtolower(stripslashes($data['username'])));
    $password = htmlspecialchars(mysqli_real_escape_string($conn, $data['password']));
    $password2 = htmlspecialchars(mysqli_real_escape_string($conn, $data['password2']));

    // Validasi Data
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $pass2 = $_POST['password2'];

    if($user == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !');
            </script>";
    }
    
    elseif($pass == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !');
            </script>";}
    
    elseif($pass2 == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !');
            </script>";}
    else {
        // Cek Username sudah ada atau belum
        $result = mysqli_query($conn, "SELECT username FROM user WHERE username='$user' ");
    
        if(mysqli_fetch_assoc($result)){
            echo "<script>
                    alert('Username sudah terdaftar !!');
                </script>";
    
            return false; /* Fungsinya untuk memberhentikan function nya */
        }
    
        // Cek Konfirmasi Password
        if ($pass !== $pass2){
            echo "<script>
                    alert('Konfirmasi Password tidak sesuai !!');
                </script>";
    
            return false;
        }

        // Masukkan Nilai level
        $sql = mysqli_query($conn, "SELECT level FROM user");
        $sqllevel = mysqli_fetch_assoc($sql);
        $level = $sqllevel['level'] =   'user';

        
    mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password','$level')");

    return mysqli_affected_rows($conn);
    
    }
}

//          
// Akhir Fungsi Menu Daftar
//


//          
// Fungsi registrasi di TAMBAH USER
// 

function registrasi($data){
    global $conn;
    
    $username = htmlspecialchars(strtolower(stripslashes($data['username'])));
    $password = htmlspecialchars(mysqli_real_escape_string($conn, $data['password']));
    $password2 = htmlspecialchars(mysqli_real_escape_string($conn, $data['password2']));
    $level = ($data['level']);
    
    // Validasi data
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $pass2 = $_POST['password2'];
    $level = $_POST['level'];

    if($user == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !');
            </script>";
    }
    
    elseif($pass == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !');
            </script>";}

    elseif ($pass2 == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !');
            </script>";}

    elseif ($level == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !');
            </script>";}

    else{

    // Cek Username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username='$username' ");

    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('Username sudah terdaftar');
            </script>";

        return false; /* Fungsinya untuk memberhentikan function nya */
    }

    // Cek Konfirmasi Password
    if ($password !== $password2){
        echo "<script>
                alert('Konfirmasi Password tidak sesuai !');
            </script>";

        return false;
    }

    // enkripsi password menggunakan password_hash
    // Fungsi password_hash adalah mengacak sebuah string menggunakan algoritma enkripsi tertentu
    
    // $password = password_hash($password, PASSWORD_DEFAULT);
    
    // Tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password','$level')");

     // Fungsi mysqli_affected_rows adalah mengembalikan fungsi jumlah baris yang terkena dampak di SELECT, INSERT, UPDATE dan yang lain sebelumnya
    return mysqli_affected_rows($conn);
    
    }
};

// 
// Akhir fungsi registrasi
// 


// 
// Fungsi btnKelas di TAMBAH KELAS
// 

function btnkelas($data){
    global $conn;

    $kelas = strtoupper($data['kelas']);

    // Validasi Data
    
    if($kelas == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !');
            </script>";  }
    
    else{

        // Cek Nama Jurusan
        $result = mysqli_query($conn, "SELECT kelas FROM tambah_kelas WHERE kelas='$kelas' ");

        if(mysqli_fetch_assoc($result)){
            echo "<script>
                    alert('Kelas sudah terdaftar!!');
                </script>";

            return false;
        }

        // Tambah Kelas
            mysqli_query($conn, "INSERT INTO tambah_kelas VALUES('','$kelas') ");
            
            return mysqli_affected_rows($conn);
    }
};

// 
// Akhir fungsi btnKelas di TAMBAH KELAS
// 



// 
// Fungsi tambahSiswa di TAMBAH SISWA
// 

function btnsiswa($siswa){
    global $conn;

    $username = htmlspecialchars($siswa['username']);
    $nama_siswa = htmlspecialchars(strtoupper($siswa['nama_siswa']));
    $nis = htmlspecialchars($siswa['nis']); 
    $kelas_siswa = htmlspecialchars($siswa['kelas_siswa']);
    $kelamin = htmlspecialchars($siswa['kelamin']);
    $alamat = htmlspecialchars($siswa['alamat']);
    $tempat = htmlspecialchars(strtoupper($siswa['tempat_lahir']));
    $tanggal = htmlspecialchars($siswa['tanggal_lahir']);

    // Validasi Data
    
    if ($nama_siswa == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !!');
            </script>";
    }
    elseif($username == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !!');
            </script>";
    }
    elseif($nis == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !!');
            </script>";
    }
    elseif($kelas_siswa == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !!');
            </script>";
    }
    elseif($kelamin == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !!');
            </script>";
    }
    elseif($alamat == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !!');
            </script>";
    }
    elseif($tempat == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !!');
            </script>";
    }
    elseif($tanggal == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !!');
            </script>";
    }
    else{
        // Cek NIS Siswa
        $result = mysqli_query($conn, "SELECT nis FROM tambah_siswa WHERE nis='$nis' ");

        if(mysqli_fetch_assoc($result)){
            echo "<script>
                    alert('Nomor NIS sudah terdaftar!!');
                </script>";

            return false;
        }

        mysqli_query($conn, "INSERT INTO tambah_siswa VALUES ('','$username','$nama_siswa','$nis','$kelas_siswa','$kelamin','$alamat','$tempat','$tanggal') ");

        return mysqli_affected_rows($conn);
    }
};


// 
// Akhir fungsi tambahSiswa di TAMBAH SISWA
// 



// 
// Fungsi Daftar ADMIN di ADMIN
// 


function daftarAdmin($data){
    global $conn;

    $username = ($data['username']);
    $nama_admin = strtoupper($data['nama_admin']);
    $no_induk = ($data['no_induk']); 

    // Validasi Data
    
    if($nama_admin == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !');
            </script>";  
    }

    elseif($username == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !!');
            </script>";
    }

    elseif($no_induk == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !!');
            </script>";
    }
    
    else{

        // Cek No Induk
        $result = mysqli_query($conn, "SELECT no_induk FROM data_admin WHERE no_induk='$no_induk' ");

        if(mysqli_fetch_assoc($result)){
            echo "<script>
                    alert('Nomor Induk sudah terdaftar!!');
                </script>";

            return false;
        }


        // Tambah Data
            mysqli_query($conn, "INSERT INTO data_admin VALUES('','$username','$nama_admin','$no_induk') ");
            
            return mysqli_affected_rows($conn);
    }
};


// 
// Akhir Fungsi Daftar ADMIN di ADMIN
// 




// 
// Fungsi Edit User di ADMIN
// 

function editUser($data){
    global $conn;

    // $id = ($data['id']);
    $username = ($data['username']);
    $password = ($data['password']);
    $level = ($data['level']);
    $nama_admin = strtoupper($data['nama_admin']);
    $no_induk = ($data['no_induk']);
    $nama_siswa = strtoupper($data['nama_siswa']);
    $nis = ($data['nis']);

    
    // Validasi Data

    if($username == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !!');
            </script>";
    }

    elseif($password == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !!');
            </script>";
    }

    // Update Data User

    mysqli_query($conn, "UPDATE user SET username = '$username', password = '$password' WHERE username = '$username' ");
        
    mysqli_query($conn, "UPDATE data_admin SET username = '$username', nama_admin = '$nama_admin' WHERE username = '$username' ");
    
    mysqli_query($conn, "UPDATE tambah_siswa SET username = '$username', nama_siswa = '$nama_siswa' WHERE username = '$username' ");

    mysqli_query($conn, "UPDATE tb_absen SET username = '$username' WHERE username = '$username' ");
    
    
    return mysqli_affected_rows($conn);

};


// 
// Akhir Fungsi Edit User di ADMIN
// 



// 
// Fungsi editSiswa di EDIT DATA SISWA
// 

function editSiswa($siswa){
    global $conn;

    $username = htmlspecialchars($siswa['username']);
    $nama_siswa = (strtoupper($siswa['nama_siswa']));
    $kelas_siswa = ($siswa['kelas_siswa']);
    $kelamin = ($siswa['kelamin']);
    $alamat = htmlspecialchars($siswa['alamat']);
    $tempat = htmlspecialchars(strtoupper($siswa['tempat_lahir']));
    $tanggal = htmlspecialchars($siswa['tanggal_lahir']);

    // Validasi Data
    
    if ($nama_siswa == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !!');
            </script>";
    }
    elseif($username == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !!');
            </script>";
    }
    elseif($kelas_siswa == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !!');
            </script>";
    }
    elseif($kelamin == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !!');
            </script>";
    }
    elseif($alamat == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !!');
            </script>";
    }
    elseif($tempat == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !!');
            </script>";
    }
    elseif($tanggal == ""){
        echo "<script>
                alert('Terdapat data kosong, harap isi semua data !!');
            </script>";
    }
    else{

        // Ubah data kelamin
        
        if($kelamin == 'Laki-laki'){
            $kelamin = "L";
        } 
        elseif($kelamin == 'perempuan'){
            $kelamin = "P";
        }

        mysqli_query($conn, "UPDATE tambah_siswa SET
        username = '$username',
        nama_siswa = '$nama_siswa',
        kelas_siswa = '$kelas_siswa',
        kelamin = '$kelamin',
        alamat = '$alamat',
        tempat_lahir = '$tempat',
        tanggal_lahir = '$tanggal'
        WHERE username = '$username'
        ");

        return mysqli_affected_rows($conn);
    }
};


// 
// Akhir fungsi editSiswa di EDIT DATA SISWA
// 





// 
// Fungsi waktu di MENU ABSEN USER
// 

date_default_timezone_set("Asia/Jakarta");

// N -> untuk menyebutkan hari dalam angka|senin=1...minggu=7
// j -> untuk menyebutkan tanggal dalam angka
// n -> untuk menyebutkan bulan dalam angka
// Y -> untuk menyebutkan tahun dalam angka
// H.i.s untuk menyebutkan jam(H), menit(i), detik(s)

$waktu_lengkap = date('N j/n/Y');

function tanggal_indonesia($waktu_lengkap){
    $nama_hari = array( 1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu');
    $nama_bulan = array( 1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                                'September', 'Oktober', 'November', 'Desember');

    // Fungsi explode untuk memisah data menjadi beberapa array sesuai tanda contohnya spasi dan garis miring
    $pisah_waktu = explode(" ",$waktu_lengkap);
    $hari = $pisah_waktu[0];
    $tanggal = $pisah_waktu[1];

    $hari_baru = $nama_hari[$hari];
    $pisah_tanggal = explode("/",$tanggal); 
    $tanggal_baru = $pisah_tanggal[0]." ".$nama_bulan[$pisah_tanggal[1]]." ".$pisah_tanggal[2];

    return $hari_baru.", ".$tanggal_baru;
}


// 
// Akhir Fungsi waktu di MENU ABSEN USER
// 






// 
// Fungsi Absen Masuk User
// 

function absenMasuk($data){
global $conn;                         
    
    $sql = mysqli_query($conn, "SELECT * FROM tb_pengaturan_absen");
    $jam_masuk = mysqli_fetch_assoc($sql);

    $username = $_SESSION['nama'];
    $masuk = $data['waktu-masuk'];

    // Pisah data waktu masuk
    $pisah_waktu = explode(" ",$masuk);    
    $hari = $pisah_waktu[0];
    $tanggal = $pisah_waktu[1];
    $waktu = $pisah_waktu[2];

    // Pisah data untuk mengambil data jam
    $jam_lengkap = explode(":",$waktu);
    $jam = $jam_lengkap[0];

    if($jam < $jam_masuk['jam_masuk_awal']){
        echo "<script>
                alert('Belum Bisa Absen Awal!!');
            </script>";
    }
    elseif( ($jam >= $jam_masuk['jam_masuk_awal']) && ($jam < $jam_masuk['jam_masuk_akhir']) ){
        $status = "Tepat Waktu";
        mysqli_query($conn, "INSERT INTO tb_absen VALUE('','$username','$masuk', '', '$status') ");
    }
    elseif ($jam >= $jam_masuk['jam_masuk_akhir']){
        $status = "Terlambat";
        mysqli_query($conn, "INSERT INTO tb_absen VALUE('','$username','$masuk', '', '$status') ");
    }
}

// 
// Akhir Fungsi Absen Masuk User
// 




// 
// Fungsi Absen Pulang User
// 

function absenPulang($data){
global $conn;

    $sql = mysqli_query($conn, "SELECT * FROM tb_pengaturan_absen");
    $jam_pulang = mysqli_fetch_assoc($sql);

    $username = $_SESSION['nama'];
    $pulang = $data['waktu-pulang'];

    // Pisah data waktu masuk
    $pisah_waktu = explode(" ",$pulang);    
    $hari = $pisah_waktu[0];
    $tanggal = $pisah_waktu[1];
    $waktu = $pisah_waktu[2];

    // Pisah data untuk mengambil data jam
    $jam_lengkap = explode(":",$waktu);
    $jam = $jam_lengkap[0];
    
    if($jam < $jam_pulang['jam_pulang_awal']){
    }
    elseif( ($jam >= $jam_pulang['jam_pulang_awal']) && ($jam < $jam_pulang['jam_pulang_akhir']) ){
        mysqli_query($conn, "UPDATE tb_absen SET datetime_keluar = '$pulang' WHERE id = (SELECT MAX(id) FROM tb_absen) ");
    }
    elseif ($jam >= $jam_pulang['jam_pulang_akhir']){
        mysqli_query($conn, "UPDATE tb_absen SET datetime_keluar = '$pulang' WHERE id = (SELECT MAX(id) FROM tb_absen) ");
    }

}

// 
// Akhir Fungsi Absen Pulang User
// 






// 
// Fungsi simpanJamMasuk
// 


function simpanJamMasuk($jam){
    global $conn;

    $jam_masuk_awal = $jam['jam_masuk_awal'];
    $jam_masuk_akhir = $jam['jam_masuk_akhir'];

    mysqli_query($conn, "UPDATE tb_pengaturan_absen SET jam_masuk_awal = '$jam_masuk_awal', jam_masuk_akhir = '$jam_masuk_akhir' ");
    
    return mysqli_affected_rows($conn);
}


// 
// Akhir Fungsi simpanJamMasuk
// 





// 
// Fungsi simpanJamPulang
// 


function simpanJamPulang($jam){
    global $conn;

    $jam_pulang_awal = $jam['jam_pulang_awal'];
    $jam_pulang_akhir = $jam['jam_pulang_akhir'];

    mysqli_query($conn, "UPDATE tb_pengaturan_absen SET jam_pulang_awal = '$jam_pulang_awal', jam_pulang_akhir = '$jam_pulang_akhir' ");
    
    return mysqli_affected_rows($conn);
}


// 
// Akhir Fungsi simpanJamPulang
// 

?>