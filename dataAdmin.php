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

<body class="">
    <!-- Modal -->
    <div class="modal fade" id="insertAdmin" tabindex="-1" aria-labelledby="insertAdminLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="insertAdminLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formInsertAdmin">
                        <div class="form-group">
                            <label for="InputNama">Nama Admin</label>
                            <input type="text" name="nama_admin" class="form-control" id="nama_admin" aria-describedby="InputNama">
                            <small id="nama_admin-error" class="text-danger"></small>
                        </div>
                        <div class="form-group mt-2">
                            <label for="InputKode">Kode Admin</label>
                            <input type="text" name="kode_admin" class="form-control" id="kode_admin" aria-describedby="InputKode">
                            <small id="kode_admin-error" class="text-danger"></small>
                        </div>
                        <div class="form-group mt-2">
                            <label for="InputPassword">Password</label>
                            <input type="password" name="pass" class="form-control" id="pass" aria-describedby="InputPassword">
                            <small id="pass-error" class="text-danger"></small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="tambahDataAdmin" class="btn btn-primary">Tambah Data</button>
                        </div>
                        <input type="text" name="crud" id="crud" value="insert" hidden>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateAdmin" tabindex="-1" aria-labelledby="updateAdminLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="insertAdminLabel">Ubah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formUpdateAdmin">
                        <input hidden type="number" name="id_admin" id="id_admin">
                        <div class="form-group">
                            <label for="InputNama">Nama Admin</label>
                            <input type="text" name="nama_admin_update" class="form-control" id="nama_admin_update" aria-describedby="InputNama">
                            <small id="nama_admin_update-error" class="text-danger"></small>
                        </div>
                        <div class="form-group mt-2">
                            <label for="InputKode">Kode Admin</label>
                            <input type="text" name="kode_admin_update" class="form-control" id="kode_admin_update" aria-describedby="InputKode">
                            <small id="kode_admin_update-error" class="text-danger"></small>
                        </div>
                        <div class="form-group mt-2">
                            <label for="InputPassword">Password</label>
                            <input type="password" name="pass_update" class="form-control" id="pass_update" aria-describedby="InputPassword">
                            <small id="pass_pass_update-error" class="text-danger"></small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="ubahDataAdmin" class="btn btn-primary">Ubah Data</button>
                        </div>
                        <input type="text" name="crud" id="crud" value="update" hidden>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Confirm Delete-->
    <div class="modal fade" id="deleteConfirmAdmin" tabindex="-1" aria-labelledby="deleteConfirmAdminLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteConfirmAdminLabel">Konfirmasi</h1>
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

    <nav class="navbar navbar-expand-lg bg-primary">
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

        <h4 class="mt-4">Data Admin</h4>
        <button type="submit" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#insertAdmin">Tambah Data</button>
        <table class="table mt-3" id="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Admin</th>
                    <th scope="col">ID Admin</th>
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
    var idAdmin;
    $(document).ready(function() {
        getDataAdmin();

        $("#tambahDataAdmin").click(function() {
            let values = $('#formInsertAdmin').serialize();
            console.log(values);
            if ($('#nama_admin').val() == '') {
                console.log('Nama Kosong!');
            } else if ($('#kode_admin').val() == '') {
                console.log('Kode Kosong!');
            } else if ($('#pass').val() == '') {
                console.log('Password Kosong!');
            } else {
                $.ajax({
                    url: "dataAdminPost.php",
                    type: "post",
                    data: values,
                    success: function(response) {
                        $('#insertAdmin').modal('hide');
                        getDataAdmin();
                        // if (response == 'success') {
                        // } else {
                        //     console.log(response);
                        // }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        });

        $('#updateAdmin').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            console.log(div.data(`pass`));
            console.log(div.data(`nama_admin`));
            console.log(div.data(`id_admin`));
            // Isi nilai pada field
            modal.find(`#id_admin`).attr("value", div.data(`id_admin`));
            modal.find(`#nama_admin_update`).attr("value", div.data(`nama_admin`));
            modal.find(`#kode_admin_update`).attr("value", div.data(`kd_admin`));
            modal.find(`#pass_update`).attr("value", div.data(`pass`));
        });

        $("#ubahDataAdmin").click(function() {
            let values = $('#formUpdateAdmin').serialize();
            console.log(values);
            if ($('#nama_admin_update').val() == '') {
                console.log('Nama Kosong!');
            } else if ($('#kode_admin_update').val() == '') {
                console.log('Kode Kosong!');
            } else if ($('#pass_update').val() == '') {
                console.log('Password Kosong!');
            } else {
                $.ajax({
                    url: "dataAdminPost.php",
                    type: "post",
                    data: values,
                    success: function(response) {
                        $('#updateAdmin').modal('hide');
                        // clearInput();
                        getDataAdmin();

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        });

        $('#table').on('click', '#hapusDataAdmin', function(event) {
            event.preventDefault();
            idAdmin = $(this).data('id_admin');
            $('#deleteConfirmAdmin').modal('show');
        });

        $('.modalDelete').click(function() {
            const data = {
                'id_admin': idAdmin,
                'crud': 'delete'
            }
            const serialized = new URLSearchParams(data)
            $.ajax({
                url: "dataAdminPost.php",
                type: "post",
                data: serialized.toString(),
                success: function(response) {
                    $('#deleteConfirmAdmin').modal('hide');
                    getDataAdmin();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        function getDataAdmin() {
            $.ajax({
                url: "dataAdminGet.php",
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