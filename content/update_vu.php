<?php
// Démarrer la session
session_start();
if (isset($_SESSION['id_utilisateur']) && isset($_POST['titre_film']) && isset($_POST['vu'])) {
    // Affiche un message dans la console du navigateur
    echo "update_vu.php a été appelé avec succès.";

    $id_utilisateur = $_SESSION['id_utilisateur'];
    $titre_film = $_POST['titre_film'];
    $vu = $_POST['vu'];

    echo $id_utilisateur;
    echo $titre_film;
    echo $vu;

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=filmit;charset=utf8', 'root', '');

        // Vérification si la combinaison id_utilisateur et titre_film existe déjà
        $stmt = $bdd->prepare('SELECT * FROM visionnages WHERE id_utilisateur = :id_utilisateur AND titre_film = :titre_film');
        $stmt->execute(array(
            'id_utilisateur' => $id_utilisateur,
            'titre_film' => $titre_film
        ));
        if ($stmt->rowCount() == 0) {
            if ($vu == 'true') {
                $req = $bdd->prepare('INSERT INTO visionnages (id_utilisateur, titre_film, vu) VALUES (:id_utilisateur, :titre_film, :vu)');
                $req->execute(array(
                    'id_utilisateur' => $id_utilisateur,
                    'titre_film' => $titre_film,
                    'vu' => 1
                ));
            } else {
                $req = $bdd->prepare('INSERT INTO visionnages (id_utilisateur, titre_film, vu) VALUES (:id_utilisateur, :titre_film, :vu)');
                $req->execute(array(
                    'id_utilisateur' => $id_utilisateur,
                    'titre_film' => $titre_film,
                    'vu' => 0
                ));
            }
        } else {
            echo "Le film est déjà dans la liste des films visionnés.";
        }

        $bdd = null;
        echo "Le film a été ajouté à la liste des films visionnés.";    
    } catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
        echo "Le film n'a pas pu être ajouté à la liste des films visionnés.";
    }
} else {
    // Affiche un message d'erreur si les données attendues ne sont pas présentes
    echo "Erreur : Les données attendues ne sont pas présentes.";
}
?>