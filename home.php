<?php
session_start();

if (!isset($_SESSION['username'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: login.php");
        exit();
    } elseif ($_SESSION['role'] == 'mahasiswa') {
        header("Location: loginMahasiswa.php");
        exit();
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Aplikasi Pembayaran Perkuliahan</title>
</head>

<body>
    <?php
    if ($_SESSION['role'] == 'admin') {
    ?>
        <nav class="navbar navbar-expand-md bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand ms-3 text-white" href="home.php">Halo, <?= $_SESSION['username']; ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse ms-3" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Data Master</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="dataMahasiswa.php">Data Mahasiswa</a></li>
                                <li><a class="dropdown-item" href="dataKelas.php">Data Kelas</a></li>
                                <li><a class="dropdown-item" href="dataProdi.php">Data Program Studi</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="dataAdmin.php">Data Admin</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="d-flex mt-4 justify-content-between">
                <h4>Data Pembayaran</h4>
                <a href="logoutService.php" class="btn btn-primary">Log Out</a>
            </div>
            <table class="table mt-4 ">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Biaya Masuk</th>
                        <th scope="col">Tanggal Pembayaran</th>
                        <!-- <th scope="col">Bukti Pembayaran</th> -->
                    </tr>
                </thead>
                <tbody class="data">
                </tbody>
            </table>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {

                getDataPembayaran();

                function getDataPembayaran() {
                    $.ajax({
                        url: "dataPembayaranGet.php",
                        type: "get",
                        success: function(response) {
                        
                            $('.data').html(response);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                }
            });
        </script>
    <?php
    } elseif ($_SESSION['role'] == 'mahasiswa') {
    ?>
        <div class="modal fade" id="insertPembayaran" tabindex="-1" aria-labelledby="insertPembayaranLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="insertPembayaranLabel">Tambah Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formInsertPembayaran">
                            <input hidden type="text" name="nama_mahasiswa" class="form-control" id="nama_mahasiswa" aria-describedby="inputMahasiswa">
                            <input hidden type="text" name="kelas" class="form-control" id="kelas" aria-describedby="inputKelas">
                            <div class="form-group mt-2">
                                <label for="inputKelas">Pembayaran</label>
                                <div class="input-group">
                                    <input type="number" name="biaya_masuk" id="biaya_masuk" aria-label="First name" class="form-control">
                                    <input type="number" disabled id="total_biaya" aria-label="Last name" class="form-control">
                                </div>
                            </div>
                            <!-- <div class="mb-3">
                                <label for="formFile" class="form-label">Default file input example</label>
                                <input class="form-control" type="file" id="formFile">
                            </div> -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="tambahDataPembayaran" class="btn btn-primary">Tambah Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-md bg-success">
            <div class="container-fluid">
                <a class="navbar-brand ms-3 text-white" href="home.php">Halo, <?= $_SESSION['username']; ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse ms-3" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="dataDiri.php">Data Diri</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="d-flex mt-4 justify-content-between align-items-center">
                <h4>Data Pembayaran</h4>
                <button type="submit" class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#insertPembayaran">Bayar SPP</button>
            </div>
            <table class="table mt-4 ">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Biaya Masuk</th>
                        <th scope="col">Tanggal Pembayaran</th>
                        <!-- <th scope="col">Bukti Pembayaran</th> -->
                    </tr>
                </thead>
                <tbody class="data">
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready(function() {
                var namaMahasiswa = `<?= $_SESSION['username'] ?>`;
                var results;
                const data = {
                    'nama_mahasiswa': namaMahasiswa,
                }
                const serialized = new URLSearchParams(data);
                getDataDiri();
                getDataPembayaran();

                function getDataPembayaran() {
                    $.ajax({
                        url: "dataPembayaranGet.php",
                        type: "post",
                        data: serialized.toString(),
                        success: function(response) {
                        
                            $('.data').html(response);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                }

                function getDataDiri() {

                    $.ajax({
                        url: "dataDiriGet.php",
                        type: "post",
                        data: serialized.toString(),
                        success: function(response) {
                            results = JSON.parse(response);
                            delete results.id_mahasiswa;
                            delete results.npm;

                            $('#nama_mahasiswa').val(results.nama_mahasiswa);
                            $('#kelas').val(results.kelas);
                            delete results.nama_mahasiswa;
                            delete results.kelas;
                            // console.log(results);
                            const getBiaya = new URLSearchParams(results);
                            getDataBiaya(getBiaya);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                }

                function getDataBiaya(prodi) {
                    $.ajax({
                        url: "dataBiayaGet.php",
                        type: "post",
                        data: prodi.toString(),
                        success: function(response) {
                            results = JSON.parse(response);
                            $('#total_biaya').val(results.biaya);
                            // console.log(results);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                }
                $("#tambahDataPembayaran").click(function() {
                    let values = $('#formInsertPembayaran').serialize();
                    console.log(values);
                    if ($('#biaya_masuk').val() == '') {
                        console.log('Biaya Kosong!');
                    } else {
                        $.ajax({
                            url: "dataPembayaranPost.php",
                            type: "post",
                            data: values,
                            success: function(response) {
                                console.log(response)
                                $('#insertPembayaran').modal('hide');
                                getDataPembayaran();
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
                            }
                        });
                    }
                });
            })
        </script>
    <?php
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>