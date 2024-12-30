<?php
$jenis_kulit = $_POST['jenis_kulit'];
$deskripsi = $_POST['deskripsi'];
$survey_id = $_POST['survey_id'];

$sql = "UPDATE jawaban_survey SET jenis_kulit='$jenis_kulit', deskripsi='$deskripsi' WHERE id=$survey_id";

if ($conn->query($sql) === TRUE) {
?>
    <script>
        window.location.href = "<?php echo base_url ?>admin/?page=survey";
    </script>
<?php
} else {
    echo "Error updating record: " . $conn->error;
}
