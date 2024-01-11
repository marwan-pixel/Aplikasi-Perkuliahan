<?php
    session_start();
    include 'Database.php';

    $db = new Database();
    $conn = $db->connect();
    if($_POST['crud'] == 'insert') {
        $sql = mysqli_query($conn, "INSERT INTO tbl_admin (nama_admin, kd_admin, pass) VALUES ('". $_POST['nama_admin'] ."', '". $_POST['kode_admin'] ."', '" . $_POST['pass'] . "')");
    } else if ($_POST['crud'] == 'update') {
        $sql = mysqli_query($conn, "UPDATE tbl_admin SET nama_admin = '" . $_POST['nama_admin_update'] . "', kd_admin = '" . $_POST['kode_admin_update'] . "', pass = '" . $_POST['pass_update'] . 
        "' WHERE id_admin = " . $_POST['id_admin'] . "");
        $_SESSION['username'] = $_POST['nama_admin_update'];
    } else if ($_POST['crud'] == 'delete') {
        $sql = mysqli_query($conn, "DELETE FROM tbl_admin WHERE id_admin = " . $_POST['id_admin'] . "");
    }
    if($conn->query($sql) == true) {
        echo "success";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();