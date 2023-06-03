<?php
session_start();
include "cnx.php";

if (isset($_SESSION['user_id'])) {
   
    echo "You are already logged in. Please log out before creating a new account.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["nom"];
    $lastName = $_POST["prenom"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Vérifier si l'utilisateur existe déjà dans la base de données
    $existingUserQuery = "SELECT * FROM user WHERE email = '$email'";
    $existingUserResult = mysqli_query($link, $existingUserQuery);

    if (mysqli_num_rows($existingUserResult) > 0) {
       
        echo "An account with this email address already exists.";
    } else {
        // Insérer l'utilisateur dans la base de données
        $insertQuery = "INSERT INTO user (`First Name`, `Last Name`, `Email`, `password`) VALUES ('$firstName', '$lastName', '$email', '$password')";
        $insertResult = mysqli_query($link, $insertQuery);

        if ($insertResult) {
            
            $userID = mysqli_insert_id($link); // Récupérer l'ID de l'utilisateur nouvellement inséré
            $_SESSION["user_id"] = $userID;
            header("Location: login.html");
            exit;
        } else {
            echo "Insertion error.";
        }
    }
}
?>
