<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant List</title>
    
</head>
<body>
    <ul class="navigation">
        <li><a href="index.html">Home</a></li>
        <li><a href="#">Restaurants</a></li>
        <li><a href="login.html">Login</a></li>
        <li><a href="contact.html">Contact</a></li>
    </ul>

    <h1>List of Restaurants</h1>

    <button onclick="window.location.href = 'addresto.html';">Add a Restaurant</button>

    <ul class="restaurant-list">
        <?php
        include "cnx.php";

        $selectQuery = "SELECT * FROM restaurant";
        $result = $link->query($selectQuery);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $restaurantId = $row['ID'];
                $restaurantName = $row['name'];
                $cuisine = $row['cuisine'];
                $imagePath = $row['image'];
                $address = $row['address'];

                echo '<li>';
                echo '<h2 class="restaurant-name">' . $restaurantName . '</h2>';
                echo '<div class="restaurant-info">';
                echo '<img src="' . $imagePath . '" class="restaurant-image" alt="' . $restaurantName . ' Image" width="400" height="300">';
                echo '<div class="restaurant-details">';
                echo '<p>kitchen: ' . $cuisine . '</p>';
                echo '<div class="restaurant-address">';
                echo '<p>Address: ' . $address . '</p>';
                echo '</div>';
                echo '<div class="comment-section">';
                echo '<h3>Comments:</h3>';
                echo '<ul class="comment-list">';
                
                // Afficher les commentaires
                $commentQuery = "SELECT * FROM comments WHERE restaurant_id = '$restaurantId'";
                $commentResult = $link->query($commentQuery);
                if ($commentResult->num_rows > 0) {
                    while ($commentRow = $commentResult->fetch_assoc()) {
                        $commentText = $commentRow['comment'];
                        $commentUser = $commentRow['user'];
                        echo '<li class="user-comment">';
                        echo '<p><strong>' . $commentUser . ':</strong> ' . $commentText . '</p>';
                        echo '</li>';
                    }
                } else {
                    echo '<li>No comments yet.</li>';
                }
                echo '</ul>';
                echo '<form class="comment-form" action="addcomment.php" method="POST">';
                echo '<textarea class="comment-input" name="comment" placeholder="Add a comment"></textarea>';
                echo '<input type="hidden" name="restaurant_id" value="' . $restaurantId . '">';

                echo '<button class="comment-btn" type="submit">Post</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</li>';
            }
        } else {
            echo '<li>No restaurants found.</li>';
        }
        $link->close();
        ?>
    </ul>
</body>
</html>