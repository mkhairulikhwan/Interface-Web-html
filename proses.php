<?php 
include 'koneksi.php'; 

if(isset($_POST['aksi'])){
    if($_POST['aksi'] =="add"){
                
        $nisn = $_POST['nisn'];
        $nama_siswa = $_POST['nama_siswa'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $foto = $_FILES['foto']['name'];
        $alamat = $_POST['alamat'];

        $dir = "img/";
        $tmpfile = $_FILES['foto']['tmp_name'];
        
        move_uploaded_file($tmpfile, $dir.$foto);
        
        //die();
        
        $query = "INSERT INTO tb_siswa VALUES(null, '$nisn', '$nama_siswa', '$jenis_kelamin', '$foto', '$alamat')";
        $sql = mysqli_query($conn, $query);
        
        if($sql){
            header("Location: index.php");
            //echo "Data Berhasil Ditambahkan <a href='index.php'>[Home]</a>";
        } else {
            echo $query;
        }
        
        //echo $nisn." | ".$nama_siswa." | ".$jenis_kelamin." | ".$foto." | ".$alamat;

        //echo "<br>Tambah Data <a href='index.php'>[Home]</a>";
    } else if ($_POST['aksi'] =="edit"){
    //echo "Edit Data <a href='index.php'>[Home]</a> ";
    //var_dump($_POST);
    $id_siswa = $_POST['id_siswa'];
    $nisn = $_POST['nisn'];
    $nama_siswa = $_POST['nama_siswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];

    $queryShow = "SELECT * FROM tb_siswa WHERE id_siswa = '$id_siswa';";
    $sqlShow = mysqli_query($conn, $queryShow);
    $result = mysqli_fetch_array($sqlShow);
    
    if($_FILES['foto']['name'] == ""){
        $foto = $result['foto_siswa'];
    } else {
        $foto = $_FILES['foto']['name'];
        unlink("img/".$result['foto_siswa']);
        move_uploaded_file($_FILES['foto']['tmp_name'], 'img/'.$result['foto']['name']);
    }

    $query = "UPDATE tb_siswa SET nisn='$nisn', nama_siswa='$nama_siswa', jenis_kelamin='$jenis_kelamin', alamat='$alamat' foto_siswa='$foto' WHERE id_siswa='$id_siswa';";
    $sql = mysqli_query($conn, $query);
    header("Location: index.php");
    }
}
if(isset($_GET['hapus'])){
    $id_siswa = $_GET['hapus'];

    $queryShow = "SELECT * FROM tb_siswa WHERE id_siswa = '$id_siswa';";
    $sqlShow = mysqli_query($conn, $queryShow);
    $result = mysqli_fetch_array($sqlShow);
    
    //var_dump($result);
    unlink("img/".$result['foto_siswa']);
    
    $query = "DELETE FROM tb_siswa WHERE id_siswa = '$id_siswa';";
    $sql = mysqli_query($conn, $query);

    if($sql){
        header("Location: index.php");
        //echo "Data Berhasil Ditambahkan <a href='index.php'>[Home]</a>";
    } else {
        echo $query;
    }
    //echo "Hapus Data <a href='index.php'>[Home]</a> ";
}
?>