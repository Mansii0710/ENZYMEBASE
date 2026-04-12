<?php
include_once '../database/database.php';

if(isset($_POST['save']))
{
    $kin_id = $_POST['kin_id'];
    $enzyme_id = $_POST['enzyme_id'];
    $org_id = $_POST['org_id'];
    $substrate = $_POST['substrate'];
    $km_value = $_POST['km_value'];
    $vmax_value = $_POST['vmax_value'];
    $reac_id = $_POST['reac_id'];

    $stmt = $conn->prepare(
        "INSERT INTO kinetics (kin_id, enzyme_id, org_id, substrate, km_value, vmax_value, reac_id)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param("ssssdds",
        $kin_id,
        $enzyme_id,
        $org_id,
        $substrate,
        $km_value,
        $vmax_value,
        $reac_id
    );

    if ($stmt->execute()) {
        ?>
        <html><body style="display:flex;justify-content:center;align-items:center;height:100vh;background:#f0f8ff;">
        <div style="text-align:center;font-size:24px;color:blue;">
        <div style="font-size:48px;color:green;">✔️</div>
        Kinetics inserted successfully!!
        </div>
        </body></html>
        <?php
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}

$conn->close();
?>