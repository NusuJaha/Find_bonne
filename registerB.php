<?php
include('database_connectionb.php');

session_start();

$message = '';

if(isset($_SESSION['user_id']))
{
  header('location:indexb.php');
}

if(isset($_POST["register"]))
{
  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);
  $email = trim($_POST["email"]);
  $adrs = trim($_POST["adrs"]);
  $adrs2 = trim($_POST["adrs2"]);
  $phone = trim($_POST["phone"]);

 $image=explode('.', $_FILES['image']['name']);

    $image=end($image);

    $image_name = $username.'.'.$image;

  $check_query = "
  SELECT * FROM loginb 
  WHERE username = :username
  ";
  $statement = $connect->prepare($check_query);
  $check_data = array(
    ':username'   =>  $username
  );
  if($statement->execute($check_data))  
  {
    if($statement->rowCount() > 0)
    {
      $message .= '<p><label>Username already taken</label></p>';
    }
    else
    {
      if(empty($username))
      {
        $message .= '<p><label>Username is required</label></p>';
      }
      if(empty($password))
      {
        $message .= '<p><label>Password is required</label></p>';
      }
      else
      {
        if($password != $_POST['c_password'])
        {
          $message .= '<p><label>Password not match</label></p>';
        }
      }
      if($message == '')
      {
        $data = array(
          ':username'   =>  $username,
          ':password'   =>  password_hash($password, PASSWORD_DEFAULT),
          ':image_name' => $image_name,
          ':email' => $email,
          ':phone' => $phone,
          ':adrs' => $adrs,
          ':adrs2' => $adrs2,

        );

        $query = "
        INSERT INTO loginb 
        (username, password, image,email,phone,adrs,adrs2) 
        VALUES (:username, :password, :image_name, :email, :phone, :adrs, :adrs2)
        ";

        move_uploaded_file($_FILES['image']['tmp_name'], 'bonne_image/'.$image_name);

        $statement = $connect->prepare($query);

        if($statement->execute($data))
        {
          $message = "<label>Registration Completed</label>";
          header('location:loginB.php');
        }
      }
    }
  }
}

 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
     <link rel="stylesheet" href="css/animate.css">
      <link rel="stylesheet" href="css/LR.css">

<br>
    <title>Registration(Bonne)</title>

    <style type="text/css"> </style>
  </head>

  
 <div class="top"></div>

 <div class=" col-sm-offset-4 container">
  <div class="header">
      <div class="logo">
        <a href="home.html"> <img src="images/6a81202e-60d7-4e34-ad6c-d197b49bfdeb_200x200.png" height="125 px" width="126 px"></a></div>
      <div class="menu">
        <ul>
          <li><a class="btn" href="about.html"> About us </a> </li>
          <li><a class="btn" href="privacy.html"> Privacy </a> </li>
          <li><a class="btn" href="registerB.php">Register</a></li>
          <li><a class="btn" href="loginB.php"> Login </a> </li>
          
        </ul>
      </div>
   </div>


 </div>
    <div class="container">

      <h1 class="text-center">Registration Form</h1>
      <hr>

      <div class="row">

        <div class="col-sm-4 col-sm-offset-4 container">

          <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
            
           

              <div class="form-group"> 
              <label class="control-label">Username</label>
              <input class=" form-control" type="text" name="username" placeholder="Enter username" >
            </div>

            

              <div class="form-group"> 
              <label class="control-label">Password</label>
              <input class=" form-control" type="password" name="password" placeholder="Enter password" >
           
            </div>

            

            <div class="form-group"> 
     <label class="control-label">Confirm Password</label>
   <input class=" form-control" type="password" name="c_password" placeholder="Confrim password">
            </div>

            <div class="form-group"> 
     <label class="control-label">Email</label>
   <input class=" form-control" type="email" name="email" placeholder="Enter Email">
            </div>

            <div class="form-group"> 
     <label class="control-label">Phone</label>
   <input class=" form-control" type="text" name="phone" placeholder="Enter Phone Number">
            </div>
            <div class="form-group"> 
     <label class="control-label">Present Address</label>
   <input class=" form-control" type="text" name="adrs" placeholder="Enter Your Present Address">
            </div>
            
            <div class="form-group"> 
     <label class="control-label">Permanent Address</label>
   <input class=" form-control" type="text" name="adrs2" placeholder="Enter Your Permanent Address">
            </div>

           

              <div class="form-group"> 
              <label class="control-label">Photo</label>
              <input  type="file" name="image" >
            </div>

            
              <input type="submit" name="register" value="Register" class="btn btn-lg btn-primary btn-block">
            
            
          </form>
          <br>
          <p>Already have an account? <a href="loginB.php">Sign In</a></p>
          <p> <a href="home.html"> Back to Home</a></p>
          <hr>
            <p> Copyright &copy; 2020-<?= date('Y')?> All rights reserved </p>
    
       

        </div>
      </div>
    </div>
     <footer>
        
           <div class="container-fluid padding">
      <div class="row text-center">
        <div class="col-md-4">
            
           <hr class="light">
            
          <h5>Bonne</h5>
            <hr class="light">
        
          <p>+8801779859181 </p>
          <p> bonne@gmail.com </p>
          <p>36/6 Mirpur Road, Dhanmondi, Dhaka-1205 </p>
        </div>

        <div class="col-md-4">
          <hr class="light">
          <h5>Our Hours</h5>
          <hr class="light">
          <p> SUNDAY TO SATURDAY </p>
          <p>  Closed Day: FRIDAY </p>
            <h6> &copy; bonne.com.bd </h6>
        </div>

        <div class="col-md-4">
          <hr class="light">
          <h5>Service Area</h5>
          <hr class="light">
          <p> Dhaka </p>
          <p> Chittagong </p>
          <p> Sylhet </p>
        </div>


      </div>
    </div>
        </footer>

 
  </body>
</html>




