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
   <div class="content">
   <div class="header">
	<h1>Login Now!</h1>
   </div>

	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="username">Username</label>
			<input type="text" name="username" require>
		</p>
		<p>
			<label for="username">Password</label>
			<input type="password" name="password" require>
			<input type="submit" name="loginChefBtn">
		</p>
	</form>
	<p>Don't have an account? You may register <a href="register.php" style="text-decoration: underline; color: blue;">here</a></p>

   </div>
</body>
</html>