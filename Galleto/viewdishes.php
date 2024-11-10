<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';


$chef_id = $_GET['chef_id'];

// Fetch chef details
$chefDetails = getChefByID($pdo, $chef_id);

// Check if $chefDetails is valid
if ($chefDetails) {
    $addedBy = htmlspecialchars($chefDetails['username']);
} else {
    $addedBy = "Unknown Chef"; // Set a default if no data is found
}



$chef = getChefByID($pdo, $chef_id);
$dishes = getDishesByChef($pdo, $chef_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chef's Dishes</title>
	 <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="header">
	<a href="index.php">
		<h1>Juan's Restaurant</h1>
	</a>
	</div>

<h2>Dishes by <?php echo htmlspecialchars($chef['username']); ?></h2>

<button onclick="document.getElementById('addDishForm').style.display='block'">Add New Dish</button>

<div id="addDishForm" class="dishes">
    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="chef_id" value="<?php echo $chef_id; ?>">
        
        <p>
            <label for="nameofdish">Dish Name:</label>
            <input type="text" name="nameofdish">
        </p>
        
        <p>
            <label for="typeofdish">Type of Dish:</label>
            <input type="text" name="typeofdish" >
        </p>
        
        <p>
            <label for="ingredients">Ingredients:</label>
            <textarea name="ingredients" ></textarea>
        </p>
        
        <p>
            <label for="info">Description:</label>
            <textarea name="info" placeholder="Describe your dish/Share your recipe! "></textarea>
        </p>
        
        <button type="submit" name="addDishBtn">Confirm</button>
    </form>
</div>


<?php



if (!isset($_SESSION['username'])) {
    echo "You must be logged in to view this page.";
    exit();
}
?>

<h3>List of Dishes:</h3>
<?php

if (count($dishes) === 0) {
    echo("<p style=color:gray;>List is empty. Try adding a new dish!</p>");
}
?>

<ul>
    <?php foreach ($dishes as $dish): ?>
        <li>
            <h1><?php echo htmlspecialchars($dish['nameofdish']); ?></h1>
            <h3>Type: <?php echo htmlspecialchars($dish['typeofdish']); ?></h3>
            <p>Ingredients: <?php echo htmlspecialchars($dish['ingredients']); ?></p>
            <p>Description: <?php echo htmlspecialchars($dish['info']); ?></p>

            <?php
 
            $chefDetails = getChefByID($pdo, $dish['added_by']);
            $addedBy = htmlspecialchars($chefDetails['username']);

            if ($_SESSION['username'] === $addedBy) {

                $addedBy = $_SESSION['username'];
            }
            ?>
            <p>Added By: <?php echo $addedBy; ?></p>

            <?php
            if (empty($dish['last_edited_by']) || $dish['last_edited_by'] === 'none'): ?>
                <p style="display:none;">Last Edited By: <?php echo htmlspecialchars($dish['last_edited_by']); ?></p>
            <?php else: ?>
                <p>Last Edited By: <?php echo htmlspecialchars($dish['last_edited_by']); ?></p>
            <?php endif; ?>

            <p>Last Updated: <?php echo htmlspecialchars($dish['last_updated']); ?></p>

            <button><a href="editdishes.php?dishes_ID=<?php echo $dish['dishes_ID']; ?>">Edit</a></button>
            <button><a href="deletedishes.php?dishes_ID=<?php echo $dish['dishes_ID']; ?>">Delete</a></button>
        </li>
        <hr>
    <?php endforeach; ?>
</ul>
</body>
</html>
