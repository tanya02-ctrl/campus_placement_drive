<?php session_start(); ?>
<?php include "../db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Analysis</title>
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
        <div class="col-md-3 col-lg-2 p-0 bg-dark text-white" style="position: fixed;">
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
                          <a class="nav-link active" href="analysis.php"><i class="fas fa-chart-line"></i>  Analysis</a>
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
  <div class="container">
    <div class="row justify-content-center my-5">
      <div class="col-12 col-md-10 col-lg-8">
        <div class="card shadow-lg border-0" style="position: fixed; top: 50%; left: 59%; transform: translate(-50%, -50%); width: 80%; z-index: 10;">
          <div class="card-body">
            <h3 class="text-center mb-4" style="font-family: 'Arial', sans-serif; color: #007BFF; font-weight: bold;">
              <i class="fas fa-chart-bar" style="color: #FFC107; margin-right: 10px;"></i>
              Department-Wise Analysis
            </h3>
            <div id="vertical_barchart" class="w-100" style="height: 500px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$name = $_SESSION['name'];
$id = $_SESSION['c_id'];

$cr = 0;
$ir = 0;
$er = 0;
$mr = 0;

$cquery = "SELECT rolln FROM applied_comp WHERE c_id={$id}";
$select_all_posts_query = mysqli_query($connection, $cquery);

while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
    $rolln = $row['rolln'];
    $comp = "SELECT * FROM student WHERE rolln={$rolln} AND dept='MCA'";
    $compp = mysqli_query($connection, $comp);
    $extc = "SELECT * FROM student WHERE rolln={$rolln} AND dept='BCA'";
    $extcc = mysqli_query($connection, $extc);
    $it = "SELECT * FROM student WHERE rolln={$rolln} AND dept='MBA'";
    $itt = mysqli_query($connection, $it);
    $mechanical = "SELECT * FROM student WHERE rolln={$rolln} AND dept='BBA'";
    $mechanicall = mysqli_query($connection, $mechanical);

    $cr = mysqli_num_rows($compp) + $cr;
    $ir = mysqli_num_rows($itt) + $ir;
    $er = mysqli_num_rows($extcc) + $er;
    $mr = mysqli_num_rows($mechanicall) + $mr;
}
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
  google.charts.load("current", { packages: ["corechart"] });
  google.charts.setOnLoadCallback(drawVerticalBarChart);

  function drawVerticalBarChart() {
    const data = google.visualization.arrayToDataTable([
        ["Department", "No. of Students", { role: "style" }],
        ["MCA", <?php echo $cr ?>, "color: #007BFF"], // Blue
        ["MBA", <?php echo $ir ?>, "color: #28A745"], // Green
        ["BCA", <?php echo $er ?>, "color: #FFC107"], // Yellow
        ["BBA", <?php echo $mr ?>, "color: #DC3545"], // Red
    ]);

    const options = {
        backgroundColor: {
            fill: "#F9F9F9",
            stroke: "#ECECEC",
            strokeWidth: 2,
        },
        bar: { groupWidth: "65%" },
        chartArea: {
            width: "80%",
            height: "70%",
        },
        vAxis: {
            title: "Number of Students",
            textStyle: { fontSize: 12, color: "#333" },
            titleTextStyle: { fontSize: 14, bold: true },
            gridlines: {
                count: -1, // Automatically determine the number of lines
                color: "#EEE",
            },
            viewWindow: {
                min: 0, // Start the Y-axis at 0
                max: Math.max(<?php echo $cr ?>, <?php echo $ir ?>, <?php echo $er ?>, <?php echo $mr ?>) + 1, // Dynamic max based on data
            },
            ticks: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], // Custom tick intervals
        },
        hAxis: {
            title: "Departments",
            textStyle: { fontSize: 12, color: "#333" },
            titleTextStyle: { fontSize: 14, bold: true },
        },
        legend: { position: "none" },
        annotations: {
            alwaysOutside: true,
            textStyle: {
                fontSize: 12,
                color: "#000",
            },
        },
    };

    const chart = new google.visualization.ColumnChart(
        document.getElementById("vertical_barchart")
    );
    chart.draw(data, options);

    // Make the chart responsive
    window.addEventListener("resize", () => {
        chart.draw(data, options);
    });
}

</script>


			  </div>
			  </div>
			  </div>



        </div>
      </div>
    </div>
  </body>
</html>
