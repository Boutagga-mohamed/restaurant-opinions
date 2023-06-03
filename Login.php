<?php
session_start();
include "cnx.php";

// Vérifier si un utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    // Utilisateur déjà connecté, afficher un message d'erreur ou rediriger vers une autre page
    echo "You are already logged in. Please log out before logging into another account."
    exit;
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Vérifier les informations de connexion
    $query = "SELECT * FROM user WHERE Email = '$email' AND password = '$password'";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) == 1) {
        // L'utilisateur est authentifié, définir la variable de session et rediriger vers la page d'accueil ou une autre page sécurisée
        $user = mysqli_fetch_assoc($result);
        $_SESSION["user_id"] = $user["ID"];
        header("Location: index.html");
        exit;
    } else {
        // Vérifier si le compte existe ou afficher un message d'erreur approprié
        $query = "SELECT * FROM user WHERE Email = '$email'";
        $result = mysqli_query($link, $query);

        if (mysqli_num_rows($result) == 1) {
            // Le compte existe, mais le mot de passe est incorrect
            echo"The password is incorrect." ;
        } else {
            // Le compte n'existe pas, afficher un message d'erreur avec un lien vers la page d'inscription
            echo "The account does not exist. Please register.";
        }
    }
}
?>