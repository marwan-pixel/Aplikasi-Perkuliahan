<?php

    include 'Database.php';

    $db = new Database();
    $conn = $db->connect();
    if($_POST['crud'] == 'insert') {
        $sql = mysqli_query($conn, "INSERT INTO tbl_kelas (nama_kelas, prodi) VALUES ('". $_POST['nama_kelas'] ."', '". $_POST['prodi'] ."')");
    } else if ($_POST['crud'] == 'update') {
        $sql = mysqli_query($conn, "UPDATE tbl_kelas SET nama_kelas = '" . $_POST['nama_kelas_update'] . "', prodi = '" . $_POST['prodi_update'] . "' WHERE id_kelas = " . $_POST['id_kelas'] . "");
    } else if ($_POST['crud'] == 'delete') {
        $sql = mysqli_query($conn, "DELETE FROM tbl_kelas WHERE id_kelas = " . $_POST['id_kelas'] . "");
    }
    if($conn->query($sql) == true) {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();