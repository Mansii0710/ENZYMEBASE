<?php
include_once '../database/database.php';

if(isset($_POST['update']))
{
    $enzyme_id = $_POST['enzyme_id'];
    $enzymec_no = $_POST['enzymec_no'];
    $enzyme_name = $_POST['enzyme_name'];
    $enzyme_function = $_POST['enzyme_function'];
    $uniprot_id = $_POST['uniprot_id'];
    $mol_weight = $_POST['mol_weight'];

    $stmt = $conn->prepare(
        "UPDATE enzyme 
         SET enzymec_no=?, enzyme_name=?, enzyme_function=?, uniprot_id=?, mol_weight=? 
         WHERE enzyme_id=?"
    );

    $stmt->bind_param("ssssds",
        $enzymec_no,
        $enzyme_name,
        $enzyme_function,
        $uniprot_id,
        $mol_weight,
        $enzyme_id
    );

    if($stmt->execute()){
        echo "<script>
            alert('Updated successfully!');
            window.location.href='view-enzyme.php';
        </script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

$conn->close();
?>