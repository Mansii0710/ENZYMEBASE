<?php
include_once '../database/database.php';

if(isset($_POST['save']))
{
    $reac_id = $_POST['reac_id'];
    $enzyme_id = $_POST['enzyme_id'];
    $substrate = $_POST['substrate'];
    $product = $_POST['product'];
    $reac_eqn = $_POST['reac_eqn'];
    $pathway = $_POST['pathway'];
    $opt_ph = $_POST['opt_ph'];
    $opt_temp = $_POST['opt_temp'];
    $inhibitors = $_POST['inhibitors'];

    $stmt = $conn->prepare(
        "INSERT INTO reaction (reac_id, enzyme_id, substrate, product, reac_eqn, pathway, opt_ph, opt_temp, inhibitors)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param("ssssssdds",
        $reac_id,
        $enzyme_id,
        $substrate,
        $product,
        $reac_eqn,
        $pathway,
        $opt_ph,
        $opt_temp,
        $inhibitors
    );

    if ($stmt->execute()) {
        ?>
        <html><body style="display:flex;justify-content:center;align-items:center;height:100vh;background:#f0f8ff;">
        <div style="text-align:center;font-size:24px;color:blue;">
        <div style="font-size:48px;color:green;">✔️</div>
        Reaction inserted successfully!!
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