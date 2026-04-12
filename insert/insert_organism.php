<?php
include_once '../database/database.php';

if(isset($_POST['save']))
{
    $org_id = $_POST['org_id'];
    $enzyme_id = $_POST['enzyme_id'];
    $sci_name = $_POST['sci_name'];
    $comm_name = $_POST['comm_name'];
    $tax_id = $_POST['tax_id'];

    $stmt = $conn->prepare(
        "INSERT INTO organism (org_id, enzyme_id, sci_name, comm_name, tax_id)
         VALUES (?, ?, ?, ?, ?)"
    );

    $stmt->bind_param("sssss",
        $org_id,
        $enzyme_id,
        $sci_name,
        $comm_name,
        $tax_id
    );

    if ($stmt->execute()) {
        ?>
        <html><body style="display:flex;justify-content:center;align-items:center;height:100vh;background:#f0f8ff;">
        <div style="text-align:center;font-size:24px;color:blue;">
        <div style="font-size:48px;color:green;">✔️</div>
        Organism inserted successfully!!
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