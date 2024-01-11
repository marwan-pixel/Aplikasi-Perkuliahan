<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<html lang="en">

<div class="modal fade" id="insertKelas" tabindex="-1" aria-labelledby="insertKelasLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="insertKelasLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formInsertKelas">
                    <div class="form-group">
                        <label for="inputKelas">Nama Kelas</label>
                        <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" aria-describedby="inputKelas">
                        <small id="nama_kelas-error" class="text-danger"></small>
                    </div>
                    <div class="form-group mt-2">
                        <label for="inputProdi">Program Studi</label>
                        <input type="text" name="prodi" class="form-control" id="prodi" aria-describedby="inputProdi">
                        <small id="prodi-error" class="text-danger"></small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="tambahDataKelas" class="btn btn-primary">Tambah Data</button>
                    </div>
                    <input type="text" name="crud" id="crud" value="insert" hidden>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateKelas" tabindex="-1" aria-labelledby="updateKelasLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateKelasLabel">Ubah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formUpdateKelas">
                    <input hidden type="number" name="id_kelas" id="id_kelas">
                    <div class="form-group">
                        <label for="inputKelas">Nama Kelas</label>
                        <input type="text" name="nama_kelas_update" class="form-control" id="nama_kelas_update" aria-describedby="inputKelas">
                        <small id="nama_kelas_update-error" class="text-danger"></small>
                    </div>
                    <div class="form-group mt-2">
                        <label for="inputProdi">Program Studi</label>
                        <input type="text" name="prodi_update" class="form-control" id="prodi_update" aria-describedby="inputProdi">
                        <small id="prodi_update-error" class="text-danger"></small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="ubahDataKelas" class="btn btn-primary">Ubah Data</button>
                    </div>
                    <input type="text" name="crud" id="crud" value="update" hidden>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirm Delete-->
<div class="modal fade" id="deleteConfirmKelas" tabindex="-1" aria-labelledby="deleteConfirmKelasLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteConfirmKelasLabel">Konfirmasi</h1>
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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Aplikasi Pembayaran Perkuliahan</title>
</head>

<body>
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

        <h4 class="mt-4">Data Kelas</h4>
        <button type="submit" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#insertKelas">Tambah Data</button>
        <table class="table mt-3" id="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Program Studi</th>
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
    var idKelas;
    $(document).ready(function() {
        getDataKelas();

        $("#tambahDataKelas").click(function() {
            let values = $('#formInsertKelas').serialize();
            console.log(values);
            if ($('#nama_kelas').val() == '') {
                console.log('Nama Kosong!');
            } else if ($('#prodi').val() == '') {
                console.log('Prodi Kosong!');
            } else {
                $.ajax({
                    url: "dataKelasPost.php",
                    type: "post",
                    data: values,
                    success: function(response) {
                        $('#insertKelas').modal('hide');
                        getDataKelas();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        });

        $('#updateKelas').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            console.log(div.data(`kelas`));
            console.log(div.data(`prodi`));
            console.log(div.data(`id_kelas`));
            // Isi nilai pada field
            modal.find(`#id_kelas`).attr("value", div.data(`id_kelas`));
            modal.find(`#nama_kelas_update`).attr("value", div.data(`nama_kelas`));
            modal.find(`#prodi_update`).attr("value", div.data(`prodi`));
        });

        $("#ubahDataKelas").click(function() {
            let values = $('#formUpdateKelas').serialize();
            console.log(values);
            if ($('#nama_kelas_update').val() == '') {
                console.log('Nama Kosong!');
            } else if ($('#prodi_update').val() == '') {
                console.log('Prodi Kosong!');
            } else {
                $.ajax({
                    url: "dataKelasPost.php",
                    type: "post",
                    data: values,
                    success: function(response) {
                        $('#updateKelas').modal('hide');
                        // clearInput();
                        getDataKelas();

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        });

        $('#table').on('click', '#hapusDataKelas', function(event) {
            event.preventDefault();
            idKelas = $(this).data('id_kelas');
            $('#deleteConfirmKelas').modal('show');
        });

        $('.modalDelete').click(function() {
            const data = {
                'id_kelas': idKelas,
                'crud': 'delete'
            }
            const serialized = new URLSearchParams(data)
            $.ajax({
                url: "dataKelasPost.php",
                type: "post",
                data: serialized.toString(),
                success: function(response) {
                    $('#deleteConfirmKelas').modal('hide');
                    getDataKelas();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        function getDataKelas() {
            $.ajax({
                url: "dataKelasGet.php",
                type: "get",
                success: function(response) {
                    console.log(response)
                    $('.data').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function clearInput() {
            $('#id_admin').val('');
            $('#nama_admin_update').val('');
            $('#kode_admin_update').val('');
            $('#pass_update').val('');
            $('#nama_admin').val('');
            $('#kode_admin').val('');
            $('#pass').val('');

        }
    });
</script>

</html>