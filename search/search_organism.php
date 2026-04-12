<?php
include_once '../database/database.php'; // ✅ FIXED PATH

$allowed = ['org_id','enzyme_id','sci_name','comm_name','tax_id'];
$column  = (isset($_GET['column']) && in_array($_GET['column'], $allowed))
           ? $_GET['column'] : 'sci_name';

$query   = isset($_GET['query']) ? trim($_GET['query']) : '';

$results = [];
$searched = false;

if (!empty($query)) {
    $searched = true;

    // ✅ SAFE COLUMN CHECK
    if(!in_array($column, $allowed)){
        $column = 'sci_name';
    }

    $sql = "SELECT * FROM organism WHERE $column LIKE ?";
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
  <title>Organisms - EnzymeBase</title>
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
    <div class="heading">ORGANISMS</div>
    <div class="subheading">Explore organisms that produce or interact with enzymes</div>

    <div class="search-container">
      <!-- ✅ SAME PAGE FORM -->
      <form action="" method="GET">
        <select name="column">
          <option value="org_id"    <?php if($column=='org_id') echo 'selected'; ?>>Organism ID</option>
          <option value="enzyme_id" <?php if($column=='enzyme_id') echo 'selected'; ?>>Enzyme ID</option>
          <option value="sci_name"  <?php if($column=='sci_name') echo 'selected'; ?>>Scientific Name</option>
          <option value="comm_name" <?php if($column=='comm_name') echo 'selected'; ?>>Common Name</option>
          <option value="tax_id"    <?php if($column=='tax_id') echo 'selected'; ?>>Taxonomy ID</option>
        </select>

        <input type="text" name="query" placeholder="Search value..."
               value="<?php echo htmlspecialchars($query); ?>">

        <button type="submit">Search</button>
      </form>
    </div>

    <?php if ($searched): ?>
      <?php if (empty($results)): ?>
        <p class="no-results">No organisms found for "<strong><?php echo htmlspecialchars($query); ?></strong>".</p>
      <?php else: ?>
        <table class="results-table">
          <tr>
            <th>Org ID</th><th>Enzyme ID</th><th>Scientific Name</th>
            <th>Common Name</th><th>Taxonomy ID</th>
          </tr>

          <?php foreach ($results as $row): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['org_id']); ?></td>
            <td><?php echo htmlspecialchars($row['enzyme_id']); ?></td>
            <td><em><?php echo htmlspecialchars($row['sci_name']); ?></em></td>
            <td><?php echo htmlspecialchars($row['comm_name']); ?></td>
            <td><?php echo htmlspecialchars($row['tax_id']); ?></td>
          </tr>
          <?php endforeach; ?>

        </table>
      <?php endif; ?>
    <?php else: ?>
      <div class="facts-section">
        <h3>Did You Know?</h3>
        <p>Organisms are the natural source of enzymes used in biotechnology.</p>
        <p>Biodiversity plays a huge role in enzyme discovery.</p>
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