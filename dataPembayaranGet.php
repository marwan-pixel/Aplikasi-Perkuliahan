<?php

include 'Database.php';

$db = new Database();
$conn = $db->connect();

if (isset($_POST['nama_mahasiswa'])) {
    $rows = mysqli_query($conn, "SELECT biaya_masuk, tgl_pembayaran FROM pembayaran WHERE nama_mahasiswa = '" . $_POST['nama_mahasiswa'] . "'");
} else {
    $rows = mysqli_query($conn, "SELECT * FROM pembayaran");
}
$data = array();
 
// $dataGet = json_encode($data);
if ($rows->num_rows > 0) {
    foreach ($rows as $row) {
        $data[] = $row;
    }
    var_dump($data);
    $no = 1;
    for ($i = 0; $i < count($data); $i++) {
        if (isset($_POST['nama_mahasiswa'])) {
            echo '
                <tr>
                    <td>' . $no++ . '</td>
                    <td>Rp' . number_format($data[$i]['biaya_masuk'],2,',','.') . '</td>
                    <td>' . $data[$i]['tgl_pembayaran'] . '</td>
                </tr>
                ';
        } else {
            echo '
                <tr>
                    <td>' . $no++ . '</td>
                    <td>' . $data[$i]['nama_mahasiswa'] . '</td>
                    <td>' . $data[$i]['kelas'] . '</td>
                    <td>Rp' . number_format($data[$i]['biaya_masuk'],2,',','.') . '</td>
                    <td>' . $data[$i]['tgl_pembayaran'] . '</td>
                </tr>
                ';
        }
    }
} else {
    if (isset($_POST['nama_mahasiswa'])) {
        echo '
        <tr>
            <td colspan="3"><p class="fw-bold text-center">Data Pembayaran Kosong!</p></td>
        </tr>
        ';
    } else {
        echo '
        <tr>
            <td colspan="5"><p class="fw-bold text-center">Data Pembayaran Kosong!</p></td>
        </tr>
        ';
    }

}
