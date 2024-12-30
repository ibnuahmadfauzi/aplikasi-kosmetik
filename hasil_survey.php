<?php
$title = "Hasil Survey";
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
        <div class="card">
            <div class="card-body">
                <?php
                $id_survey = $_POST['id-survey'];
                $sql = "SELECT * FROM jawaban_survey WHERE id=$id_survey";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <h4 class="text-center">Jenis Kulit = <?php echo (strlen($row['jenis_kulit']) > 0) ?  $row['jenis_kulit'] : '-'; ?></h4>
                        <p class="text-center">
                            <?php echo (strlen($row['deskripsi']) > 0) ?  $row['deskripsi'] : '-'; ?>
                        </p>
                <?php
                    }
                } else {
                    echo "0 results";
                }
                ?>
            </div>
        </div>
    </div>
</section>