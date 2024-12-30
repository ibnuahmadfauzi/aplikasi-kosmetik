<?php
require_once('config.php');
$nama = $_POST['input-nama-survey'];
$jenis_kelamin = $_POST['input-jeniskelamin-survey'];
$jawaban1 = $_POST['jawaban-soal1'];
$jawaban2 = $_POST['jawaban-soal2'];
$jawaban3 = $_POST['jawaban-soal3'];
$jawaban4 = $_POST['jawaban-soal4'];
$jawaban5 = $_POST['jawaban-soal5'];
$jawaban6 = $_POST['jawaban-soal6'];
$jawaban7 = $_POST['jawaban-soal7'];
$akun_id = $_POST['akun_id'];
$tanggal_survey = date("Y-m-d H:i:s");

$sql = "INSERT INTO jawaban_survey (soal_1, soal_2, soal_3, soal_4, soal_5, soal_6, soal_7, nama, jenis_kelamin, tanggal, akun_id, jenis_kulit, deskripsi)
VALUES ('$jawaban1', '$jawaban2', '$jawaban3', '$jawaban4', '$jawaban5', '$jawaban6', '$jawaban7', '$nama', '$jenis_kelamin', '$tanggal_survey', $akun_id, '', '')";

if ($conn->query($sql) === TRUE) {
?>
    <script>
        window.location.href = "./?p=my_account";
    </script>
<?php
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
