<?php

include 'Database.php';

$db = new Database();
$conn = $db->connect();
echo $_POST['nama_mahasiswa_update'] . $_POST['npm_update'] . $_POST['kelas_update'] . $_POST['program_studi_update'] . $_POST['id_mahasiswa'];
if ($_POST['crud'] == 'insert') {
    $sql = mysqli_query($conn, "INSERT INTO tbl_mahasiswa (nama_mahasiswa, npm, kelas, program_studi) VALUES ('" . $_POST['nama_mahasiswa'] . "', " . $_POST['npm'] . ", '" . $_POST['kelas'] . "','" . $_POST['program_studi'] . "')");
} else if ($_POST['crud'] == 'update') {
    $sql = mysqli_query($conn, "UPDATE tbl_mahasiswa 
        SET 
            nama_mahasiswa = '" . $_POST['nama_mahasiswa_update'] . "', 
            npm = '" . $_POST['npm_update'] . "', 
            kelas = '" . $_POST['kelas_update'] . "' , 
            program_studi = '" . $_POST['program_studi_update'] . "' 
        WHERE id_mahasiswa = " . $_POST['id_mahasiswa']);
} else if ($_POST['crud'] == 'delete') {
    $sql = mysqli_query($conn, "DELETE FROM tbl_mahasiswa WHERE id_mahasiswa = ". $_POST['id_mahasiswa']);
}
if ($conn->query($sql) == true) {
    echo "success";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
