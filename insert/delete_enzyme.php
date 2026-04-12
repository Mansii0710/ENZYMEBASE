<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../database/database.php';

if(isset($_POST['enzyme_id']))
{
    $enzyme_id = $_POST['enzyme_id'];

    $stmt = $conn->prepare("DELETE FROM enzyme WHERE enzyme_id=?");
    $stmt->bind_param("s", $enzyme_id);

    if($stmt->execute()){
        echo "<script>
            alert('Deleted successfully!');
            window.location.href='view-enzyme.php';
        </script>";
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}

$conn->close();
?>