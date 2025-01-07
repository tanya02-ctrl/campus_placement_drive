<?php


    $dept=$_SESSION['dept'];
    $query="SELECT * FROM student WHERE dept={$dept}";
    $select=mysqli_query($connection,$query);
      while($row=mysqli_fetch_assoc($select)){

                    $rolln=$row['rolln'];

                    $mquery="SELECT * FROM applied_comp WHERE rolln={$rolln}";
                    $select_all_query=mysqli_query($connection,$mquery);

                    while($roww=mysqli_fetch_assoc($select_all_query)){


                        $c_id=$roww['c_id'];

                        $dquery="SELECT name FROM companies WHERE c_id={$c_id}";
                        $exc=mysqli_query($connection,$dquery);
                        $string=$string.",".$exc;





?>

                      <p>Email:<?php echo $row['email'] ?></p>
                      <p>Contact:<?php echo $row['contact'] ?></p>
                      <p>Name:<?php echo $row['name'] ?></p>
                      <p>sgpa:<?php echo $row['sgpa'] ?></p>
                      <p>Roll Number:<?php echo $rolln ?></p>
                      <p>Applied Companies:<?php echo $string ?></p>
                      <a  href=app_students.php?rolln=<?php echo $rolln; ?> ><button type="button"  name="reject">Reject</button></a>



  <?php  }


  if(isset($_GET['rolln'])){

      $id=$_GET['rolln'];


      $cquery="DELETE FROM applied_comp WHERE rolln={$id} AND c_id={$c_id}";
      $cresult=mysqli_query($connection,$cquery);
      header("Location:app_students.php");
        if(!$cresult){
          die("Deletion Failed ".mysqli_error($connection));
        }

      ?>


    <?php

 }}
?>
