<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validation des données (vous pouvez ajouter vos propres règles de validation)
    if (empty($nom) || empty($email) || empty($message)) {
        echo "Veuillez remplir tous les champs du formulaire.";
        exit;
    }

    // Envoi de l'e-mail
    $to = "boutaggamohamed16@gmail.com"; 
    $subject = "Nouveau message de contact";
    $body = "Nom: $nom\nEmail: $email\n\nMessage:\n$message";

    if (mail($to, $subject, $body)) {
        echo "Votre message a été envoyé avec succès.";
    } else {
        echo "Une erreur s'est produite lors de l'envoi du message.";
    }
}
?>
