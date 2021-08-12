<?php
session_start();

$phonenumber = $securitykey = $password = $passwordconfirm = '';

$errors = array("passwordErr" => "", "success" =>"");

include_once('db.php');

if(isset($_POST['submit'])){

    
    $securitykey= mysqli_real_escape_string($con, $_POST['securitykey']);
    $phonenumber= mysqli_real_escape_string($con, $_POST['phonenumber']);
    $password= mysqli_real_escape_string($con, $_POST['password']);
    $passwordconfirm= mysqli_real_escape_string($con, $_POST['passwordconfirm']);

    if(empty($securitykey) || empty($phonenumber) || empty($password) || empty($passwordconfirm)) {
        $errors['passwordErr'] = "Fill all fields.";
    } 
        if(!($password == $passwordconfirm)){
            $errors['passwordErr'] = "Password doesn't match with its confirmation. Try again.";
            
        
        }elseif(($password == $passwordconfirm)){
            $securitykey1 = md5($securitykey);//Encrypting Security Key

            $sql1 = "SELECT * from authentication where phonenumber = '$phonenumber' and securitykey = '$securitykey1' Limit 1";
            $result= mysqli_query($con,$sql1);
            $queryResults= mysqli_num_rows($result);
            
            
            if($queryResults) {

                while($row = mysqli_fetch_assoc($result)) {
                  

               $password1 = md5($password);//encryption of password
                $sql = "UPDATE authentication set password = '$password1' where phonenumber= '$phonenumber'";
               $res = mysqli_query($con,$sql);
            
        
                if($res ==1){
                //set session variables
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['phonenumber'] = $row['phonenumber'];



                $errors['success'] ="Update successful. You are now logged in.";
                    
                    echo "<script>location.replace('mainpages/home.php')</script>";
                
    }else{
                   
        $errors['phonenumberErr'] = "No user with those details in the system. Please try again. Ensure you fill your details correctly.";
                      
                    
            }
        }
    }
    
    

            
        
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
    
<div class="col-sm-12">
        <?php include_once('header1.php'); ?>
</div>

<div class = "container" id="headerbody">
<div class = "row">
    <div class="col-sm-4">
        <p id="topparagraph">Reset Password:</p>
    </div>
    <div class="col-sm-4">
        <form action="reset.php" method="post">
           
            <input class="reginput" type="number" name ="phonenumber" placeholder="Enter your Phonenumber" value="<?php echo $phonenumber;?>"><br><br>
            <input  class="passinput" type="text" name = "securitykey" placeholder ="Enter your Security Key" value="<?php echo $securitykey;?>"> <br><br>
            <input  class="passinput" type="password" name = "password" placeholder ="Create new password" value="<?php echo $password;?>"> <br><br>
            <input  class="passinput" type="password" name = "passwordconfirm" placeholder ="Repeat password" value="<?php echo $passwordconfirm;?>"> <br><br>
            
            <!--Error display-->
            <div><h3 style="color: green;"><?php echo $errors['success']; ?></h3></div>
            <div><h3 style="color: red;"><?php echo $errors['passwordErr']; ?></h3></div>
            
            <button name="submit" title="sign Up" >Reset</button>

        </form>
    </div>

    <div class="col-sm-4" id ="bottomdiv">
          <a href="signup.php"> Register.</a>
          <a id="reset" href="index.php"> Back to login page.</a>
        
    </div>
</div>


</div>
    


    
</body>
</html>