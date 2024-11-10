	<?php 

	require_once 'dbConfig.php'; 
	require_once 'models.php';
	ob_start();


	if (isset($_POST['insertChefBtn'])) {

		$query = insertChef($pdo, $_POST['firstName'], 
			$_POST['lastName'], $_POST['dateOfBirth'], $_POST['specialization']);

		if ($query) {
			header("Location: ../index.php");
		}
		else {
			echo "Insertion failed";
		}

	}
	if (isset($_POST['addDishBtn'])) {
		$chef_id = $_POST['chef_id'];
		$nameofdish = $_POST['nameofdish'];
		$typeofdish = $_POST['typeofdish'];
		$ingredients = $_POST['ingredients'];
		$info = $_POST['info'];
  

		$addedBy = $_SESSION['username'];  
  

		$query = addDish($pdo, $chef_id, $nameofdish, $typeofdish, $ingredients, $info, $addedBy);
  
		if ($query) {
			 header("Location: ../viewdishes.php?chef_id=$chef_id");
		} else {
			 echo "Failed to add dish";
		}
  }
  
  


	if (isset($_POST['editChefBtn'])) {
		$query = updateChef($pdo, $_POST['username'], $_POST['password'], $_POST['firstName'], $_POST['lastName'], 
			$_POST['dateOfBirth'], $_POST['specialization'], $_GET['chef_id']);

		if ($query) {
			header("Location: ../index.php");
		}

		else {
			echo "Edit failed";;
		}

	}

	if (isset($_POST['editDishBtn'])) {
		$nameofdish = $_POST['nameofdish'];
		$typeofdish = $_POST['typeofdish'];
		$ingredients = $_POST['ingredients'];
		$info = $_POST['info'];
		$dishes_id = $_POST['dishes_id']; 
		
		$query = updateDish($pdo, $nameofdish, $typeofdish, $ingredients, $info, $dishes_id);
		$chef_id = $_POST['chef_id'];
  
		if ($query) {
			 header("Location: ../viewdishes.php?chef_id=$chef_id");
		} else {
			 echo "Edit failed";
		}
  }
  

	if (isset($_POST['deleteDishBtn'])) {
		$dishes_id = $_GET['dishes_id'];
		$chef_id = $_POST['chef_id'];
		$query = deleteDish($pdo, $dishes_id);
  
		if ($query) {
			 header("Location: ../viewdishes.php?chef_id=$chef_id");
		} else {
			 echo "Deletion failed";
		}
  }
  

	if (isset($_POST['deleteChefBtn'])) {
		$query = deleteChef($pdo, $_GET['chef_id']);

		if ($query) {
			header("Location: ../login.php");
		}

		else {
			echo "Deletion failed";
		}
	}
//Register
if (isset($_POST['registerChefBtn'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$dateOfBirth = $_POST['dateOfBirth'];
	$specialization = $_POST['specialization'];


	$sql = "INSERT INTO chefs (username, password, first_name, last_name, date_of_birth, specialization) VALUES (?, ?, ?, ?, ?, ?)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$username, $password, $firstName, $lastName, $dateOfBirth, $specialization]);
	header("Location: ../login.php");
	exit();
}


//Log in
if (isset($_POST['loginChefBtn'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];


	if (empty($username) || empty($password)) {
		 header("Location: ../login.php");  
		 exit();  
	}

	$loginQuery = loginUser($pdo, $username, $password);  

	if ($loginQuery) {
		 header("Location: ../index.php");  
		 exit(); 
	} else {
		 header("Location: ../login.php"); 
		 exit();
	}
}






//log out
if (isset($_GET['logoutAUser'])) {
	unset($_SESSION['username']);
	header('Location: ../login.php');
}


	?>