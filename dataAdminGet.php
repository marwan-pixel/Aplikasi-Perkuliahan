<?php
session_start();
include 'Database.php';

$db = new Database();
$conn = $db->connect();

$rows = mysqli_query($conn, "SELECT id_admin, nama_admin, kd_admin, pass FROM tbl_admin");
$data = array();

foreach ($rows as $row) {
    $data[] = $row;
}

// $dataGet = json_encode($data);
$no = 1;
if ($rows->num_rows > 0) {
    for ($i = 0; $i < count($data); $i++) {
        echo '
            <tr>
                <td>' . $no++ . '</td>
                <td>' . $data[$i]['nama_admin'] . '</td>
                <td>' . $data[$i]['kd_admin'] . '</td>
                <td>';
        if ($_SESSION['username'] == $data[$i]['nama_admin']) {
            echo '
                <div class="d-grid gap-2 d-md-block">
                    <button class="btn btn-warning"
                    data-id_admin="' . $data[$i]['id_admin'] . '"
                    data-nama_admin="' . $data[$i]['nama_admin'] . '"
                    data-kd_admin="' . $data[$i]['kd_admin'] . '"
                    data-pass="' . $data[$i]['pass'] . '" type="submit" 
                    data-bs-toggle="modal"
                    data-bs-target="#updateAdmin">Ubah</button>
                    
                    <button class="btn btn-danger" disabled>Hapus</button>
                </div>
            ';
        } else {
            echo '
                            <div class="d-grid gap-2 d-md-block">
                                <button class="btn btn-warning"
                                data-id_admin="' . $data[$i]['id_admin'] . '"
                                data-nama_admin="' . $data[$i]['nama_admin'] . '"
                                data-kd_admin="' . $data[$i]['kd_admin'] . '"
                                data-pass="' . $data[$i]['pass'] . '" type="submit" 
                                data-bs-toggle="modal"
                                data-bs-target="#updateAdmin">Ubah</button>
                                
                                <button class="btn btn-danger" id="hapusDataAdmin"
                                data-id_admin="' . $data[$i]['id_admin'] . '" 
                                type="submit">Hapus</button>
                            </div>
                        </td>
                    </tr>
                    ';
        }
    }
} else {
    echo '
    <tr>
        <td colspan="4"><p class="fw-bold text-center">Data Admin Kosong!</p></td>
    </tr>
    ';
}
