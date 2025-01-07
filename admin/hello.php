<?php session_start(); ?>
<?php include '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Profile</title>
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
                    <h3>Welcome, <?php echo $_SESSION['dept']; ?></h3>
                    <div class="square mb-3"></div>
                </div>
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        </li>
                        <br>
                        <li class="nav-item">
                            <a class="nav-link" href="clist.php"><i class="fas fa-building"></i> Companies</a>
                        </li>
                        <br>
                        <li class="nav-item" >
                          <a class="nav-link" href="applied.php"><i class="fas fa-clipboard-list"></i> Students</a>
                          <br>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="selected.php"><i class="fas fa-user-check"></i> Selected Students</a>
                        </li>
                        <br> -->
                        <li class="nav-item">
                            <a class="nav-link" href="view.php"><i class="fas fa-eye"></i> View Students</a>
                        </li>
                        <br>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
                        </li>
                      
                    </ul>
                </nav>
            </div>

      <!-- Main content -->
      <div class="col-md-9 col-lg-10 p-4 bg-light">
                <div class="content-header mb-4">
                    <h2>Admin Profile</h2>
                    <br>
                    <span class="badge bg-danger">Profile Overview</span>
                </div>
              <?php

                  $dept=$_SESSION['dept'];

                  $query="SELECT * FROM admin WHERE dept='{$dept}'";
                  $select_all_posts_query=mysqli_query($connection,$query);
                    while($row=mysqli_fetch_assoc($select_all_posts_query)){

                              $email=$row['email'];
                              $id=$row['id'];
                              $sem=$row['sem'];
                              $totalstud=$row['totalstud'];
                              $placeincharge=$row['placeincharge'];

                    }
              ?>

<div class="container my-5">
  <div class="profile-card p-4 shadow-lg rounded bg-white">
    <h4 class="text-uppercase mb-4 text-center text-primary">
      <i class="fas fa-building me-2"></i><b><?php echo htmlspecialchars($dept); ?></b>
    </h4>
    <table class="table table-bordered table-striped table-hover align-middle">
      <tbody>
        <tr>
          <th class="bg-success text-white" style="width: 40%;">Email</th>
          <td><?php echo htmlspecialchars($email); ?></td>
        </tr>
        <tr>
          <th class="bg-success text-white">Department ID</th>
          <td><?php echo htmlspecialchars($id); ?></td>
        </tr>
        <tr>
          <th class="bg-success text-white">Semester</th>
          <td><?php echo htmlspecialchars($sem); ?></td>
        </tr>
        <tr>
          <th class="bg-success text-white">Total Students</th>
          <td><?php echo htmlspecialchars($totalstud); ?></td>
        </tr>
        <tr>
          <th class="bg-success text-white">Placement Incharge</th>
          <td><?php echo htmlspecialchars($placeincharge); ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

        </div>
    </div>
    <script src="js/bootstrap.bundle.js"></script>
  </body>
</html>
