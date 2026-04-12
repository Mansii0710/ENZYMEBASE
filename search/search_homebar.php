<?php
include_once '../database/database.php';

if (!isset($_GET['query']) || empty(trim($_GET['query']))) {
    echo "Please enter an enzyme to search.";
    exit;
}

$query = trim($_GET['query']);

$stmt = $conn->prepare("SELECT * FROM enzyme WHERE enzyme_name LIKE ? LIMIT 1");
$search = "%" . $query . "%";
$stmt->bind_param("s", $search);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $enzyme = $result->fetch_assoc();

    echo '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>' . htmlspecialchars($enzyme['enzyme_name']) . ' | Enzyme Info</title>

        <style>
            body {
                font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f4f4f9;
                margin: 20px;
                padding: 0;
                color: #333;
            }

            .header-box {
                background-color: #fff;
                border-bottom: 3px solid #0077cc;
                padding: 10px 15px;
                text-align: center;
                position: relative;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                margin-bottom: 20px;
            }

            .header-title {
                font-size: 28px;
                color: #0077cc;
                font-weight: bold;
                margin: 0;
            }

            .download-button {
                position: absolute;
                right: 15px;
                top: 12px;
                padding: 7px 14px;
                background-color: #0077cc;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 13px;
            }

            .enzyme-card {
                background: #ffffff;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                padding: 20px;
                max-width: 600px;
                margin: auto;
            }

            .enzyme-card p {
                font-size: 16px;
                color: #555;
                line-height: 1.6;
            }

            /* ✅ ADDED BUTTON STYLE */
            .related-btn {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 18px;
                background-color: #0077cc;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                font-weight: bold;
            }

            .related-btn:hover {
                background-color: #005fa3;
            }
        </style>
    </head>

    <body>

        <div class="header-box">
            <div class="header-title">' . htmlspecialchars($enzyme['enzyme_name']) . ' (EC ' . htmlspecialchars($enzyme['enzymec_no']) . ')</div>
            <button class="download-button" onclick="window.print()">Download PDF</button>
        </div>

        <div class="enzyme-card">
            <p><strong>Enzyme ID:</strong> ' . htmlspecialchars($enzyme['enzyme_id']) . '</p>
            <p><strong>Function:</strong> ' . htmlspecialchars($enzyme['enzyme_function']) . '</p>
            <p><strong>UniProt ID:</strong> ' . htmlspecialchars($enzyme['uniprot_id']) . '</p>
            <p><strong>Molecular Weight:</strong> ' . htmlspecialchars($enzyme['mol_weight']) . ' kDa</p>

            ' . (
    strpos(strtolower($enzyme['enzyme_name']), 'hexokinase') !== false 
    ? '<a href="../pages/hexokinase.html" class="related-btn">View Related Information</a>' 
    : (strpos(strtolower($enzyme['enzyme_name']), 'alcohol') !== false 
        ? '<a href="../pages/alcohol_dehydrogenase.html" class="related-btn">View Related Information</a>' 
        : ''
    )
) . '
        </div>

    </body>
    </html>';
} else {
    echo "No results found.";
}

$conn->close();
?>