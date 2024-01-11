<?php
    session_start();
    include 'Database.php';
    $db = new Database();
    $conn = $db->connect();
    if($_POST['role'] == 'admin'){
        $sql = mysqli_query($conn, "SELECT nama_admin, pass FROM tbl_admin WHERE kd_admin ='" . $_POST['id'] . "'");
    } else if($_POST['role'] == 'mahasiswa') {
        $sql = mysqli_query($conn, "SELECT nama_mahasiswa, npm FROM tbl_mahasiswa WHERE npm ='" . $_POST['npm'] . "'");
    }
    if($sql->num_rows > 0) {
        $Data = [];
        foreach ($sql as $values) {
            $Data['pass'] = $values['pass'] ?? $values['npm'];
            $Data['username'] = $values['nama_admin'] ?? $values['nama_mahasiswa'];
        }
        if($Data['pass'] == $_POST['password']){
            $_SESSION['username'] = $Data['username'];
            $_SESSION['role'] = $_POST['role'];
            echo 'success';
        } else {
            echo 'Password salah';
        }
    } else {
        echo "Akun tidak terdaftar!";
    }

    $conn->close();