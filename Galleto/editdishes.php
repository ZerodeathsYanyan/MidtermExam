<?php 
require_once 'core/handleForms.php'; 
require_once 'core/models.php'; 
$getDishByID = getDishByID($pdo, $_GET['dishes_ID']); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Dish</title>
   <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="header">
	<a href="index.php">
		<h1>Juan's Restaurant</h1>
	</a>
</div>

<h2>Edit Dish</h2>
<form action="core/handleForms.php" method="POST">

	<p>
		<label for="nameofdish">Dish Name</label> 
		<input type="text" name="nameofdish" value="<?php echo htmlspecialchars($getDishByID['nameofdish']); ?>" required>
	</p>
	<p>
		<label for="typeofdish">Type of Dish</label> 
		<input type="text" name="typeofdish" value="<?php echo htmlspecialchars($getDishByID['typeofdish']); ?>" required>
	</p>
	<p>
		<label for="ingredients">Ingredients:</label>
		<textarea name="ingredients" required><?php echo htmlspecialchars($getDishByID['ingredients']); ?></textarea>
	</p>

	<p>
		<label for="info">Description:</label>
		<textarea name="info" required><?php echo htmlspecialchars($getDishByID['info']); ?></textarea>
	</p>

	<input type="hidden" name="chef_id" value="<?php echo htmlspecialchars($getDishByID['chef_ID']); ?>">
	<input type="hidden" name="dishes_id" value="<?php echo htmlspecialchars($getDishByID['dishes_ID']); ?>">

	<div class="ebtn">
		<input type="submit" name="editDishBtn" value="Update Dish">
	</div>
</form>
</body>
</html>
