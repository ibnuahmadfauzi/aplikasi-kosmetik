<div class="card card-primary card-outline">
    <div class="card-header">
        <h5 class="card-title">Survey</h5>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM jawaban_survey";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $row['tanggal']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal<?php echo $row['id'] ?>">Edit Data</button>
                                <div class="modal fade" id="modal<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="modal<?php echo $row['id'] ?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal<?php echo $row['id'] ?>Label">Edit Hasil Survey</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <p>
                                                                <b>Bagaimana anda dalam menggambarkan kondisi kulit anda ?</b>
                                                            </p>
                                                            <p>
                                                                <?php echo $row['soal_1']; ?>
                                                            </p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <p>
                                                                <b>Apakah kulit anda sering terasa ?</b>
                                                            </p>
                                                            <p>
                                                                <?php echo $row['soal_2']; ?>
                                                            </p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <p>
                                                                <b>Apakah anda sering mengalami masalah berikut ?</b>
                                                            </p>
                                                            <p>
                                                                <?php echo $row['soal_3']; ?>
                                                            </p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <p>
                                                                <b>Bagaimana reaksi kulit anda dalam perubahan cuaca ?</b>
                                                            </p>
                                                            <p>
                                                                <?php echo $row['soal_4']; ?>
                                                            </p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <p>
                                                                <b>Apakah anda memiliki alergi terhadap bahan tertentu dalam produk skincare ?</b>
                                                            </p>
                                                            <p>
                                                                <?php echo $row['soal_5']; ?>
                                                            </p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <p>
                                                                <b>Jelaskan jika anda memiliki alergi terhadap bahan tertentu dalam produk skincare !</b>
                                                            </p>
                                                            <p>
                                                                <?php echo $row['soal_6']; ?>
                                                            </p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <p>
                                                                <b>Produk dan brand skincare apa yang sering atau cocok anda gunakan ?</b>
                                                            </p>
                                                            <p>
                                                                <?php echo $row['soal_7']; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <form action="<?php echo base_url ?>admin/?page=survey/update" method="POST">
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <td>
                                                                        Nama
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $row['nama']; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Jenis Kelamin
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $row['jenis_kelamin']; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Tanggal
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $row['tanggal']; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Jenis Kulit
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="jenis_kulit" class="form-control form-control-sm" value="<?php echo $row['jenis_kulit']; ?>">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Deskripsi
                                                                    </td>
                                                                    <td>
                                                                        <textarea name="deskripsi" class="form-control" rows="5"><?php echo $row['deskripsi'] ?></textarea>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <input type="hidden" value="<?php echo $row['id']; ?>" name="survey_id">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "0 results";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>