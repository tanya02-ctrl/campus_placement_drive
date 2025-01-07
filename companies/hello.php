<?php session_start(); ?>
<?php include "../db.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Company Profile</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrapmin.css" type="text/css">

    <link href="css/dashboard-style.css" rel="stylesheet">



  </head>
  <body>
  <div class="container-fluid">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-md-3 col-lg-2 p-0 bg-dark text-white">
                <div class="sidebar-header p-4 text-center">
                    <h3>Welcome, <?php echo $_SESSION['name']; ?></h3>
                    <div class="square mb-3"></div>
                </div>
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        </li>
                        <br>
                        <li class="nav-item">
                            <a class="nav-link" href="app_students.php"><i class="fas fa-clipboard-list"></i> Applied Students</a>
                        </li>
                        <br>
                        <li class="nav-item" >
                          <a class="nav-link" href="analysis.php"><i class="fas fa-chart-line"></i>  Analysis</a>
                          <br>
                        <li class="nav-item">
                            <a class="nav-link" href="c_eligibility.php"><i class="fas fa-user-check"></i> Company Eligibility</a>
                        </li>
                        <br>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
                        </li>
                      
                    </ul>
                </nav>
            </div>

 



            <!-- Main Content Area -->
            <div class="col-md-9 col-lg-10 p-4 bg-light">
                <div class="content-header mb-4">
                    <h2>Company Profile</h2>
                    <br>
                    <span class="badge bg-danger">Profile Overview</span>
                </div>
              <?php

$name=$_SESSION['name'];

$query="SELECT * FROM companies WHERE name='{$name}'";
$select_all_posts_query=mysqli_query($connection,$query);
  while($row=mysqli_fetch_assoc($select_all_posts_query)){

            $email=$row['email'];
            $contact=$row['contact'];
            $name=$row['name'];
            $intake=$row['intake'];
            $c_id=$row['c_id'];
  }
?>

<div class="container my-5">
  <div class="profile-card p-4 shadow-lg rounded-3 bg-light">
    <h4 class="text-uppercase mb-4 text-center text-primary">
      <i class="fas fa-user-circle me-2"></i><?php echo htmlspecialchars($name); ?>
    </h4>

    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th colspan="2" class="text-white text-center">Student Information</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th class="table-info" style="width: 40%;">Email</th>
            <td class="table-light"><?php echo htmlspecialchars($email); ?></td>
          </tr>
          <tr>
            <th class="table-info">Intake</th>
            <td class="table-light"><?php echo htmlspecialchars($intake); ?></td>
          </tr>
          <tr>
            <th class="table-info">Contact</th>
            <td class="table-light"><?php echo htmlspecialchars($contact); ?></td>
          </tr>
          <tr>
            <th class="table-info">Company Id</th>
            <td class="table-light"><?php echo htmlspecialchars($c_id); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

        </div>
    </div>
    <script src="js/bootstrap.bundle.js"></script>
  </body>
</html>
