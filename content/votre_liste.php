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
        <a href="index.php" class="logo">
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
    
    <header>
        <form  id="form">
            <input type="text" placeholder="Search" id="search" class="search">
        </form>
    </header>
    </div>
    <?php
    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['utilisateur'])) {
        // Récupérer l'ID de l'utilisateur connecté
        $id_utilisateur = $_SESSION['id_utilisateur'];

        // Connexion à la base de données
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=filmit;charset=utf8', 'root', '');

            // Requête SQL pour récupérer les films vus par l'utilisateur
            $stmt = $bdd->prepare('SELECT titre_film, vu FROM visionnages WHERE id_utilisateur = :id_utilisateur');
            $stmt->execute(array('id_utilisateur' => $id_utilisateur));

            // Affichage des résultats
            echo '<ul>';
            while ($row = $stmt->fetch()) {
                if ($row['vu'] == 1) {
                    echo '<li>' . $row['titre_film'] . ' (vu)</li>';
                } else {
                    echo '<li>' . $row['titre_film'] . ' <b>(À VOIR !)</b></li>';
                }
            }
            echo '</ul>';

            $bdd = null;
        } catch (Exception $e) {
            // Gestion des erreurs de connexion à la base de données
            echo 'Erreur : ' . $e->getMessage();
        }
    } else {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        header('Location: login.php');
        exit();
    }
    ?>
</body>
</html>