<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
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
	<h1>Register here!</h1>
   </div>
   <div class="content">
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="username">Username</label>
			<input type="text" name="username" require>
		</p>
		<p>
			<label for="username">Password</label>
			<input type="password" name="password" require>

		</p>
      <p>
			<label for="firstName">First Name</label> 
			<input type="text" name="firstName" required>
		</p>
		<p>
			<label for="Last name">Last Name</label> 
			<input type="text" name="lastName" required>
		</p>
		<p>
			<label for="DateOfBirth">Date of Birth</label> 
			<input type="date" name="dateOfBirth" required>
		</p>
		<p>
			<label for="Specialization">Specialization</label> 
			<input type="text" name="specialization" required>
		</p>
         <input type="submit" name="registerChefBtn">
	</form>
   </div>
</body>
</html>