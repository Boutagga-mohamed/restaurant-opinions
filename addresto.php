<?php
include "cnx.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newRestaurantName = $_POST['restaurant-name'];
    $newCuisine = $_POST['cuisine'];
    $newAddress = $_POST['address'];

    $targetDirectory = "images/";
    $targetFile = $targetDirectory . basename($_FILES["restaurant-image"]["name"]);

    move_uploaded_file($_FILES["restaurant-image"]["tmp_name"], $targetFile);

    $imagePath = $targetFile;

    $newRestaurantName = mysqli_real_escape_string($link, $newRestaurantName);
    $newCuisine = mysqli_real_escape_string($link, $newCuisine);
    $newAddress = mysqli_real_escape_string($link, $newAddress);
    $imagePath = mysqli_real_escape_string($link, $imagePath);

    $insertQuery = "INSERT INTO restaurant (name, image, cuisine, address) VALUES ('$newRestaurantName', '$imagePath', '$newCuisine', '$newAddress')";

    if (mysqli_query($link, $insertQuery)) {
        $newRestaurantId = mysqli_insert_id($link);
        header("Location: restaurant.php?newRestaurantId=" . $newRestaurantId);
        exit();
    } else {
        echo "Erreur lors de l'insertion dans la table restaurant: " . mysqli_error($link);
    }
}

mysqli_close($link);
?>
