<?php
// Démarrer la session
session_start();

// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=filmit;charset=utf8', 'root', '');
} catch(Exception $e) {
    // Gestion des erreurs de connexion à la base de données
    die('Erreur : '.$e->getMessage());
}

// Vérification si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $courriel = $_POST['courriel'];
    $mot_de_passe = hash('sha256', $_POST['mot_de_passe']); // Hachage du mot de passe avec SHA-256
    
    // Requête pour vérifier si l'utilisateur existe dans la base de données
    $req = $bdd->prepare('SELECT * FROM utilisateur WHERE courriel = :courriel AND mot_de_passe = :mot_de_passe');
    $req->execute(array(
        'courriel' => $courriel,
        'mot_de_passe' => $mot_de_passe
    ));
    $result = $req->fetch(PDO::FETCH_ASSOC);
    
    // Vérification si l'utilisateur existe
    if ($result) {
        // L'utilisateur existe, démarrer sa session
        $_SESSION['id_utilisateur'] = $result['id_utilisateur']; // Supposons que votre colonne id_utilisateur est nommée de cette façon dans votre base de données
        $_SESSION['utilisateur'] = $result['nom'];
        echo 'Connexion réussie. Bienvenue, '.$result['nom'].'!';
        // Rediriger vers une page de succès ou l'accueil
        header('Location: index.php');
    } else {
        // L'utilisateur n'existe pas ou le mot de passe est incorrect
        echo 'Courriel ou mot de passe incorrect.';
        // rediriger vers la page de connexion
        header('Location: login.php');

    }
}
?>