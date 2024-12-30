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
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5">
                        <p class="text-center">
                            Please select month and year
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>