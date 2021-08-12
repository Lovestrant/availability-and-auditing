<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Availability, Recovery and Auditing.</title>

<!--Css link-->
<link rel="stylesheet" type="text/css" href="../css/home.css">

     <!--bootstrap links-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>



<!-- google icons link-->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>



</head>
<body>
<div class = "container-fluid">
    <div class = "row">
    
        <div class="col-sm-12">
        <?php include_once('header.php'); ?>
        </div>
            
    
    </div>

    <div class="row">
<div class = "row" style="margin-left: 4%;">
    <p>Welcome <?php $fullname = $_SESSION['fullname']; echo "<label style='color: red;font-size: 20px;'> $fullname</label>"; ?></p>

  <p style='color:purple;'>You are Logged in As Admin:</p>
  <a href="deleted.php"><button  style="margin-right: 10%;color:red;">Restore deleted</button></a>
    </div>

<div class="col-sm-12" id="homebody" style="margin-left: 10%;">
    <h3>The following is a list of all registered Users in the System:</h3>
    <h4>You can delete them and still be able to restore:</h4>
    <div class="col-sm-12">



     <?php 

        include_once('../db.php');

    
            $sql="SELECT * FROM authentication";

 
                   $data2= mysqli_query($con,$sql);
                   $queryResults2= mysqli_num_rows($data2);
                   
         
                   
                    if($queryResults2 >0) {
                              while($row = mysqli_fetch_assoc($data2)) {
                           
                                echo "  
                                <div>
                                    <h3 style='color: green;'>".$row['fullname']."</h3>
                                    
                                </div>

                                <div style='margin-top: 3%; text-align:centre; margin-bottom: 5%;'>
                               
                                <p style='color: black;font-size:20px;margin-left:5%;margin-right:5%; '>".$row['phonenumber']."</p>  
        
                                <div>
                                <a href='deletepage.php?postId=".$row['id']."'><button style='color: red;margin-right: 10%;'>Delete</button></a>

                                </div>
                                <hr>
                                </div>

                               
                              ";
                              
                            }
                        }
       

                              
    ?>

    </div>
  
</div>
</body>
</html>