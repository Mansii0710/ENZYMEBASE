<?php
include_once '../database/database.php'; // ✅ FIXED PATH

$allowed = ['cof_id','enzyme_id','cof_name','role'];
$column  = (isset($_GET['column']) && in_array($_GET['column'], $allowed))
           ? $_GET['column'] : 'cof_name';

$query   = isset($_GET['query']) ? trim($_GET['query']) : '';
$results = [];
$searched = false;

if (!empty($query)) {
    $searched = true;

    // ✅ EXTRA SAFETY CHECK
    if(!in_array($column, $allowed)){
        $column = 'cof_name';
    }

    $sql = "SELECT * FROM cofactor WHERE $column LIKE ?";
    $stmt = mysqli_prepare($conn, $sql);

    $like = "%$query%";
    mysqli_stmt_bind_param($stmt, "s", $like);
    mysqli_stmt_execute($stmt);

    $rs = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($rs)) { 
        $results[] = $row; 
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Cofactors - EnzymeBase</title>
  <style>
    * { box-sizing: border-box; }
    body { margin:0; padding:0; font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
           background:#f0f4f8; color:#333; display:flex; flex-direction:column; min-height:100vh; }
    .header-box { background:#0077cc; border-bottom:4px solid #005fa3; padding:25px 10px;
                  text-align:center; box-shadow:0 4px 6px rgba(0,0,0,0.1); }
    .header-title { font-size:52px; color:white; margin:0; font-family:'Trebuchet MS',sans-serif; }
    .heading    { font-size:52px; color:#0077cc; text-align:center; margin-top:20px; font-family:'Trebuchet MS',sans-serif; }
    .subheading { font-size:20px; color:#0077cc; text-align:center; margin-top:10px; font-family:'Trebuchet MS',sans-serif; }
    .search-container { text-align:center; margin-top:20px; }
    .search-container form { display:inline-flex; align-items:center; gap:10px; flex-wrap:wrap; justify-content:center; }
    .search-container input[type="text"] { background:#fff; color:#333; padding:15px;
      border:2px solid #0077cc; border-radius:5px; font-size:16px; width:250px; }
    .search-container select { padding:15px; border:2px solid #0077cc; border-radius:5px;
      font-size:16px; background:#fff; color:#333; }
    .search-container button { background:#0077cc; color:white; padding:15px 18px;
      border:none; border-radius:5px; font-size:16px; font-family:'Trebuchet MS',sans-serif; cursor:pointer; }
    .results-table { width:90%; margin:30px auto; border-collapse:collapse; background:white;
                     box-shadow:0 5px 15px rgba(0,0,0,0.05); }
    .results-table th { background:#0077cc; color:white; padding:12px; text-align:center; }
    .results-table td { padding:12px; border-bottom:1px solid #ddd; text-align:center; }
    .results-table tr:hover { background:#e6f2ff; }
    .no-results { text-align:center; color:#666; font-size:18px; margin:40px auto; }
    .action-button { display:inline-block; background:#0077cc; color:white; padding:15px 25px;
      border:none; border-radius:5px; font-size:18px; font-family:'Trebuchet MS',sans-serif;
      margin:10px; cursor:pointer; text-decoration:none; }
    .action-button:hover { background:#005fa3; }
    .facts-section { max-width:900px; margin:30px auto; padding:10px; background:#f9f9f9;
      border-left:6px solid #0077cc; border-radius:8px; box-shadow:0 5px 15px rgba(0,0,0,0.05); }
    footer { text-align:center; background:#e1f0ff; font-size:14px; color:#555;
             margin-top:auto; padding:20px 0; }
    .info1 { display:flex; justify-content:center; gap:30px; flex-wrap:wrap;
             font-family:'Trebuchet MS',sans-serif; font-size:16px; color:#333; }
    .icon-text { display:inline-flex; align-items:center; gap:8px; }
    main { flex-grow:1; }
  </style>
</head>
<body>

  <div class="header-box"><div class="header-title">ENZYMEBASE</div></div>

  <main>
    <div class="heading">COFACTORS</div>
    <div class="subheading">Add new cofactor entries linked to enzymes and roles</div>

    <div class="search-container">
      <!-- ✅ SAME PAGE FORM -->
      <form action="" method="GET">
        <input type="text" name="query" placeholder="Search value..."
               value="<?php echo htmlspecialchars($query); ?>">

        <select name="column">
          <option value="cof_id"    <?php if($column=='cof_id') echo 'selected'; ?>>Cofactor ID</option>
          <option value="enzyme_id" <?php if($column=='enzyme_id') echo 'selected'; ?>>Enzyme ID</option>
          <option value="cof_name"  <?php if($column=='cof_name') echo 'selected'; ?>>Cofactor Name</option>
          <option value="role"      <?php if($column=='role') echo 'selected'; ?>>Role</option>
        </select>

        <button type="submit">Search</button>
      </form>
    </div>

    <?php if ($searched): ?>
      <?php if (empty($results)): ?>
        <p class="no-results">No cofactors found for "<strong><?php echo htmlspecialchars($query); ?></strong>".</p>
      <?php else: ?>
        <table class="results-table">
          <tr><th>Cofactor ID</th><th>Enzyme ID</th><th>Cofactor Name</th><th>Role</th></tr>

          <?php foreach ($results as $row): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['cof_id']); ?></td>
            <td><?php echo htmlspecialchars($row['enzyme_id']); ?></td>
            <td><?php echo htmlspecialchars($row['cof_name']); ?></td>
            <td><?php echo htmlspecialchars($row['role']); ?></td>
          </tr>
          <?php endforeach; ?>

        </table>
      <?php endif; ?>
    <?php else: ?>
      <div class="facts-section">
        <h3>Did You Know?</h3>
        <p>Cofactors assist enzymes in catalysis and are essential for activity.</p>
        <p>Many vitamins act as enzyme cofactors in metabolic reactions.</p>
      </div>
    <?php endif; ?>

  </main>

  <footer>
    <div class="info1">
      <!-- ✅ FIXED IMAGE PATHS -->
      <div class="icon-text"><img src="../images/call.png" height="20"><span>+91 8459687840</span></div>
      <div class="icon-text"><img src="../images/email.png" height="20"><span>enzymebasequeries@gmail.com</span></div>
      <div class="icon-text"><img src="../images/address.png" height="20"><span>Manipal, India</span></div>
      <div class="icon-text"><img src="../images/linkedin.png" height="20"><span>ENZYMEBASE</span></div>
    </div>
    <p>&copy; 2025 ENZYMEBASE Project</p>
  </footer>

</body>
</html>