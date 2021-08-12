<?php
session_start();

$phonenumber =$password = '';
$errors = array("phonenumberErr" => "", "success" => "");

include_once('db.php');


if(isset($_POST['submit'])){
   
    $phonenumber = mysqli_real_escape_string($con, $_POST['phonenumber']);
    $password =  mysqli_real_escape_string($con, $_POST['password']);
    

    $password1 = md5($password); //encrypting password
    $sql1="SELECT * FROM authentication where  phonenumber = '$phonenumber' and password= '$password1' LIMIT 1";
  
    $result= mysqli_query($con,$sql1);
    $queryResults= mysqli_num_rows($result);
    
    if($queryResults) {
        while($row = mysqli_fetch_assoc($result)) {

        //set session variables
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['phonenumber'] = $row['phonenumber'];
  
    

        //taking user to main page
        $errors['success'] = "Login successful.";
    
        echo "<script>location.replace('mainpages/home.php')</script>";

        }
    }else{
        $errors['phonenumberErr'] = "Wrong combinations. Fill your details correctly.";
     
       
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


<script>
function adminLogin() {
    location.replace("adminlogin.php");
}

</script>



</head>




<body>
<div class="col-sm-12">
        <?php include_once('header1.php'); ?>
</div>

<div class = "row"  id="headerbody">
    <div class="col-sm-4">
        <p id="topparagraph">Login:</p>
    </div>
    <div class="col-sm-4">
        <form action="index.php" method="post">
            <input class="reginput" type="number" name ="phonenumber" placeholder="Enter your Phone Number" value="<?php echo $regNo;?>"><br><br>
            <input  class="passinput" type="password" name = "password" placeholder ="Enter password" value="<?php echo $password;?>"> <br><br>
           
           <!--Error display-->
        <div><h5 style="color: red;"><?php echo $errors['phonenumberErr']; ?></h5></div>
        <div><h5 style="color: green;"><?php echo $errors['success']; ?></h5></div>
        
            <input type= "submit" name="submit" title="Login">

        </form>
    </div>

    <div class="col-sm-4" id ="bottomdiv">
         <a href="signup.php">Register</a><br>
        <a id="reset" href="reset.php">Forgot Password</a>
        
    </div>


<div class="col-sm-12">
    <br><br><br>
    <a href="adminlogin.php"><button>Login as Admin</button></a>
</div>

</div>



      
</body>
</html>