<?php 
    session_start();

  
    //initializing errors array
    $errors = array("error" => "", "success" => "");



    if(isset($_POST['restore'])){
        include_once('../db.php');
        $postid = $_POST['hiddenid'];
        $sql1="SELECT * FROM backup where id = '$postid'";

        $result= mysqli_query($con,$sql1);
        $queryResults= mysqli_num_rows($result);
        
        if($queryResults) {
            while($row = mysqli_fetch_assoc($result)) {

                $fullname= $row['fullname'];
                $phonenumber= $row['phonenumber'];
                $securitykey= $row['securitykey'];
                $password= $row['password'];

                
            $sql = "INSERT INTO authentication (fullname, phonenumber,securitykey, password) VALUES ('$fullname', '$phonenumber','$securitykey','$password')";
		    $res = mysqli_query($con,$sql);
		
	
		 if($res ==1){
            $sql="DELETE FROM backup where id = '$postid'";
    
            $data= mysqli_query($con,$sql);
            if($data ==1) {
                //$errors['sucess'] ="Post Deleted successfully.";
                echo "<script>alert('Post Restored successfully.')</script>";
                echo "<script>location.replace('../mainpages/adminpage.php')</script>";
            }else{
                echo "<script>alert('Restoration Failed.')</script>";
                echo "<script>location.replace('../mainpages/restore.php?postId=$postid')</script>";
            }

         }


            }}    
    
    }
    
    
    ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Availability, Recovery and Auditing.</title>


<!--Css link-->
<link rel="stylesheet" type="text/css" href="../css/bizacc.css">

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
<div class = "row" style="margin-left: 5%;text-align: centre;">

<div class="container">
             <div class="row">
                 <div class="col-sm-12" >
                     <h2 style='color: red;'>Be sure to Restore:</h2>
     <?php 




        include_once('../db.php');
          
      
        $postId = $_GET['postId'];
      
    
            $sql="SELECT * FROM backup where id ='$postId'";

 
                   $data2= mysqli_query($con,$sql);
                   $queryResults2= mysqli_num_rows($data2);
                   
         
                   
                    if($queryResults2 >0) {
                              while($row = mysqli_fetch_assoc($data2)) {
                           
                                echo "  
                                <div>
                                    <h3 style='color: green;'>".$row['fullname']."</h3>
                                    
                                </div>

                               
                                <p style='color: black;font-size:20px; '>".$row['phonenumber']."</p>  
                             

                                <hr>
                                </div>

                               
                              ";
                              
                            }
                        }
       

                              
    ?>
                    
                 </div>
             </div>
         </div>

<div class="row" style="margin: 3%;">
 <div class="col-sm-12">
    <form action = "restore.php" method="post">
    <input type="hidden" name= "hiddenid" value=<?php $id= $_GET['postId']; echo $id; ?>> <!-- Hidden input-->

     <button name="restore" style="background-color: green;color:white;">Restore Above Record</button>
    </form>

    <div><h5 style="color: red;"><?php echo $errors['error']; ?></h5></div>
     <div><h5 style="color: green;"><?php echo $errors['success']; ?></h5></div>

 </div> 

 </div>

 </div>







</div>



</body>
</html>