<?php

include 'Database.php';

$db = new Database();
$conn = $db->connect();

$rows = mysqli_query($conn, "SELECT id_kelas, nama_kelas, prodi FROM tbl_kelas");
$data = array();

foreach ($rows as $row) {
    $data[] = $row;
}

// $dataGet = json_encode($data);
$no = 1;
if($rows->num_rows > 0){
    for ($i = 0; $i < count($data); $i++) {
        echo '
            <tr>
                <td>' . $no++ . '</td>
                <td>' . $data[$i]['nama_kelas'] . '</td>
                <td>' . $data[$i]['prodi'] . '</td>
                <td>
                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-warning"
                        data-id_kelas="' . $data[$i]['id_kelas'] . '"
                        data-nama_kelas="' . $data[$i]['nama_kelas'] . '"
                        data-prodi="' . $data[$i]['prodi'] . '"
                        type="submit" 
                        data-bs-toggle="modal"
                        data-bs-target="#updateKelas">Ubah</button>
                        
                        <button class="btn btn-danger" id="hapusDataKelas"
                        data-id_kelas="'. $data[$i]['id_kelas'] .'" 
                        type="submit">Hapus</button>
                    </div>
                </td>
            </tr>
            ';
    }
} else {
    echo '
    <tr>
        <td colspan="4"><p class="fw-bold text-center">Data Kelas Kosong!</p></td>
    </tr>
    ';
}

