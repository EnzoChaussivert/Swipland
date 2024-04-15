<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style_index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Monoton&display=swap">
    <title>FilmIt !</title>
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
        <li><a href="index.php" class="nav-link">Accueil</a></li>
        <li><a href="liste.php" class="nav-link">Rechercher</a></li>
        <li><a href="votre_liste.php" class="nav-link">Votre Liste</a></li>
        <li>
            <?php
            // Démarrer la session
            session_start();

            // Vérifier si l'utilisateur est connecté
            if (isset($_SESSION['utilisateur'])) {
                echo '<a href="deconnexion.php" class="nav-link">Déconnexion</a>';
            } else {
                echo '<a href="login.php" class="nav-link">Connexion</a>';
            }
            ?>
        </li>
        <li>
            <?php
            // Vérifier si l'utilisateur est connecté
            if (isset($_SESSION['utilisateur'])) {
                echo '<span class="nav-link">Bienvenue ' . $_SESSION['utilisateur'] . ' !</span>';
            }
            ?>
        </li>
    </ul>
</nav>

<header class="header">
    <div class="film">
        <div class="left-button">
            <button class="left-button-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#28b17c" class="bi bi-heart-fill" viewBox="0 -1.5 16 16">
                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                </svg>
            </button>
        </div>
        <img id="moviePoster" src="" alt="Movie Poster">
        <!-- ajout du film dans la base de donnée mysql en php -->
        <?php
            // Connexion à la base de données
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=filmit;charset=utf8', 'root', '');
            } catch(Exception $e) {
                // Gestion des erreurs de connexion à la base de données
                die('Erreur : '.$e->getMessage());
            }

            // Vérification de la méthode de la requête (POST)
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['title'])) {
                try {
                    // Préparation de la requête
                    $req = $bdd->prepare('INSERT INTO film(Titre) VALUES(:titre)');
                    // Exécution de la requête avec les valeurs récupérées de la requête AJAX
                    $req->execute(array(
                        'titre' => $_POST['title']
                    ));
                } catch(Exception $e) {
                    // Gestion des erreurs d'exécution de la requête
                    die('Erreur : '.$e->getMessage());
                }
            }
        ?>

        <div class="right-button">
            <button class="right-button-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="Red" class="bi bi-x-lg" viewBox="0 -0.5 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                </svg>
            </button>
        </div>
    </div>
</header>

<script src="scripts/script_index.js"></script>
</body>
</html>
