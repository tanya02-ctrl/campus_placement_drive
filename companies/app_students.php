<?php session_start(); ?>
<?php ob_start(); ?>
<?php include '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--favicon-->
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
            <!-- Left Sidebar -->
            <div class="col-md-3 col-lg-2 p-0 bg-dark text-white">
                <div class="sidebar-header p-4 text-center">
                    <h3>Welcome, <?php echo $_SESSION['name']; ?></h3>
                    <div class="square mb-3"></div>
                </div>
                <nav class="navbar navbar-expand-lg navbar-dark ">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="hello.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        </li>
                        <br>
                        <li class="nav-item">
                            <a class="nav-link active" href="app_students.php"><i class="fas fa-clipboard-list"></i> Applied Students</a>
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

            <div class="col-md-9 col-lg-10 p-4 bg-light">
  <div class="content-header mb-4">
    <h2><i class="fas fa-users me-2"></i>Applied Students</h2>
    <span class="badge bg-danger">Overview</span>
  </div>

  <?php
  $c_id = $_SESSION['c_id'];

  // Fetch applied students
  $query = "SELECT * FROM applied_comp WHERE c_id={$c_id}"; 
  $select_all_posts_query = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
    $rolln = $row['rolln'];
    $mquery = "SELECT * FROM student WHERE rolln={$rolln}";
    $select_all_query = mysqli_query($connection, $mquery);

    while ($student = mysqli_fetch_assoc($select_all_query)) {
      $selected = false;

      // Check if student is already selected
      $check_query = "SELECT * FROM selected_stud WHERE rolln={$rolln} AND c_id={$c_id}";
      $check_result = mysqli_query($connection, $check_query);
      if (mysqli_num_rows($check_result) > 0) {
        $selected = true;
      }
  ?>

  <!-- Student Card -->
  <div class="container my-5 student-card" id="student-<?php echo $rolln; ?>">
    <div class="profile-card p-4 shadow-lg rounded-3 bg-light">
      <h4 class="text-uppercase mb-4 text-center text-primary">
        <i class="fas fa-user-circle me-2"></i><?php echo htmlspecialchars($student['name']); ?>
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
              <td class="table-light"><?php echo htmlspecialchars($student['email']); ?></td>
            </tr>
            <tr>
              <th class="table-info">Contact</th>
              <td class="table-light"><?php echo htmlspecialchars($student['contact']); ?></td>
            </tr>
            <tr>
              <th class="table-info">SGPA</th>
              <td class="table-light"><?php echo htmlspecialchars($student['sgpa']); ?></td>
            </tr>
            <tr>
              <th class="table-info">Roll Number</th>
              <td class="table-light"><?php echo htmlspecialchars($rolln); ?></td>
            </tr>
            <tr>
              <th class="table-info">Department</th>
              <td class="table-light"><?php echo htmlspecialchars($student['dept']); ?></td>
            </tr>
            <tr>
              <th class="table-info">Action</th>
              <td class="table-light">
                <?php if ($selected) { ?>
                  <button type="button" class="btn btn-success btn-lg me-2" disabled>
                    <i class="fas fa-check-circle me-2"></i>Selected
                  </button>
                <?php } else { ?>
                  <button type="button" class="btn btn-success btn-lg me-2 select-btn" 
                          data-rolln="<?php echo $rolln; ?>">
                    <i class="fas fa-check-circle me-2"></i>Select
                  </button>
                  <button type="button" class="btn btn-danger btn-lg reject-btn" 
                          data-rolln="<?php echo $rolln; ?>">
                    <i class="fas fa-times-circle me-2"></i>Reject
                  </button>
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
  }
  ?>
</div>

<!-- JavaScript for Button Actions -->
<script>
  document.querySelectorAll('.select-btn').forEach(button => {
    button.addEventListener('click', function () {
      const rolln = this.getAttribute('data-rolln');
      fetch(`app_students.php?select_rolln=${rolln}`).then(response => {
        if (response.ok) {
          // Update UI
          this.innerHTML = '<i class="fas fa-check-circle me-2"></i>Selected';
          this.disabled = true;
          this.nextElementSibling.remove(); 
        } else {
          alert('Error selecting student!');
        }
      });
    });
  });

  document.querySelectorAll('.reject-btn').forEach(button => {
    button.addEventListener('click', function () {
      const rolln = this.getAttribute('data-rolln');
      fetch(`app_students.php?reject_rolln=${rolln}`).then(response => {
        if (response.ok) {
          document.getElementById(`student-${rolln}`).remove();
        } else {
          alert('Error rejecting student!');
        }
      });
    });
  });
</script>

			  </div>
			  </div>
			  </div>



        </div>
      </div>
    </div>
  </body>
</html>
