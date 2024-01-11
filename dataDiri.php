<?php
session_start();
if (!isset($_SESSION['username'])) {
    if ($_SESSION['role'] == 'mahasiswa') {
        header("Location: loginMahasiswa.php");
        exit;
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

    <div style="height: 90vh;" class=" row d-flex justify-content-center align-items-center ">
        <div class="card col-sm-6">
            <div class="card-body text-center my-auto">
                <h3 class="card-title"> Data Diri</h3>
            </div>
            <div class="card-body">
                <form id="biodata">
                    <input hidden name="id_mahasiswa" type="number" id="id_mahasiswa">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Mahasiswa</label>
                        <input type="text" name="nama_mahasiswa" class="form-control" id="nama_mahasiswa" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">NPM</label>
                        <input type="number" name="npm" class="form-control" id="npm">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Kelas</label>
                        <input type="text" name="kelas" class="form-control" id="kelas">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Program Studi</label>
                        <input type="text" name="program_studi" class="form-control" id="program_studi">
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto ">
                        <button type="button" class="my-3 btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateMahasiswa">Edit</button>
                        <a href="logoutMahasiswaService.php" class="btn btn-danger">Log Out</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

<script type="text/javascript">
    var namaMahasiswa = `<?= $_SESSION['username'] ?>`;
    var results;
    $(document).ready(function() {
        getDataDiri();

        function getDataDiri() {
            const data = {
                'nama_mahasiswa': namaMahasiswa,
            }
            const serialized = new URLSearchParams(data);
            $.ajax({
                url: "dataDiriGet.php",
                type: "post",
                data: serialized.toString(),
                success: function(response) {
                    results = JSON.parse(response);
                    console.log(results.npm);
                    $('#id_mahasiswa').val(results.id_mahasiswa);
                    $('#nama_mahasiswa').val(results.nama_mahasiswa);
                    $('#npm').val(results.npm);
                    $('#kelas').val(results.kelas);
                    $('#program_studi').val(results.program_studi);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        $('#updateMahasiswa').on('show.bs.modal', function(event) {

            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            // Isi nilai pada field
            modal.find(`#id_mahasiswa`).attr("value", results.id_mahasiswa);
            modal.find(`#nama_mahasiswa_update`).attr("value", results.nama_mahasiswa);
            modal.find(`#npm_update`).attr("value", results.npm);
            modal.find(`#kelas_update`).attr("value", results.kelas);
            modal.find(`#program_studi_update`).attr("value", results.program_studi);
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
                        getDataDiri();
                        // clearInput();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        });
    });
</script>

</html>