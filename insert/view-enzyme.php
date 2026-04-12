<?php
include_once '../database/database.php';

$sql = "SELECT * FROM enzyme";
$result = $conn->query($sql);

$edit_id = isset($_GET['edit']) ? $conn->real_escape_string($_GET['edit']) : '';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>View Enzymes - ENZYMEBASE</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f4f8;
      margin: 0;
      padding: 0;
    }

    .header-box {
      background-color: #ffffff;
      border-bottom: 4px solid #0077cc;
      padding: 20px;
      text-align: center;
    }

    .header-title {
      font-size: 36px;
      color: #0077cc;
      margin: 0;
    }

    .container {
      max-width: 1000px;
      margin: 40px auto;
      background: #ffffff;
      padding: 30px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    h2 {
      color: #0077cc;
      text-align: center;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 12px;
      border: 1px solid #ddd;
    }

    th {
      background-color: #0077cc;
      color: white;
    }

    .action-btn {
  padding: 6px 15px;
  border-radius: 5px;
  text-decoration: none;
  color: white;
  font-size: 14px;
  border: none;
  cursor: pointer;
  margin-right: 8px;
}

.update-btn {
  background-color: #0077cc;
}

.delete-btn {
  background-color: red;
}
  </style>
</head>

<body>

<div class="header-box">
  <div class="header-title">ENZYMEBASE</div>
</div>

<div class="container">
<h2>All Enzymes</h2>

<?php

if ($result->num_rows > 0) {

    echo "<table>";
    echo "<tr>
        <th>ID</th>
        <th>EC Number</th>
        <th>Name</th>
        <th>Function</th>
        <th>UniProt</th>
        <th>Weight</th>
        <th>Action</th>
    </tr>";

    while($row = $result->fetch_assoc()) {

        echo "<tr>";
        echo "<td>{$row['enzyme_id']}</td>";
        echo "<td>{$row['enzymec_no']}</td>";
        echo "<td>{$row['enzyme_name']}</td>";
        echo "<td>{$row['enzyme_function']}</td>";
        echo "<td>{$row['uniprot_id']}</td>";
        echo "<td>{$row['mol_weight']}</td>";

        echo "<td>

<a href='view-enzyme.php?edit={$row['enzyme_id']}' 
class='action-btn update-btn'>Update</a>

<form method='POST' action='delete_enzyme.php' style='display:inline;' 
onsubmit='return confirm(\"Are you sure?\")'>

<input type='hidden' name='enzyme_id' value='{$row['enzyme_id']}'>

<button type='submit' class='action-btn delete-btn'>Delete</button>

</form>

</td>";

        echo "</tr>";

        // 🔥 EDIT FORM
        if ($edit_id == $row['enzyme_id']) {
            echo "<tr>
            <td colspan='7'>
            <form method='POST' action='update_enzyme.php'>

            <input type='hidden' name='enzyme_id' value='{$row['enzyme_id']}'>

            EC: <input name='enzymec_no' value='{$row['enzymec_no']}'><br>
            Name: <input name='enzyme_name' value='{$row['enzyme_name']}'><br>
            Function: <input name='enzyme_function' value='{$row['enzyme_function']}'><br>
            UniProt: <input name='uniprot_id' value='{$row['uniprot_id']}'><br>
            Weight: <input name='mol_weight' value='{$row['mol_weight']}'><br><br>

            <button type='submit' name='update'>Update</button>
            </form>
            </td>
            </tr>";
        }
    }

    echo "</table>";

} else {
    echo "No data found";
}

$conn->close();
?>

</div>
</body>
</html>