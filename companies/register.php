<?php include '../db.php'; ?>

<?php

if(isset($_POST['submit'])){

$name=trim($_POST['name']);
$c_id=($_POST['c_id']);
$password=trim($_POST['password']);
$email=trim($_POST['email']);
$contact=trim($_POST['contact']);
$intake=($_POST['intake']);
$type=($_POST['type']);



$error=[

'name'=>'',
'c_id'=>'',
'email'=>'',
'password'=>'',
'contact'=>'',
'intake'=>'',
'type'=>'',




];


if($name=='')	{
	$error['username']="Username is Empty";
}
if($c_id=='')	{
	$error['c_id']="Company Id is Empty";
}
if($password=='')	{
	$error['password']="Password is Empty";
}
if($email=='')	{
	$error['email']="Email is Empty";
}
if($intake=='')	{
	$error['intake']="Intake cannot be Empty";
}
if($contact=='')	{
	$error['contact']="Contact is Empty";
}
if($type=='')	{
	$error['type']="Job type is Empty";
}





foreach ($error as $key => $value) {

if(empty($value)){


	unset($error[$key]);


}

}


if(!empty($error)){


?>
<script>
	alert('Invalid Credentials');
</script>
<?php


}else{
	$the_password=crypt($password,'123abc');
	$query="INSERT INTO companies(name,c_id,email,contact,intake,password,type) VALUES('{$name}','{$c_id}','{$email}','{$contact}','{$intake}','{$the_password}','{$type}')";
	$result=mysqli_query($connection,$query);
	header("Location:login.php");

	if(!$result){

			die('Query Failed '.mysqli_error($connection));
		}
}

}




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Company Registration</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/bootstrapmin.css" rel="stylesheet">
    <link href="css/dashboard-style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  </head>
	<body class="light-gray-bg" style="background: url('../back.jpg') no-repeat center center fixed; background-size: cover;">

	<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="col-md-6 col-lg-5 shadow p-4 rounded bg-white">
	<header class="text-center mb-4">
	  <h1 class="h4">Company Register</h1>
	</header>
				<form method="POST" action="register.php">

<div class="mb-3">
  <div class="input-group">
	<span class="input-group-text"><i class="fa fa-user"></i></span>
	<input type="text" name="name" class="form-control" placeholder="Name" required>
  </div>
</div>
				<div class="mb-3">
	        		<div class="input-group">
		        		<div class="input-group-text"><i class="fa fa-user fa-fw"></i></div>
		              	<input type="text" name="c_id" class="form-control" placeholder="Company Id" >
		          	</div>
	        	</div>
				<div class="mb-3">
  <div class="input-group">
	<span class="input-group-text">@</span>
	<input type="email" name="email" class="form-control" placeholder="Email" required>
  </div>
</div>

<div class="mb-3">
  <div class="input-group">
	<span class="input-group-text"><i class="fa fa-phone"></i></span>
	<input type="text" name="contact" class="form-control" placeholder="Contact" required>
  </div>
</div>

<div class="mb-3">
		<div class="input-group">
		  <span class="input-group-text"><i class="fa fa-key"></i></span>
		  <input type="password" name="password" class="form-control" placeholder="******" required>
		</div>
</div>
					<div class="mb-3">
						<div class="input-group">
							<div class="input-group-text">#</div>
									<input type="text" name="intake" class="form-control" placeholder="No. of positions" >
							</div>
					 </div>

					 <div class="mb-3">
						 <div class="input-group">
							 <div class="input-group-text">J</div>
									 <input type="text" name="type" class="form-control" placeholder="Job Type" >
							 </div>
						</div>

						<div class="d-grid gap-2 mb-3">
  <button type="submit" name="submit" class="btn btn-primary">Register</button>
</div>
</form>
<div class="text-center">
<p>Already have an account? <a href="login.php" class="text-decoration-none">Sign in here!</a></p>

</div>


</div>
</div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>

	</body>
</html>
