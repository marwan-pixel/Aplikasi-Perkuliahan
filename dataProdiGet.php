<?php

include 'Database.php';

$db = new Database();
$conn = $db->connect();

$rows = mysqli_query($conn, "SELECT id_prodi, nama_prodi, biaya FROM tbl_prodi");
$data = array();

foreach ($rows as $row) {
    $data[] = $row;
}

// $dataGet = json_encode($data);
$no = 1;
if($rows->num_rows > 0) {
    for ($i = 0; $i < count($data); $i++) {
        echo '
            <tr>
                <td>' . $no++ . '</td>
                <td>' . $data[$i]['nama_prodi'] . '</td>
                <td>Rp' . number_format($data[$i]['biaya'],2,',','.') . '</td>
                <td>
                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-warning"
                        data-id_prodi="' . $data[$i]['id_prodi'] . '"
                        data-nama_prodi="' . $data[$i]['nama_prodi'] . '"
                        data-biaya="' . $data[$i]['biaya'] . '"
                        type="submit" 
                        data-bs-toggle="modal"
                        data-bs-target="#updateProdi">Ubah</button>
                        
                        <button class="btn btn-danger" id="hapusDataProdi"
                        data-id_prodi="' . $data[$i]['id_prodi'] . '" 
                        type="submit">Hapus</button>
                    </div>
                </td>
            </tr>
            ';
    }
} else {
    echo '
    <tr>
        <td colspan="4"><p class="fw-bold text-center">Data Program Studi Kosong!</p></td>
    </tr>
    ';
}

