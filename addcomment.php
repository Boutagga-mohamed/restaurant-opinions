<?php
session_start();
include "cnx.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        echo "Please log in to leave a comment.";
        exit;
    }

    $restaurantId = $_POST['restaurant_id'];
    $commentText = $_POST['comment'];
    $userId = $_SESSION['user_id']; // ID de l'utilisateur connecté

    $restaurantId = mysqli_real_escape_string($link, $restaurantId);
    $commentText = mysqli_real_escape_string($link, $commentText);

    // Récupérer le nom complet de l'utilisateur à partir de la base de données
    $userQuery = "SELECT `First Name`, `Last Name` FROM user WHERE ID = '$userId'";
    $userResult = mysqli_query($link, $userQuery);
    $user = mysqli_fetch_assoc($userResult);
    $userName = $user['First Name'] . ' ' . $user['Last Name']; // Nom complet de l'utilisateur

    $insertQuery = "INSERT INTO comments (restaurant_id, comment, user) VALUES ('$restaurantId', '$commentText', '$userName')";

    if (mysqli_query($link, $insertQuery)) {
        // Comment added successfully
        header("Location: restaurant.php?restaurantId=" . $restaurantId);
        exit();
    } else {
        echo "Error while adding the comment.";
    }
}

mysqli_close($link);
?>
