<?php
include_once '../database/database.php';

if(isset($_POST['save']))
{
    $cof_id = $_POST['cof_id'];
    $enzyme_id = $_POST['enzyme_id'];
    $cof_name = $_POST['cof_name'];
    $role = $_POST['role'];

    $stmt = $conn->prepare(
        "INSERT INTO cofactor (cof_id, enzyme_id, cof_name, role)
         VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param("ssss",
        $cof_id,
        $enzyme_id,
        $cof_name,
        $role
    );

    if ($stmt->execute()) {
        ?>
        <html><body style="display:flex;justify-content:center;align-items:center;height:100vh;background:#f0f8ff;">
        <div style="text-align:center;font-size:24px;color:blue;">
        <div style="font-size:48px;color:green;">✔️</div>
        Cofactor inserted successfully!!
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