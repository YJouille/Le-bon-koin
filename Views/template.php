<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="petites annonces">

  <title>Le bon Koin</title>
  <!-- Bootstrap core CSS -->
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
 
  <!-- Favicon -->
  <!-- <link rel="icon" type="image/gif" href="./assets/icons/favicon.svg" /> -->
  <!-- CSS -->
  <link href="./Assets/style.css" rel="stylesheet">
</head>

<body>
<header>
  <nav>
  <ul class="nav nav-pills d-flex align-items-center justify-content-around">
    <li class="nav-item">
      <a class="nav-link" href=""><h2>Le Bon Koin</h2></a>
    </li>
    <li class="nav-item addAnnonce">
      <a class="nav-link" href="https://www.youtube.com/"><img src="" alt="">déposer une annonce</a>
    </li>
    <li class="nav-item">
      <input type="text" name="" value="" placeholder="Rechercher une annonce">
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"><img class="logoAccount" src="../Assets/img/user.png"" alt="Logo account"></a>
    </li>
  </ul>  
</nav>   
</header>

<section><?= $content?></section>

<footer class="footer">
    copyright
</footer>
</body>


