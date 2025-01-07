<?php session_start(); ?>
<?php include '../db.php'; ?>
<?php ob_start(); ?>

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
                            <a class="nav-link" href="hello.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        </li>
                        <br>
                        <li class="nav-item">
                            <a class="nav-link" href="clist.php"><i class="fas fa-building"></i> Companies</a>
                        </li>
                        <br>
                        <li class="nav-item" >
                          <a class="nav-link" href="applied.php"><i class="fas fa-clipboard-list"></i> Students</a>
                          <br>
                        <li class="nav-item">
                            <a class="nav-link active" href="selected.php"><i class="fas fa-user-check"></i> Selected Students</a>
                        </li>
                        <br>
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
                <h2>Selected Students</h2>
                <br>
                <span class="badge bg-danger">Overview</span>
            </div>

              <?php

                  $dept=$_SESSION['dept'];

                  $query="SELECT * FROM student WHERE dept='{$dept}'";
                  $select_all_posts_query=mysqli_query($connection,$query);
                    while($row=mysqli_fetch_assoc($select_all_posts_query)){

                              $cname=null;
                              $name=$row['name'];
                              $rolln=$row['rolln'];
                              $email=$row['email'];
                              $contact=$row['contact'];
                              $sgpa=$row['sgpa'];



                              $mquery="SELECT * FROM selected_stud WHERE rolln={$rolln}";
                              $done=mysqli_query($connection,$mquery);
                              while($rom=mysqli_fetch_assoc($done)){

                                $cc_id=$rom['c_id'];

                                $kquery="SELECT name FROM companies WHERE c_id={$cc_id}";
                                $test=mysqli_query($connection,$kquery);


                                while($rok=mysqli_fetch_assoc($test)){

                                    $cname=$rok['name'].",".$cname;

                                }

                              }
                            ?>
 <div class="container my-4">
  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead class="thead-dark">
        <tr>
          <th colspan="2" class="text-center bg-danger text-white">
            <h5>Student Information</h5>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php
      
        $query = "SELECT * FROM student WHERE rolln = '$rolln'"; 
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['name'];
            $email = $row['email'];
            $contact = $row['contact'];
            $sgpa = $row['sgpa'];
            
            ?>
            <tr>
              <th>Name</th>
              <td><?php echo ($name); ?></td>
            </tr>
            <tr>
              <th>Roll Number</th>
              <td><?php echo ($rolln); ?></td>
            </tr>
            <tr>
              <th>Email</th>
              <td><?php echo htmlspecialchars($email); ?></td>
            </tr>
            <tr>
              <th>Contact</th>
              <td><?php echo htmlspecialchars($contact); ?></td>
            </tr>
            <tr>
              <th>SGPA</th>
              <td><?php echo htmlspecialchars($sgpa); ?></td>
            </tr>
            <tr>
              <th>Selected by Companies</th>
              <td>
                <?php echo $cname === null ? 'None' : htmlspecialchars($cname); ?>
              </td>
            </tr>
            <?php
          }
        } else {
          echo '<tr><td colspan="2" class="text-center text-danger">No records found for this Roll Number.</td></tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

                                <?php

                              }

                                if(isset($_GET['rolln'])){

                                    $g_id=$_GET['rolln'];
                                    $equery="DELETE FROM student WHERE rolln={$g_id}";
                                    $pquery="DELETE FROM applied_comp WHERE rolln={$g_id}";
                                    $eject=mysqli_query($connection,$pquery);
                                    $reject=mysqli_query($connection,$equery);
                                    header('Location:applied.php');

                                }

                    ?>



			  </div>
			  </div>
			  </div>
 


        </div>
      </div>
    </div>
  </body>
</html>
