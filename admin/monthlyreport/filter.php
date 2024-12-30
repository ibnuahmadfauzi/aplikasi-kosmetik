<?php
$monthFilter = $_POST['month-filter'];
$yearFilter = $_POST['year-filter'];
?>

<style>
    table td,
    table th {
        padding: 3px !important;
    }
</style>
<?php
$date_start = isset($_GET['date_start']) ? $_GET['date_start'] :  date("Y-m-d", strtotime(date("Y-m-d") . " -7 days"));
$date_end = isset($_GET['date_end']) ? $_GET['date_end'] :  date("Y-m-d");
?>
<div class="card card-primary card-outline">
    <div class="card-header">
        <h5 class="card-title">Monthly Report</h5>
    </div>
    <div class="card-body">
        <form id="filter-form" action="<?php echo base_url ?>admin/?page=monthlyreport/filter" method="POST">
            <div class="row align-items-end">
                <div class="form-group col-md-3">
                    <label for="month-filter">Month</label>
                    <select class="form-control" id="month-filter" name="month-filter" required>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="year-filter">Year</label>
                    <select class="form-control" id="year-filter" name="year-filter" required>
                        <?php
                        $currentYear = date("Y"); // Mendapatkan tahun sekarang
                        $startYear = $currentYear - 50; // 50 tahun ke belakang

                        for ($year = $currentYear; $year >= $startYear; $year--) {
                            echo "<option value=\"$year\">$year</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-1">
                    <button type="submit" class="btn btn-flat btn-block btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button>
                </div>
                <div class="form-group col-md-1">
                    <button class="btn btn-flat btn-block btn-success btn-sm" type="button" id="printBTN"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
        </form>
        <table class="table table-bordered" id="monthly-report-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_money = 0;
                $transaction_amount = 0;
                $sql = "SELECT *  FROM sales WHERE MONTH(date_created) = $monthFilter AND YEAR(date_created) = $yearFilter";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td>
                                <?php echo $row['date_created']; ?>
                            </td>
                            <td>
                                <?php
                                $orderId = $row['order_id'];
                                $sqlGetClientId = "SELECT client_id  FROM orders WHERE id=$orderId";
                                $resultGetClientId = $conn->query($sqlGetClientId);
                                if ($resultGetClientId->num_rows > 0) {
                                    // output data of each row
                                    while ($rowGetClientId = $resultGetClientId->fetch_assoc()) {
                                        $id_client = $rowGetClientId['client_id'];
                                        $sqlGetName = "SELECT firstname, lastname FROM clients WHERE id=$id_client";
                                        $resultGetName = $conn->query($sqlGetName);
                                        if ($resultGetName->num_rows > 0) {
                                            // output data of each row
                                            while ($rowGetName = $resultGetName->fetch_assoc()) {
                                                echo $rowGetName['firstname'] . " " . $rowGetName['lastname'];
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                    }
                                } else {
                                    echo "0 results";
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $row['total_amount'];
                                $total_money += $row['total_amount'];
                                ?>
                            </td>
                        </tr>
                <?php
                        $transaction_amount++;
                    }
                } else {
                    echo "0 results";
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Total Amount</th>
                    <th><?php echo $total_money; ?></th>
                </tr>
                <tr>
                    <th colspan="2">Transaction Amount</th>
                    <th><?php echo $transaction_amount; ?></th>
                </tr>
                <tr>
                    <th colspan="2">Month</th>
                    <th>
                        <?php
                        $monthName = DateTime::createFromFormat('!m', $monthFilter)->format('F');
                        echo $monthName;
                        ?>
                    </th>
                </tr>
                <tr>
                    <th colspan="2">Year</th>
                    <th><?php echo $yearFilter; ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#printBTN').on('click', function() {
            // Ambil isi tabel
            var tableContent = $('#monthly-report-table').prop('outerHTML');

            // Gaya custom
            var customStyles = `
                <style>
                    table {
                        border-collapse: collapse;
                        width: 100%;
                    }
                    table, th, td {
                        border: 1px solid black;
                    }
                    th, td {
                        padding: 8px;
                        text-align: left;
                    }
                    th {
                        background-color: #f2f2f2;
                    }
                </style>
            `;

            // Buka jendela baru
            var newWindow = window.open('', '', 'width=800, height=600');

            // Tulis konten tabel dan gaya ke dalam jendela baru
            newWindow.document.write(`
                <html>
                    <head>
                        <title>Print Table</title>
                        ${customStyles} <!-- Tambahkan gaya custom -->
                    </head>
                    <body>
                        ${tableContent}
                    </body>
                </html>
            `);

            // Cetak konten
            newWindow.document.close();
            newWindow.print();

            // Tutup jendela setelah print
            newWindow.close();
        });
    });
</script>