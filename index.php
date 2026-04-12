<!DOCTYPE html>
<html>
<head>
  <title>ENZYMEBASE</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f4f8;
    }

    .background-container {
      position: relative;
      min-height: 100vh;
      overflow: hidden;
    }

    .background-container::before {
      content: "";
      position: absolute;
      width: 100%;
      height: 100%;
      background-image: url('images/hexokinase_img.jpg');
      background-size: cover;
      background-position: center;
      opacity: 0.15;
      z-index: 1;
    }

    .overlay-content {
      position: relative;
      z-index: 2;
    }

    .header-box {
      background-color: #ffffff;
      border-bottom: 4px solid #0077cc;
      padding: 25px 10px;
      text-align: center;
    }

    .header-title {
      font-size: 52px;
      color: #0077cc;
      font-family: 'Trebuchet MS', sans-serif;
    }

    .header-description {
      font-size: 18px;
      color: #555;
      max-width: 700px;
      margin: auto;
    }

    .content {
      padding: 40px 20px;
      text-align: center;
    }

    .explore-text {
      font-size: 18px;
      margin-bottom: 20px;
      font-style: italic;
    }

    .search-bar {
      display: flex;
      justify-content: center;
      width: 60%;
      margin: auto;
    }

    .search-bar input {
      flex: 1;
      padding: 12px;
      font-size: 18px;
      border: 2px solid #0077cc;
      border-radius: 5px 0 0 5px;
    }

    .search-bar button {
      padding: 12px 20px;
      background-color: #0077cc;
      color: white;
      border: none;
      border-radius: 0 5px 5px 0;
      cursor: pointer;
    }

    .button-row {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 30px;
      flex-wrap: wrap;
    }

    .big-button {
      background-color: #0077cc;
      color: white;
      font-size: 20px;
      padding: 30px 20px;
      border-radius: 15px;
      width: 220px;
      text-decoration: none;
      text-align: center;
    }

    .big-button i {
      font-size: 30px;
      display: block;
      margin-bottom: 10px;
    }

    .big-button:hover {
      background-color: #005fa3;
    }
  </style>
</head>

<body>

<div class="background-container">
<div class="overlay-content">

<div class="header-box">
  <div class="header-title">ENZYMEBASE</div>
  <div class="header-description">
    Your curated gateway to enzyme data – from reactions and kinetics to organisms and cofactors.
  </div>
</div>

<div class="content">

<div class="explore-text">Explore enzyme reactions and more...</div>

<!-- SEARCH -->
<form action="search/search_homebar.php" method="GET" class="search-bar">
  <input type="text" name="query" placeholder="Search enzymes, reactions, or organisms..." required>
  <button type="submit"><i class="fas fa-search"></i></button>
</form>

<div class="button-row">
  <a href="pages/enzymepage.html" class="big-button"><i class="fas fa-dna"></i>ENZYME</a>
  <a href="pages/reactionpage.html" class="big-button"><i class="fas fa-exchange-alt"></i>REACTION</a>
  <a href="pages/organismpage.html" class="big-button"><i class="fas fa-bug"></i>ORGANISM</a>
</div>

<div class="button-row">
  <a href="pages/kineticspage.html" class="big-button"><i class="fas fa-chart-line"></i>KINETIC</a>
  <a href="pages/cofactorpage.html" class="big-button"><i class="fas fa-vial"></i>COFACTORS</a>
</div>

</div>
</div>
</div>

</body>
</html>