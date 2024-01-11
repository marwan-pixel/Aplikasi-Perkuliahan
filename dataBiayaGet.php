<?php
include 'Database.php';

$db = new Database();
$conn = $db->connect();

$rows = mysqli_query($conn, "SELECT biaya FROM tbl_prodi WHERE nama_prodi = '" . $_POST['program_studi'] . "'");
$data = array();

$data = mysqli_fetch_assoc($rows);

echo json_encode($data);