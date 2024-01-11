<?php

include 'Database.php';

$db = new Database();
$conn = $db->connect();

$rows = mysqli_query($conn, "SELECT id_mahasiswa, nama_mahasiswa, npm, kelas, program_studi FROM tbl_mahasiswa");
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
                <td>' . $data[$i]['nama_mahasiswa'] . '</td>
                <td>' . $data[$i]['npm'] . '</td>
                <td>' . $data[$i]['kelas'] . '</td>
                <td>' . $data[$i]['program_studi'] . '</td>
                <td>
                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-warning"
                        data-id_mahasiswa="' . $data[$i]['id_mahasiswa'] . '"
                        data-nama_mahasiswa="' . $data[$i]['nama_mahasiswa'] . '"
                        data-npm="' . $data[$i]['npm'] . '"
                        data-kelas="' . $data[$i]['kelas'] . '"
                        data-program_studi="' . $data[$i]['program_studi'] . '"
                        type="submit" 
                        data-bs-toggle="modal"
                        data-bs-target="#updateMahasiswa">Ubah</button>
                        
                        <button class="btn btn-danger" id="hapusDataMahasiswa"
                        data-id_mahasiswa="'. $data[$i]['id_mahasiswa'] .'" 
                        type="submit">Hapus</button>
                    </div>
                </td>
            </tr>
            ';
    }
} else {
    echo '
    <tr>
        <td colspan="6"><p class="fw-bold text-center">Data Mahasiswa Kosong!</p></td>
    </tr>
    ';
}

