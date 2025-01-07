<?php session_start(); ?>
<?php include '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Applied Company</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/bootstrapmin.css" rel="stylesheet">
    <link href="css/dashboard-style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.js"></script>


  </head>
  <body> 
  <div class="container-fluid">
  <div class="row"> 
    <div class="col-md-3 col-lg-2 p-0 bg-dark text-white">
            <div class="sidebar-header p-4 text-center">
                <h3>Welcome, <?php echo $_SESSION['name']; ?></h3>
                <div class="square mb-3"></div>
            </div>

            <nav class="navbar navbar-expand-lg navbar-dark">
                <ul class="navbar-nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="hello.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>
                    <br>
                    <li class="nav-item">
                        <a class="nav-link active" href="clist.php"><i class="fas fa-building"></i> Companies</a>
                    </li>
                    <br>
                    <li class="nav-item">
                        <a class="nav-link" href="applied_comp.php"><i class="fas fa-clipboard-list"></i> Applied Companies</a>
                    </li>
                    <br>
                    <li class="nav-item">
                        <a class="nav-link" href="s_eligibility.php"><i class="fas fa-user-check"></i> Students Eligibility</a>
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
                <h2>Company List</h2>
                <br>
                <span class="badge bg-danger">Overview</span>
            </div>
            <?php
$query = "SELECT * FROM companies";
$select_all_posts_query = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
    $email = $row['email'];
    $contact = $row['contact'];
    $name = $row['name'];
    $intake = $row['intake'];
    $c_id = $row['c_id'];
    $type = $row['type'];

    // Check if the student has already applied
    $rolln = $_SESSION['rolln'];
    $check_applied_query = "SELECT c_id FROM applied_comp WHERE rolln={$rolln} AND c_id={$c_id}";
    $check_applied_result = mysqli_query($connection, $check_applied_query);
    $is_applied = mysqli_num_rows($check_applied_result) > 0;
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
            <th colspan="2" class="text-white text-center">Company Information</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th class="table-info" style="width: 40%;">Email</th>
            <td class="table-light"><?php echo htmlspecialchars($email); ?></td>
          </tr>
          <tr>
            <th class="table-info">Contact</th>
            <td class="table-light"><?php echo htmlspecialchars($contact); ?></td>
          </tr>
          <tr>
            <th class="table-info">Intake</th>
            <td class="table-light"><?php echo htmlspecialchars($intake); ?></td>
          </tr>
          <tr>
            <th class="table-info">Company Id</th>
            <td class="table-light"><?php echo htmlspecialchars($c_id); ?></td>
          </tr>
          <tr>
            <th class="table-info">Job Type</th>
            <td class="table-light"><?php echo htmlspecialchars($type); ?></td>
          </tr>
          <tr>
            <th class="table-info">Action</th>
            <td class="table-light">
              <?php if ($is_applied) { ?>
                <button type="button" class="btn btn-success btn-lg" disabled>Applied</button>
              <?php } else { ?>
                <a href="clist.php?c_id=<?php echo htmlspecialchars($c_id); ?>">
                  <button type="button" class="btn btn-success btn-lg">Apply</button>
                </a>
              <?php } ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php
}

if (isset($_GET['c_id'])) {
    $id = $_GET['c_id'];
    $rolln = $_SESSION['rolln'];

    $cquery = "SELECT c_id FROM applied_comp WHERE rolln={$rolln} AND c_id={$id}";
    $cresult = mysqli_query($connection, $cquery);

    if (mysqli_num_rows($cresult) == 0) {
        $query = "INSERT INTO applied_comp(c_id, rolln) VALUES('{$id}', '{$rolln}')";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Application Failed " . mysqli_error($connection));
        }
    } else {
        echo "<script>alert('Already Registered!');</script>";
    }
}
?>

  </body>
</html>
