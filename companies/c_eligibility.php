<?php session_start(); ?>
<?php include '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Company Eligibility</title>
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
        <div class="col-md-3 col-lg-2 p-0 bg-dark text-white" >
            <div class="sidebar-header p-4 text-center" >
                <h3>Welcome, <?php echo $_SESSION['name']; ?></h3>
                <div class="square mb-3"></div>
            </div>
            <nav class="navbar navbar-expand-lg navbar-dark" >
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="hello.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
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
                            <a class="nav-link active" href="c_eligibility.php"><i class="fas fa-user-check"></i> Company Eligibility</a>
                        </li>
                        <br>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
                        </li>
                      
                    </ul>
                </nav>
          </div>

        <div class="col-md-9 col-lg-10 p-4 bg-light">


            <div class="container my-5">
    <div class="profile-card p-4 shadow-lg rounded-3 bg-light">
        <h4 class="text-center text-uppercase text-primary mb-4">
            <i class="fas fa-clipboard-list me-2"></i>Placement Guidelines
        </h4>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <i class="fas fa-calendar-alt text-primary me-2"></i>
                Registered students of LBSIMDS are expected to submit their forms by 
                <b>June <?php echo date('Y'); ?></b>.
            </li>
            <li class="list-group-item">
                <i class="fas fa-graduation-cap text-success me-2"></i>
                Must be enrolled in a relevant degree program (e.g., MCA, MBA, BCA, BBA, etc.).
            </li>
            <li class="list-group-item">
                <i class="fas fa-chart-line text-warning me-2"></i>
                Minimum SGPA/percentage requirement (e.g., 6.0 CGPA or 60% in aggregate).
            </li>
            <li class="list-group-item">
                <i class="fas fa-user-graduate text-danger me-2"></i>
                Typically, only final-year students are eligible for placements.
            </li>
            <li class="list-group-item">
                <i class="fas fa-times-circle text-danger me-2"></i>
                Students must have no active backlogs to be eligible.
            </li>
            <li class="list-group-item">
                <i class="fas fa-user-check text-primary me-2"></i>
                Students can participate in/register for placements only once during their stay.
            </li>
            <li class="list-group-item">
                <i class="fas fa-tools text-info me-2"></i>
                Specific technical skills or certifications relevant to the job roles being offered. 
                <br><i class="fas fa-handshake text-info me-2"></i> 
                Soft skills like communication, teamwork, and problem-solving abilities.
            </li>
            <li class="list-group-item">
                <i class="fas fa-file-alt text-secondary me-2"></i>
                Students must submit an updated resume and complete their profiles in the placement management system.
            </li>
        </ul>
    </div>
</div>




			
			  </div>



        </div>
      </div>
  </body>
</html>
