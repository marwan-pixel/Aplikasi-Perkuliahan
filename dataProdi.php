<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit;
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

    <div class="modal fade" id="insertProdi" tabindex="-1" aria-labelledby="insertProdiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="insertProdiLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formInsertProdi">
                        <div class="form-group">
                            <label for="inputProdi">Nama Program Studi</label>
                            <input type="text" name="nama_prodi" class="form-control" id="nama_prodi" aria-describedby="inputProdi">
                            <small id="nama_prodi-error" class="text-danger"></small>
                        </div>
                        <div class="form-group mt-2">
                            <label for="inputBiaya">Biaya</label>
                            <input type="number" name="biaya" class="form-control" id="biaya" aria-describedby="inputBiaya">
                            <small id="biaya-error" class="text-danger"></small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="tambahDataProdi" class="btn btn-primary">Tambah Data</button>
                        </div>
                        <input type="text" name="crud" id="crud" value="insert" hidden>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateProdi" tabindex="-1" aria-labelledby="updateProdiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="insertAdminLabel">Ubah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formUpdateProdi">
                        <input hidden type="number" name="id_prodi" id="id_prodi">
                        <div class="form-group">
                            <label for="inputProdi">Nama Program Studi</label>
                            <input type="text" name="nama_prodi_update" class="form-control" id="nama_prodi_update" aria-describedby="inputProdi">
                            <small id="nama_prodi_update-error" class="text-danger"></small>
                        </div>
                        <div class="form-group mt-2">
                            <label for="inputBiaya">Biaya</label>
                            <input type="number" name="biaya_update" class="form-control" id="biaya_update" aria-describedby="inputBiaya">
                            <small id="biaya_update-error" class="text-danger"></small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="ubahDataProdi" class="btn btn-primary">Ubah Data</button>
                        </div>
                        <input type="text" name="crud" id="crud" value="update" hidden>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Confirm Delete-->
    <div class="modal fade" id="deleteConfirmProdi" tabindex="-1" aria-labelledby="deleteConfirmProdiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteConfirmProdiLabel">Konfirmasi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>
                    <button type="button" class="btn modalDelete btn-danger text-white">Iya</button>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-md bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand ms-3 text-white" href="home.php">Halo, <?= $_SESSION['username'] ;?></a>
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

        <h4 class="mt-4">Data Program Studi</h4>
        <button type="submit" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#insertProdi">Tambah Data</button>
        <table class="table mt-3" id="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Program Studi</th>
                    <th scope="col">Biaya</th>
                    <th scope="col">Pengaturan</th>
                </tr>
            </thead>
            <tbody class="data">

            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
<script type="text/javascript">
    var idProdi;
    $(document).ready(function() {
        getDataProdi();

        $("#tambahDataProdi").click(function() {
            let values = $('#formInsertProdi').serialize();
            console.log(values);
            if ($('#nama_prodi').val() == '') {
                console.log('Nama Kosong!');
            } else if ($('#biaya').val() == '') {
                console.log('Biaya Kosong!');
            } else {
                $.ajax({
                    url: "dataProdiPost.php",
                    type: "post",
                    data: values,
                    success: function(response) {
                        $('#insertProdi').modal('hide');
                        getDataProdi();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        });

        $('#updateProdi').on('show.bs.modal', function(event) {

            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            console.log(div.data(`id_prodi`))
            console.log(div.data(`nama_prodi`))
            console.log(div.data(`biaya`))
            // Isi nilai pada field
            modal.find(`#id_prodi`).attr("value", div.data(`id_prodi`));
            modal.find(`#nama_prodi_update`).attr("value", div.data(`nama_prodi`));
            modal.find(`#biaya_update`).attr("value", div.data(`biaya`));
        });

        $("#ubahDataProdi").click(function() {
            let values = $('#formUpdateProdi').serialize();
            console.log(values)
            if ($('#nama_prodi_update').val() == '') {
                console.log('Nama Kosong!');
            } else if ($('#biaya_update').val() == '') {
                console.log('Biaya Kosong!');
            } else {
                $.ajax({
                    url: "dataProdiPost.php",
                    type: "post",
                    data: values,
                    success: function(response) {
                        $('#updateProdi').modal('hide');
                        getDataProdi();
                        // clearInput();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        });

        $('#table').on('click', '#hapusDataProdi', function(event) {
            event.preventDefault();
            idProdi = $(this).data('id_prodi');
            $('#deleteConfirmProdi').modal('show');
        });

        $('.modalDelete').click(function() {
            const data = {
                'id_prodi': idProdi,
                'crud': 'delete'
            }
            const serialized = new URLSearchParams(data)
            $.ajax({
                url: "dataProdiPost.php",
                type: "post",
                data: serialized.toString(),
                success: function(response) {
                    $('#deleteConfirmProdi').modal('hide');
                    getDataProdi();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        function getDataProdi() {
            $.ajax({
                url: "dataProdiGet.php",
                type: "get",
                success: function(response) {
                    console.log(response);
                    $('.data').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function clearInput() {
            $('#id_prodi').val('');
            $('#nama_prodi_update').val('');
            $('#biaya_update').val('');
            $('#nama_prodi').val('');
            $('#biaya_update').val('');
        }
    });
</script>
</html>