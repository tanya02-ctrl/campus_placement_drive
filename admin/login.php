<?php include '../db.php'; ?>
<?php ob_start(); ?>
<?php session_start(); ?>
<?php



if(isset($_POST['dept']) && isset($_POST['password'])){

	$dept=trim($_POST['dept']);
	$the_password=trim($_POST['password']);
	$query="SELECT * FROM admin WHERE dept='{$dept}'";
	$result=mysqli_query($connection,$query);
	if(!$result){
		die("LOGIN FAILED".mysqli_error($connection));
	}


	while($row=mysqli_fetch_assoc($result)){

		$db_password=$row['password'];
		$db_dept=$row['dept'];
		$db_email=$row['email'];

	}  
		$password=crypt($the_password,$db_password);
	 	if($dept === $db_dept && $db_password===$password){

					echo 'verified user';
					$_SESSION['email']=$db_email;
					$_SESSION['dept']=$dept;
					header("Location:./hello.php");

		}


		}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Login</title>
    <link href="css/bootstrapmin.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  </head>
	<body class="light-gray-bg" style="background: url('../back.jpg') no-repeat center center fixed; background-size: cover;">   
		<a href="../index.php" class="btn btn-success">
        <i class="fas fa-arrow-left"></i></a>
    <div class="container d-flex justify-content-center align-items-center vh-100">
      <div class="col-md-6 col-lg-5 shadow p-4 rounded bg-white">
        <h3 class="text-center mb-4">Admin Login</h3>
<form id="loginForm" method="POST" action="login.php">
          <div class="form-group mb-3">
		<label for="dept" class="form-label">Department</label>
		<select class="form-select" name="dept" required>
		  <option value="select">Select Department</option>
		  <option value="MCA">Master of Computer Application (MCA)</option>
		  <option value="MBA">Master of Business Administration (MBA)</option>
		  <option value="BCA">Bachelor of Computer Application (BCA)</option>
		  <option value="BBA">Bachelor of Business Administration (BBA)</option>
		</select>
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

		<script src="js/bootstrap.bundle.js"></script>
  </body>
</html>







