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
  <body class="bg-light">

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
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
                            <a class="nav-link " href="clist.php"><i class="fas fa-building"></i> Companies</a>
                        </li>
                        <br>
                        <li class="nav-item" >
                          <a class="nav-link" href="applied.php"><i class="fas fa-clipboard-list"></i>  Students</a>
                          <br>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="selected.php"><i class="fas fa-user-check"></i> Selected Students</a>
                        </li>
                        <br> -->
                        <li class="nav-item">
                            <a class="nav-link active" href="view.php"><i class="fas fa-eye"></i> View Students</a>
                        </li>
                        <br>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
                        </li>
                      
                    </ul>
                </nav>
            </div>


        <!-- Main Content -->
<div class="col-md-9 col-lg-10 py-4">
    <?php
    $dept = $_SESSION['dept'];

    // Query to fetch all students from the department
    $query = "SELECT * FROM student WHERE dept='{$dept}'";
    $select_all_posts_query = mysqli_query($connection, $query);

    echo '<div class="container mt-5">';
    echo '<div class="card shadow">';
    echo '<div class="card-header bg-primary text-white text-center">';
    echo '<h3><i class="fas fa-user-graduate me-2"></i>Student List</h3>';
    echo '</div>';
    echo '<div class="card-body">';
    echo '<div class="table-responsive">';
    echo '<table class="table table-hover table-striped table-bordered align-middle">';
    echo '<thead class="table-primary text-center">';
    echo '<tr>';
    echo '<th><i class="fas fa-id-badge me-1"></i> Roll Number</th>';
    echo '<th><i class="fas fa-user me-1"></i> Name</th>';
    echo '<th><i class="fas fa-envelope me-1"></i> Email</th>';
    echo '<th><i class="fas fa-phone me-1"></i> Contact</th>';
    echo '<th><i class="fas fa-chart-line me-1"></i> SGPA</th>';
    echo '<th><i class="fas fa-building me-1"></i> Applied Companies</th>';
    echo '<th><i class="fas fa-user-check me-1"></i> Selected</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
        $cname = null;
        $selected_company = null;

        $name = $row['name'];
        $rolln = $row['rolln'];
        $email = $row['email'];
        $contact = $row['contact'];
        $sgpa = $row['sgpa'];

        // Fetch the companies the student applied to
        $mquery = "SELECT * FROM applied_comp WHERE rolln={$rolln}";
        $done = mysqli_query($connection, $mquery);

        $applied_companies = [];
        while ($rom = mysqli_fetch_assoc($done)) {
            $cc_id = $rom['c_id'];

            // Fetch the company name based on company ID
            $kquery = "SELECT name FROM companies WHERE c_id={$cc_id}";
            $test = mysqli_query($connection, $kquery);

            while ($rok = mysqli_fetch_assoc($test)) {
                $applied_companies[] = $rok['name'];
            }
        }

        // Combine applied company names into a single string
        $cname = !empty($applied_companies) ? implode(', ', $applied_companies) : 'None';

        // Fetch the company that selected the student
        $select_query = "SELECT companies.name FROM selected_stud 
                         INNER JOIN companies ON selected_stud.c_id = companies.c_id 
                         WHERE selected_stud.rolln = {$rolln}";
        $select_result = mysqli_query($connection, $select_query);

        if ($selected_row = mysqli_fetch_assoc($select_result)) {
            $selected_company = $selected_row['name'];
        } else {
            $selected_company = 'None';
        }

        // Render the student details in the table
        echo '<tr>';
        echo '<td class="text-center">' . htmlspecialchars($rolln) . '</td>';
        echo '<td>' . htmlspecialchars($name) . '</td>';
        echo '<td>' . htmlspecialchars($email) . '</td>';
        echo '<td>' . htmlspecialchars($contact) . '</td>';
        echo '<td class="text-center">' . htmlspecialchars($sgpa) . '</td>';
        echo '<td>' . htmlspecialchars($cname) . '</td>';
        echo '<td class="text-center">' . htmlspecialchars($selected_company) . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>'; 
    echo '</div>';
    echo '</div>'; 
    echo '</div>'; 
    ?>
</div>

        </div>
    </div>
</div>



            </body>
            </html>            