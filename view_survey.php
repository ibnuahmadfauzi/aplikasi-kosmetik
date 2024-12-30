<?php
$title = "Survey Jenis Kulit";
$sub_title = "";
if (isset($_GET['c']) && isset($_GET['s'])) {
    $cat_qry = $conn->query("SELECT * FROM categories where md5(id) = '{$_GET['c']}'");
    if ($cat_qry->num_rows > 0) {
        $title = $cat_qry->fetch_assoc()['category'];
    }
    $sub_cat_qry = $conn->query("SELECT * FROM sub_categories where md5(id) = '{$_GET['s']}'");
    if ($sub_cat_qry->num_rows > 0) {
        $sub_title = $sub_cat_qry->fetch_assoc()['sub_category'];
    }
} elseif (isset($_GET['c'])) {
    $cat_qry = $conn->query("SELECT * FROM categories where md5(id) = '{$_GET['c']}'");
    if ($cat_qry->num_rows > 0) {
        $title = $cat_qry->fetch_assoc()['category'];
    }
} elseif (isset($_GET['s'])) {
    $sub_cat_qry = $conn->query("SELECT * FROM sub_categories where md5(id) = '{$_GET['s']}'");
    if ($sub_cat_qry->num_rows > 0) {
        $title = $sub_cat_qry->fetch_assoc()['sub_category'];
    }
}

?>
<!-- Header-->
<header class="bg-dark py-5" id="main-header">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder"><?php echo $title ?></h1>
            <p class="lead fw-normal text-white-50 mb-0"><?php echo $sub_title ?></p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container">
        <form action="./?p=process_survey"
            method="POST">
            <h4>Identitas Diri:</h4>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="input-nama-survey" class="form-label">Nama :</label>
                                <input type="text" id="input-nama-survey" name="input-nama-survey" class="form-control form-control-sm" placeholder="...">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="input-jeniskelamin-survey" class="form-label">Jenis Kelamin :</label>
                                <select class="form-control form-control-sm" id="input-jeniskelamin-survey" name="input-jeniskelamin-survey">
                                    <option value="">...</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h4>Pertanyaan Survey:</h4>
            <div class="row">
                <div class="col-lg-6 pb-3">
                    <div class="card" style="height: 100%;">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="input-soal1-survey" class="form-label">Bagaimana anda dalam menggambarkan kondisi kulit anda ?</label>
                                <br>
                                <input type="radio" required id="jawaban-soal1-a" name="jawaban-soal1" value="Kering"> <label for="jawaban-soal1-a" class="font-weight-light">Kering</label>
                                <br>
                                <input type="radio" required id="jawaban-soal1-b" name="jawaban-soal1" value="Normal"> <label for="jawaban-soal1-b" class="font-weight-light">Normal</label>
                                <br>
                                <input type="radio" required id="jawaban-soal1-c" name="jawaban-soal1" value="Berminyak"> <label for="jawaban-soal1-c" class="font-weight-light">Berminyak</label>
                                <br>
                                <input type="radio" required id="jawaban-soal1-d" name="jawaban-soal1" value="Kombinasi"> <label for="jawaban-soal1-d" class="font-weight-light">Kombinasi</label>
                                <br>
                                <input type="radio" required id="jawaban-soal1-e" name="jawaban-soal1" value="Sensitif"> <label for="jawaban-soal1-e" class="font-weight-light">Sensitif</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pb-3">
                    <div class="card" style="height: 100%;">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="input-soal2-survey" class="form-label">Apakah kulit anda sering terasa ?</label>
                                <br>
                                <input required type="radio" id="jawaban-soal2-a" name="jawaban-soal2" value="Ketat"> <label for="jawaban-soal2-a" class="font-weight-light">Ketat</label>
                                <br>
                                <input required type="radio" id="jawaban-soal2-b" name="jawaban-soal2" value="Kasar"> <label for="jawaban-soal2-b" class="font-weight-light">Kasar</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pb-3">
                    <div class="card" style="height: 100%;">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="input-soal3-survey" class="form-label">Apakah anda sering mengalami masalah berikut ?</label>
                                <br>
                                <input required type="radio" id="jawaban-soal3-a" name="jawaban-soal3" value="Jerawat"> <label for="jawaban-soal3-a" class="font-weight-light">Jerawat</label>
                                <br>
                                <input required type="radio" id="jawaban-soal3-b" name="jawaban-soal3" value="Kemerahan"> <label for="jawaban-soal3-b" class="font-weight-light">Kemerahan</label>
                                <br>
                                <input required type="radio" id="jawaban-soal3-c" name="jawaban-soal3" value="Kulit Kusam"> <label for="jawaban-soal3-c" class="font-weight-light">Kulit Kusam</label>
                                <br>
                                <input required type="radio" id="jawaban-soal3-d" name="jawaban-soal3" value="Komedo"> <label for="jawaban-soal3-d" class="font-weight-light">Komedo</label>
                                <br>
                                <input required type="radio" id="jawaban-soal3-e" name="jawaban-soal3" value="Minyak Berlebih"> <label for="jawaban-soal3-e" class="font-weight-light">Minya Berlebih</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pb-3">
                    <div class="card" style="height: 100%;">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="input-soal4-survey" class="form-label">Bagaimana reaksi kulit anda dalam perubahan cuaca ?</label>
                                <br>
                                <input required type="radio" id="jawaban-soal4-a" name="jawaban-soal4" value="Mudah kering saat cuaca dingin"> <label for="jawaban-soal4-a" class="font-weight-light">Mudah kering saat cuaca dingin</label>
                                <br>
                                <input required type="radio" id="jawaban-soal4-b" name="jawaban-soal4" value="Mudah berminyak saat cuaca panas"> <label for="jawaban-soal4-b" class="font-weight-light">Mudah berminyak saat cuaca panas</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pb-3">
                    <div class="card" style="height: 100%;">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="input-soal5-survey" class="form-label">Apakah anda memiliki alergi terhadap bahan tertentu dalam produk skincare ?</label>
                                <br>
                                <input required type="radio" id="jawaban-soal5-a" name="jawaban-soal5" value="Tidak"> <label for="jawaban-soal5-a" class="font-weight-light">Tidak</label>
                                <br>
                                <input required type="radio" id="jawaban-soal5-b" name="jawaban-soal5" value="Ya"> <label for="jawaban-soal5-b" class="font-weight-light">Ya</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pb-3">
                    <div class="card" style="height: 100%;">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="input-soal6-survey" class="form-label">Jelaskan jika anda memiliki alergi terhadap bahan tertentu dalam produk skincare !</label>
                                <br>
                                <input required type="text" id="input-soal6-survey" name="jawaban-soal6" placeholder="..." class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pb-3">
                    <div class="card" style="height: 100%;">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="input-soal7-survey" class="form-label">Produk dan brand skincare apa yang sering atau cocok anda gunakan ?</label>
                                <br>
                                <input required type="text" id="input-soal7-survey" name="jawaban-soal7" placeholder="..." class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" value="<?php echo $_settings->userdata('id'); ?>" name="akun_id">
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Kirim Survey</button>
            </div>
        </form>
    </div>
</section>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
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
    $tanggal_survey = date('Y-m-d');

    echo $jawaban1;

    $sql = "INSERT INTO jawaban_survey (soal_1, soal_2, soal_3, soal_4, soal_5, soal_6, soal_7, nama, jenis_kelamin, tanggal, akun_id, jenis_kulit, deskripsi)
    VALUES ($jawaban1, $jawaban2, $jawaban3, $jawaban4, $jawaban5, $jawaban6, $jawaban7, $nama, $jenis_kelamin, $tanggal_survey, $akun_id, '', '')";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>