<?php

include_once '../database/database.php';

if(isset($_POST['save']))
{
    $enzyme_id = $_POST['enzyme_id'];
    $enzymec_no = $_POST['enzymec_no'];
    $enzyme_name = $_POST['enzyme_name'];
    $enzyme_function = $_POST['enzyme_function'];
    $uniprot_id = $_POST['uniprot_id'];
    $mol_weight = $_POST['mol_weight'];

    $stmt = $conn->prepare(
        "INSERT INTO enzyme (enzyme_id, enzymec_no, enzyme_name, enzyme_function, uniprot_id, mol_weight)
         VALUES (?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param("sssssd",
        $enzyme_id,
        $enzymec_no,
        $enzyme_name,
        $enzyme_function,
        $uniprot_id,
        $mol_weight
    );

    if ($stmt->execute()) {
        ?>
        <!DOCTYPE html>
        <html>
        <head><meta charset="UTF-8"><title>Success</title></head>
        <body style="display:flex;justify-content:center;align-items:center;height:100vh;">
            <div style="text-align:center;">
                <h2 style="color:green;">✔️ Record inserted successfully!</h2>
                <a href="insert_enzyme.php">Add Another</a>
            </div>
        </body>
        </html>
        <?php
        exit;
    } else {
       if (strpos($stmt->error, 'Duplicate entry') !== false) {
        echo "<script>alert('Enzyme ID already exists! Use a different ID.'); window.history.back();</script>";
    } else {
        echo "Error inserting record: " . $stmt->error;
    }
}
} 
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Enzyme</title>

<style>
body {
    font-family: Arial;
    background: #f0f4f8;
    text-align: center;
}

form {
    background: white;
    padding: 20px;
    margin: 40px auto;
    width: 400px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

input {
    width: 90%;
    padding: 10px;
    margin: 8px;
}

button {
    padding: 10px 20px;
    background: #0077cc;
    color: white;
    border: none;
    border-radius: 5px;
}
</style>

</head>

<body>

<h2>Add Enzyme</h2>

<form method="POST" action="insert_enzyme.php">
    <input type="text" name="enzyme_id" placeholder="Enzyme ID" required><br>
    <input type="text" name="enzymec_no" placeholder="EC Number" required><br>
    <input type="text" name="enzyme_name" placeholder="Enzyme Name" required><br>
    <input type="text" name="enzyme_function" placeholder="Function" required><br>
    <input type="text" name="uniprot_id" placeholder="UniProt ID" required><br>
    <input type="number" step="0.01" name="mol_weight" placeholder="Molecular Weight" required><br><br>

    <button type="submit" name="save">Insert</button>
</form>

</body>
</html>