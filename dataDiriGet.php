<?php
include 'Database.php';

$db = new Database();
$conn = $db->connect();

$rows = mysqli_query($conn, "SELECT id_mahasiswa, nama_mahasiswa, npm, kelas, program_studi FROM tbl_mahasiswa WHERE nama_mahasiswa = '" . $_POST['nama_mahasiswa'] . "'");
$data = array();

$data = mysqli_fetch_assoc($rows);

echo json_encode($data);
