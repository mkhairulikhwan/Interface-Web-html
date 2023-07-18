<?php 
include 'koneksi.php'; 

$query = 'SELECT * FROM tb_siswa;';
$sql = mysqli_query($conn, $query);
$no = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- font awesome -->
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" />

    <title>Belajar CRUD</title>
</head>

<body>
    <nav class="navbar bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"> CRUD - Bootstrap 5 </a>
        </div>
    </nav>
    <!-- Judul -->
    <div class="container">
        <h1 class="mt-4">Data Siswa</h1>
        <figure>
            <blockquote class="blockquote">
                <p>Berisi Data Yang Telah Disimpan di Database.</p>
            </blockquote>
            <figcaption class="blockquote-footer">CRUD <cite title="Source Title">(Create Read Update Delete)</cite>
            </figcaption>
        </figure>
        <a href="kelola.php" type="button" class="btn btn-primary mb-2">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Tambah Data
        </a>
        <div class="table-responsive mt-3">
            <table class="table align-middle table-bordered table-hover">
                <thead>
                    <tr>
                        <th>
                            <center>No.</center>
                        </th>
                        <th>Nisn</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>Foto Siswa</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                      while($result = mysqli_fetch_assoc($sql)){
                    ?>
                    <tr>
                        <td>
                            <center><?php echo ++$no; ?></center>
                        </td>
                        <td><?php echo $result['nisn']; ?></td>
                        <td><?php echo $result['nama_siswa']; ?></td>
                        <td><?php echo $result['jenis_kelamin']; ?></td>
                        <td>
                            <img src="img/<?php echo $result['foto_siswa']; ?>" style="width: 100px" />
                        </td>
                        <td><?php echo $result['alamat']; ?></td>
                        <td>
                            <a href="kelola.php?ubah=
                            <?php 
                            echo $result['id_siswa']; ?>" type="button" class="btn btn-success btn-sm">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="proses.php?hapus=
                            <?php 
                            echo $result['id_siswa']; ?>" type="button" class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah anda yakin ingin menghapus data tersebut???')">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>