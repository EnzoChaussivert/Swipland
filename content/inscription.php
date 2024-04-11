<?php
// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=filmit;charset=utf8', 'root', '');
} catch(Exception $e) {
    // Gestion des erreurs de connexion à la base de données
    die('Erreur : '.$e->getMessage());
}

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $courriel = $_POST['courriel'];
    $mot_de_passe = hash('sha256', $_POST['mot_de_passe']);
    
    // Insertion de l'utilisateur dans la base de données
    try {
        $req = $bdd->prepare('INSERT INTO utilisateur (nom, courriel, mot_de_passe) VALUES (:nom, :courriel, :mot_de_passe)');
        $req->execute(array(
            'nom' => $nom,
            'courriel' => $courriel,
            'mot_de_passe' => $mot_de_passe // Notez que le mot de passe doit être haché avant d'être stocké dans la base de données pour des raisons de sécurité
        ));
        echo 'Utilisateur ajouté avec succès.';
        header('Location: index.php');
    } catch(Exception $e) {
        // Gestion des erreurs d'insertion
        die('Erreur : '.$e->getMessage());
        header('Location: login.php');
    }
}
?>