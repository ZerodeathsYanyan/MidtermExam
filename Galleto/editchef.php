<?php require_once 'core/handleForms.php'; ?>
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
<?php $getChefByID = getChefByID($pdo, $_GET['chef_id']); ?>
	<h2>Chef Profile</h2>
	<form action="core/handleForms.php?chef_id=<?php echo $_GET['chef_id']; ?>" method="POST">
	<p>
			<label for="username">Username</label> 
			<input type="text" name="username" value="<?php echo $getChefByID['username']; ?>">
		</p>
		<p>
			<label for="password">Password</label> 
			<input type="text" name="password" value="<?php echo $getChefByID['password']; ?>">
		</p>
		<p>
			<label for="firstName">First Name</label> 
			<input type="text" name="firstName" value="<?php echo $getChefByID['first_name']; ?>">
		</p>
		<p>
			<label for="lastname">Last Name</label> 
			<input type="text" name="lastName" value="<?php echo $getChefByID['last_name']; ?>">
		</p>
		<p>
			<label for="dateOfBirth">Date of Birth</label> 
			<input type="date" name="dateOfBirth" value="<?php echo $getChefByID['date_of_birth']; ?>">
		</p>
		<p>
			<label for="specialization">Specialization</label> 
			<input type="text" name="specialization" value="<?php echo $getChefByID['specialization']; ?>">
		</p>
		<div class="ebtn">
		<input type="submit" name="editChefBtn">
		</div>
	</form>
</body>
</html>