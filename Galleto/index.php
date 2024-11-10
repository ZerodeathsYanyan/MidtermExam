<?php 
    require_once 'core/dbConfig.php'; 
    require_once 'core/models.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <script>
        function toggleActions() {
            const actions = document.getElementById('user-actions');
            actions.style.display = (actions.style.display === 'none' || actions.style.display === '') ? 'block' : 'none';
        }
    </script>
</head>
<body>

<div class="header">
    <a href="index.php">
        <h1>Juan's Restaurant</h1>
    </a>

    <?php if (isset($_SESSION['username'])) { ?>
        <div class="user-info">
            <img src="img/defaultpfp.png" alt="Profile Picture" class="profile-pic" onclick="toggleActions()">
            <h1 class="chef-greeting">Chef <?php echo $_SESSION['username']; ?></h1>
            
            <div id="user-actions" style="display:none;">
                <?php if (isset($_SESSION['chef_id'])) { ?>
                    <a href="viewdishes.php?chef_id=<?php echo $_SESSION['chef_id']; ?>">View Dishes</a>
                    <a href="editchef.php?chef_id=<?php echo $_SESSION['chef_id']; ?>">Edit</a>
                    <a href="deletechef.php?chef_id=<?php echo $_SESSION['chef_id']; ?>">Delete</a>
                <?php } else { ?>
                    <p style="color: red;">Chef ID is not set correctly.</p>
                <?php } ?>
                <a href="core/handleForms.php?logoutAUser=1">Logout</a>
            </div>

        </div>
    <?php } else { 
        header('refresh:3; url=login.php');
        echo('<p style="color: red">User not logged in, Redirecting to Login page...</p>'); 
    } ?>
</div>

<h2>List of Chefs</h2>
<div class="ListOfChefs">
    <?php $getAllChefs = getAllChefs($pdo); ?>
    <?php foreach ($getAllChefs as $row) { ?>
        <div class="container">
            <img src="img/defaultpfp.png" alt="Profile Picture">
            <h3><?php echo $row['username']; ?></h3>
            <p>Date Of Birth: <?php echo $row['date_of_birth']; ?></p>
            <p>Specialization: <?php echo $row['specialization']; ?></p>
            <p>Date Registered: <?php echo $row['date_registered']; ?></p>
            <button><a href="viewdishes.php?chef_id=<?php echo $row['chef_ID']; ?>">View Dishes</a></button>
        </div>
    <?php } ?>
</div>

</body>
</html>
