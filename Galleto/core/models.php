
<?php  
//Chefs and Dishes

function deleteChef($pdo, $chef_id) {
    try {
        $deleteChefDish = "DELETE FROM dishes WHERE chef_id = ?";
        $deleteStmt = $pdo->prepare($deleteChefDish);
        $deleteStmt->execute([$chef_id]);

        $sql = "DELETE FROM chefs WHERE chef_id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$chef_id]);
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
function deleteDish($pdo, $dishes_id) {
	try {
		  $deleteDish = "DELETE FROM dishes WHERE dishes_id = ?";
		  $deleteStmt = $pdo->prepare($deleteDish);
		  $deleteStmt->execute([$dishes_id]);
		  return true;

	} catch (PDOException $e) {
		  echo "Error: " . $e->getMessage();
		  return false;
	}
}


function updateChef($pdo, $username, $password, $first_name, $last_name, 
	$date_of_birth, $specialization, $chef_id) {

	$sql = "UPDATE chefs
				SET username = ?,
					password = ?, 
					first_name = ?,
					last_name = ?,
					date_of_birth = ?, 
					specialization = ?
				WHERE chef_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$username, $password, $first_name, $last_name, 
	$date_of_birth, $specialization, $chef_id]);
	
	if ($executeQuery) {
		return true;
	}

}

function updateDish($pdo, $nameofdish, $typeofdish, 
    $ingredients, $info, $dishes_id) {

    $lastEditedBy = $_SESSION['username'];

    $sql = "UPDATE dishes
                SET nameofdish = ?,
                    typeofdish = ?,
                    ingredients = ?, 
                    info = ?,
                    last_edited_by = ?
            WHERE dishes_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$nameofdish, $typeofdish, 
    $ingredients, $info, $lastEditedBy, $dishes_id]);

    if ($executeQuery) {
        return true;
    }
}


function getAllChefs($pdo) {
	$sql = "SELECT * FROM chefs";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getChefByID($pdo, $chef_id) {
	$sql = "SELECT * FROM chefs WHERE chef_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$chef_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}


function getDishesByChef($pdo, $chef_id) {
	$sql = "SELECT * FROM dishes WHERE chef_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$chef_id]);
	return $stmt->fetchAll();
}

function getAllDishes($pdo) {
	$sql = "SELECT * FROM dishes";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}
function getDishByID($pdo, $dishes_id) {
	$sql = "SELECT * FROM dishes WHERE dishes_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$dishes_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function addDish($pdo, $chef_id, $nameofdish, $typeofdish, $ingredients, $info) {
	$sql = "INSERT INTO dishes (chef_ID, nameofdish, typeofdish, ingredients, info, added_by) 
			  VALUES (?, ?, ?, ?, ?, ?)";
	$stmt = $pdo->prepare($sql);
	return $stmt->execute([$chef_id, $nameofdish, $typeofdish, $ingredients, $info, $chef_id]);
}



// Register


function insertNewUser($pdo, $username, $password, $first_name, $last_name, 
$date_of_birth, $specialization) {

	$checkUserSql = "SELECT * FROM chefs WHERE username = ?";
	$checkUserSqlStmt = $pdo->prepare($checkUserSql);
	$checkUserSqlStmt->execute([$username]);

	if ($checkUserSqlStmt->rowCount() == 0) {

		$sql = "INSERT INTO chefs (username, password, first_name, last_name, 
		date_of_birth, specialization) VALUES(?, ?, ?, ?, ?, ?)";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$username, $password, $first_name, $last_name, 
		$date_of_birth, $specialization]);

		if ($executeQuery) {
			$_SESSION['message'] = "User successfully inserted";
			return true;
		}

		else {
			$_SESSION['message'] = "An error occured from the query, please try again";
		}

	}
	else {
		$_SESSION['message'] = "User already exists";
	}

	
}

//Log in
function loginUser($pdo, $username, $password) {
	$sql = "SELECT * FROM chefs WHERE username=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$username]);

	if ($stmt->rowCount() == 1) {
		 $userInfoRow = $stmt->fetch();
		 $usernameFromDB = $userInfoRow['username'];
		 $passwordFromDB = $userInfoRow['password'];

		 if ($password == $passwordFromDB) {

			  $_SESSION['username'] = $usernameFromDB;
			  $_SESSION['chef_id'] = $userInfoRow['chef_ID'];
			  $_SESSION['message'] = "Login successful!";
			  return true; 
		 } else {
			  $_SESSION['message'] = "Password is invalid, but user exists.";
			  return false; 
		 }
	} else {
		 $_SESSION['message'] = "Username doesn't exist in the database.";
		 return false;
	}
}

?>