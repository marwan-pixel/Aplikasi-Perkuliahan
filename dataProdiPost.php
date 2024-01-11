<?php

    include 'Database.php';

    $db = new Database();
    $conn = $db->connect();
    if($_POST['crud'] == 'insert') {
        $sql = mysqli_query($conn, "INSERT INTO tbl_prodi (nama_prodi, biaya) VALUES ('". $_POST['nama_prodi'] ."', ". $_POST['biaya'] .")");
    } else if ($_POST['crud'] == 'update') {
        $sql = mysqli_query($conn, "UPDATE tbl_prodi SET nama_prodi = '" . $_POST['nama_prodi_update'] . "', biaya = '" . $_POST['biaya_update'] . "' WHERE id_prodi = " . $_POST['id_prodi'] . "");
    } else if ($_POST['crud'] == 'delete') {
        $sql = mysqli_query($conn, "DELETE FROM tbl_prodi WHERE id_prodi = " . $_POST['id_prodi'] . "");
    }
    if($conn->query($sql) == true) {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();