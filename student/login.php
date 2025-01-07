<?php include '../db.php'; ?>
<?php ob_start(); ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link href="css/bootstrapmin.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  </head>
  <body style="background: url('../back.jpg') no-repeat center center fixed; background-size: cover;">
	<a href="../index.php" class="btn btn-success">
        <i class="fas fa-arrow-left"></i></a>
    <div class="container d-flex justify-content-center align-items-center vh-100">
      <div class="col-md-6 col-lg-5 shadow p-4 rounded bg-white">
        <h3 class="text-center mb-4">Student Login</h3>
        <form id="loginForm" method="POST" action="login.php">
          <div class="form-group mb-3">
            <label for="rolln" class="form-label">Roll Number</label>
            <div class="input-group">
              <div class="input-group-text"><i class="fas fa-user"></i></div>
              <input type="text" class="form-control" id="rolln" name="rolln" placeholder="Enter Roll Number" required>
            </div>
          </div>
          <div class="form-group mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <div class="input-group-text"><i class="fas fa-lock"></i></div>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
            </div>
          </div>
          <div class="form-check mb-3"> 
            <input type="checkbox" class="form-check-input" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Remember me</label>
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="text-center mt-3">
          <p class="mt-2">Not registered? <a href="register.php" class="text-decoration-none text-primary">Sign up now</a></p>
        </div>
      </div>
    </div>
    <?php



if(isset($_POST['rolln']) && isset($_POST['password'])){
  
	$rolln=trim($_POST['rolln']);
	$the_password=trim($_POST['password']);
	
	$query="SELECT * FROM student WHERE rolln='{$rolln}'";
	$result=mysqli_query($connection,$query);
	if(!$result){
		die("LOGIN FAILED".mysqli_error($connection));
	}


	while($row=mysqli_fetch_assoc($result)){

		$db_password=$row['password'];
		$db_rolln=$row['rolln'];
		$db_name=$row['name'];

	}


		$password=crypt($the_password,$db_password);
	 	if($rolln === $db_rolln && $db_password===$password){

					$_SESSION['name']=$db_name;
					$_SESSION['rolln']=$db_rolln;
					header("Location:./hello.php");


		}


		}


 ?>

    <script src="js/bootstrap.bundle.js"></script>
  </body>
</html>


