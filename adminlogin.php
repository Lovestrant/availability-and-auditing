<?php
session_start();

$username =$password = '';
$errors = array("phonenumberErr" => "", "success" => "");

include_once('db.php');


if(isset($_POST['submit'])){
   
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password =  mysqli_real_escape_string($con, $_POST['password']);
    
    if($username === 'admin' && $password === 'password') {
        $_SESSION['fullname'] = "Admin";
        
        echo "<script>location.replace('mainpages/adminpage.php')</script>";
    } else{
       

    }

   
        
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
<link rel="stylesheet" type="text/css" href="css/index.css">

     <!--bootstrap links-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


<!-- google icons link-->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">



</head>
<body>
<div class = "container" id="headerbody">
<div class = "row">
    <div class="col-sm-4">
        <p id="topparagraph">Login as Admin:</p>
    </div>
    <div class="col-sm-4">
        <form action="adminlogin.php" method="post">
           
            <input class="reginput" type="text" name ="username" placeholder="Enter admin Username" value="<?php echo $username; ?>"><br><br>

            <input  class="passinput" type="password" name = "password" placeholder ="Enter password" value="<?php echo $password; ?>"> <br><br>
                <!--Error display-->
        <div><h3 style="color: red;"><?php echo $errors['phonenumberErr']; ?></h3></div>
        <div><h3 style="color: green;"><?php echo $errors['success']; ?></h3></div>

            <button name="submit" title="sign Up" >Sign In</button>

        </form>
    </div>

    <div class="col-sm-4" id ="bottomdiv">
          
          <a id="reset" href="index.php"> Go back to Index page.</a>
        
    </div>
</div>


</div>
    


    
</body>
</html>