<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style_liste.css">
    <title>Movie App</title>
</head>
<body>
    <nav class="navbar">
        <a href="#" class="logo">
            <h1 class="logo_title">
                <img src="./images/logo.png" alt="Logo FilmIt" class="logo">
                <span>FilmIt!</span>
            </h1>
        </a>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="#">Rechercher</a></li>
            <li><a href="liste.php">Votre Liste</a></li>
            <li><a href="login.php">Profil</a></li>
        </ul>
    </nav>
    
    <header>
        <form  id="form">
            <input type="text" placeholder="Search" id="search" class="search">
        </form>
    </header>
    <div id="tags"></div>
    <div id="myNav" class="overlay">

        <!-- Button to close the overlay navigation -->
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      
        <!-- Overlay content -->
        <div class="overlay-content" id="overlay-content"></div>
        
        <a href="javascript:void(0)" class="arrow left-arrow" id="left-arrow">&#8656;</a> 
        
        <a href="javascript:void(0)" class="arrow right-arrow" id="right-arrow" >&#8658;</a>

      </div>
    <main id="main"></main>
    <div class="pagination">
        <div class="page" id="prev">Previous Page</div>
        <div class="current" id="current">1</div>
        <div class="page" id="next">Next Page</div>

    </div>

    <script src="scripts/script_liste.js"></script>
</body>
</html>