<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
	<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="header">
	<a href="index.php">
		<h1>Juan's Restaurant</h1>
	</a>
	</div>
<h2>Are you sure you want to delete this dish?</h2>   
<center>
	<?php $getDishByID = getDishByID($pdo, $_GET['dishes_ID']); ?>
	<div class="container delete">
		<h3>Dish name: <?php echo $getDishByID['nameofdish']; ?></h3>
		<h3>Type of dish: <?php echo $getDishByID['typeofdish']; ?></h3>
		<div class="dltbtn">
      <form action="core/handleForms.php?dishes_id=<?php echo $_GET['dishes_ID']; ?>" method="POST">
      <input type="hidden" name="chef_id" value="<?php echo htmlspecialchars($getDishByID['chef_ID']); ?>">

         <input type="submit" name="deleteDishBtn" value="Confirm">
      </form>
	
		</div>	
	</div>
</center>


</body>
</html>