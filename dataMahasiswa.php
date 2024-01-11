<?php
session_start();
if (!isset($_SESSION['username'])) {
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

<div class="modal fade" id="insertMahasiswa" tabindex="-1" aria-labelledby="insertMahasiswaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="insertMahasiswaLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formInsertMahasiswa">
                    <div class="form-group">
                        <label for="inputMahasiswa">Nama Mahasiswa</label>
                        <input type="text" name="nama_mahasiswa" class="form-control" id="nama_mahasiswa" aria-describedby="inputMahasiswa">
                        <small id="nama_mahasiswa-error" class="text-danger"></small>
                    </div>
                    <div class="form-group mt-2">
                        <label for="inputNPM">NPM</label>
                        <input type="number" name="npm" class="form-control" id="npm" aria-describedby="inputNPM">
                        <small id="npm-error" class="text-danger"></small>
                    </div>
                    <div class="form-group mt-2">
                        <label for="inputKelas">Kelas</label>
                        <input type="text" name="kelas" class="form-control" id="kelas" aria-describedby="inputKelas">
                        <small id="kelas-error" class="text-danger"></small>
                    </div>
                    <div class="form-group mt-2">
                        <label for="inputProdi">Program Studi</label>
                        <input type="text" name="program_studi" class="form-control" id="program_studi" aria-describedby="inputProdi">
                        <small id="program_studi-error" class="text-danger"></small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="tambahDataMahasiswa" class="btn btn-primary">Tambah Data</button>
                    </div>
                    <input type="text" name="crud" id="crud" value="insert" hidden>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateMahasiswa" tabindex="-1" aria-labelledby="updateMahasiswaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="insertAdminLabel">Ubah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formUpdateMahasiswa">
                    <input hidden type="number" name="id_mahasiswa" id="id_mahasiswa">
                    <div class="form-group">
                        <label for="inputMahasiswa">Nama Mahasiswa</label>
                        <input type="text" name="nama_mahasiswa_update" class="form-control" id="nama_mahasiswa_update" aria-describedby="inputMahasiswa">
                        <small id="nama_mahasiswa_update-error" class="text-danger"></small>
                    </div>
                    <div class="form-group mt-2">
                        <label for="inputNPM">NPM</label>
                        <input type="number" name="npm_update" class="form-control" id="npm_update" aria-describedby="inputNPM">
                        <small id="npm_update-error" class="text-danger"></small>
                    </div>
                    <div class="form-group mt-2">
                        <label for="inputKelas">Kelas</label>
                        <input type="text" name="kelas_update" class="form-control" id="kelas_update" aria-describedby="inputKelas">
                        <small id="kelas_update-error" class="text-danger"></small>
                    </div>
                    <div class="form-group mt-2">
                        <label for="inputProdi">Program Studi</label>
                        <input type="text" name="program_studi_update" class="form-control" id="program_studi_update" aria-describedby="inputProdi">
                        <small id="program_studi_update-error" class="text-danger"></small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="ubahDataMahasiswa" class="btn btn-primary">Ubah Data</button>
                    </div>
                    <input type="text" name="crud" id="crud" value="update" hidden>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirm Delete-->
<div class="modal fade" id="deleteConfirmMahasiswa" tabindex="-1" aria-labelledby="deleteConfirmMahasiswaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteConfirmMahasiswaLabel">Konfirmasi</h1>
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

        <h4 class="mt-4">Data Diri</h4>
        <button type="submit" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#insertMahasiswa">Tambah Data</button>
        <table class="table mt-3" id="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Mahasiswa/i</th>
                    <th scope="col">NPM</th>
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
    var idMahasiswa;
    $(document).ready(function() {
        getDataMahasiswa();

        $("#tambahDataMahasiswa").click(function() {
            let values = $('#formInsertMahasiswa').serialize();
            console.log(values);
            if ($('#nama_mahasiswa').val() == '') {
                console.log('Nama Kosong!');
            } else if ($('#npm').val() == '') {
                console.log('NPM Kosong!');
            } else if ($('#kelas').val() == '') {
                console.log('Kelas Kosong!');
            } else if ($('#program_studi').val() == '') {
                console.log('Program Studi Kosong!');
            } else {
                $.ajax({
                    url: "dataMahasiswaPost.php",
                    type: "post",
                    data: values,
                    success: function(response) {
                        $('#insertMahasiswa').modal('hide');
                        getDataMahasiswa();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        });

        $('#updateMahasiswa').on('show.bs.modal', function(event) {

            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            // Isi nilai pada field
            modal.find(`#id_mahasiswa`).attr("value", div.data(`id_mahasiswa`));
            modal.find(`#nama_mahasiswa_update`).attr("value", div.data(`nama_mahasiswa`));
            modal.find(`#npm_update`).attr("value", div.data(`npm`));
            modal.find(`#kelas_update`).attr("value", div.data(`kelas`));
            modal.find(`#program_studi_update`).attr("value", div.data(`program_studi`));
        });

        $("#ubahDataMahasiswa").click(function() {
            let values = $('#formUpdateMahasiswa').serialize();
            console.log(values)
            if ($('#nama_mahasiswa_update').val() == '') {
                console.log('Nama Kosong!');
            } else if ($('#npm_update').val() == '') {
                console.log('NPM Kosong!');
            } else if ($('#kelas_update').val() == '') {
                console.log('Kelas Kosong!');
            } else if ($('#program_studi_update').val() == '') {
                console.log('Program Studi Kosong!');
            } else {
                $.ajax({
                    url: "dataMahasiswaPost.php",
                    type: "post",
                    data: values,
                    success: function(response) {
                        console.log(response)
                        $('#updateMahasiswa').modal('hide');
                        getDataMahasiswa();
                        // clearInput();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        });

        $('#table').on('click', '#hapusDataMahasiswa', function(event) {
            event.preventDefault();
            idMahasiswa = $(this).data('id_mahasiswa');
            $('#deleteConfirmMahasiswa').modal('show');
        });

        $('.modalDelete').click(function() {
            const data = {
                'id_mahasiswa': idMahasiswa,
                'crud': 'delete'
            }
            const serialized = new URLSearchParams(data)
            $.ajax({
                url: "dataMahasiswaPost.php",
                type: "post",
                data: serialized.toString(),
                success: function(response) {
                    $('#deleteConfirmMahasiswa').modal('hide');
                    getDataMahasiswa();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        function getDataMahasiswa() {
            $.ajax({
                url: "dataMahasiswaGet.php",
                type: "get",
                success: function(response) {
                    $('.data').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function clearInput() {
            $('#id_prodi').val('');
            $('#nama_mahasiswa_update').val('');
            $('#biaya_update').val('');
            $('#nama_mahasiswa').val('');
            $('#biaya_update').val('');
        }
    });
</script>

</html>