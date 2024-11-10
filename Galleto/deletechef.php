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
<h2>Are you sure you want to delete?</h2>
<center>
	<?php $getChefByID = getChefByID($pdo, $_GET['chef_id']); ?>
	<div class="container delete">
		<center><img src = "img/defaultpfp.png"></center>
		<h3>Username: <?php echo $getChefByID['username']; ?></h3>
		<h3>First name: <?php echo $getChefByID['first_name']; ?></h3>
		<h3>Last name: <?php echo $getChefByID['last_name']; ?></h3>
		<h3>Date Of Birth: <?php echo $getChefByID['date_of_birth']; ?></h3>
		<h3>Specialization: <?php echo $getChefByID['specialization']; ?></h3>
		<h3>Date Registered: <?php echo $getChefByID['date_registered']; ?></h3>

		<div class="dltbtn">
			<form action="core/handleForms.php?chef_id=<?php echo $_GET['chef_id']; ?>" method="POST">
				<input type="submit" name="deleteChefBtn" value="Confirm">
			</form>			
		</div>	
	</div>
	</center>
</body>
</html>