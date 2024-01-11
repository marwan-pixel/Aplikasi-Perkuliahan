<?php

include 'Database.php';

$db = new Database();
$conn = $db->connect();

$sql = mysqli_query($conn, "INSERT INTO pembayaran (nama_mahasiswa, kelas, biaya_masuk, tgl_pembayaran) VALUES ('" . $_POST['nama_mahasiswa'] . "', '" . $_POST['kelas'] . "', '" . $_POST['biaya_masuk'] . "', '" . date('Y-m-d') . "')");

if ($conn->query($sql) == true) {
    echo "success";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
