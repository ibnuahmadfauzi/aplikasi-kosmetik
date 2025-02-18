    <section class="py-2">
        <div class="container">
            <div class="card rounded-0">
                <div class="card-body">
                    <div class="w-100 justify-content-between d-flex">
                        <h4><b>Orders</b></h4>
                        <div>
                            <a href="./?p=view_survey" class="btn btn btn-default btn-flat bg-maroon">
                                <div class="fa fa-list"></div> Isi Survey
                            </a>
                            <button type="button" class="btn btn btn-default btn-flat bg-maroon" data-toggle="modal" data-target="#hasilSurveyModal">
                                <div class="fa fa-list"></div> Hasil Survey
                            </button>
                            <a href="./?p=edit_account" class="btn btn btn-default btn-flat bg-maroon">
                                <div class="fa fa-user-cog"></div> Manage Account
                            </a>
                        </div>
                    </div>
                    <hr class="border-warning">
                    <table class="table table-stripped text-dark">
                        <colgroup>
                            <col width="10%">
                            <col width="15">
                            <col width="25">
                            <col width="25">
                            <col width="15">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DateTime</th>
                                <th>Transaction Ref Code</th>
                                <th>Amount</th>
                                <th>Order Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $qry = $conn->query("SELECT o.*,concat(c.firstname,' ',c.lastname) as client from `orders` o inner join clients c on c.id = o.client_id where o.client_id = '" . $_settings->userdata('id') . "' order by unix_timestamp(o.date_created) desc ");
                            while ($row = $qry->fetch_assoc()):
                            ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                                    <td><a href="javascript:void(0)" class="view_order" data-id="<?php echo $row['id'] ?>"><?php echo $row['ref_code'] ?></a></td>
                                    <td><?php echo number_format($row['amount']) ?> </td>
                                    <td class="text-center">
                                        <?php if ($row['status'] == 0): ?>
                                            <span class="badge badge-light text-dark border px-3 rounded-pill">Pending</span>
                                        <?php elseif ($row['status'] == 1): ?>
                                            <span class="badge badge-primary px-3 rounded-pill">Packed</span>
                                        <?php elseif ($row['status'] == 2): ?>
                                            <span class="badge badge-warning px-3 rounded-pill">Out for Delivery</span>
                                        <?php elseif ($row['status'] == 3): ?>
                                            <span class="badge badge-success px-3 rounded-pill">Delivered</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger px-3 rounded-pill">Cancelled</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="hasilSurveyModal" tabindex="-1" aria-labelledby="hasilSurveyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hasilSurveyModalLabel">Daftar Survey</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal Survey</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $akun_id = $_settings->userdata('id');
                            $sql = "SELECT id, nama, tanggal, akun_id FROM jawaban_survey WHERE akun_id=$akun_id";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?php echo $row['tanggal']; ?></td>
                                        <td><?php echo $row['nama']; ?></td>
                                        <td>
                                            <form action="./?p=hasil_survey" method="POST">
                                                <input type="hidden" name="id-survey" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-primary">Lihat Hasil</button>
                                            </form>
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
        </div>
    </div>
    <script>
        function cancel_book($id) {
            start_loader()
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=update_book_status",
                method: "POST",
                data: {
                    id: $id,
                    status: 2
                },
                dataType: "json",
                error: err => {
                    console.log(err)
                    alert_toast("an error occured", 'error')
                    end_loader()
                },
                success: function(resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {
                        alert_toast("Book cancelled successfully", 'success')
                        setTimeout(function() {
                            location.reload()
                        }, 2000)
                    } else {
                        console.log(resp)
                        alert_toast("an error occured", 'error')
                    }
                    end_loader()
                }
            })
        }
        $(function() {
            $('.view_order').click(function() {
                uni_modal("Order Details", "./admin/orders/view_order.php?view=user&id=" + $(this).attr('data-id'), 'large')
            })
            $('table').dataTable();

        })
    </script>