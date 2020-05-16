<?php

include('database_connection.php');

session_start();

$message = '';

if(isset($_SESSION['user_id']))
{
 header('location:indexb.php');
}

if(isset($_POST["login"]))
{
 $query = "
   SELECT * FROM login 
    WHERE username = :username
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
    array(
      ':username' => $_POST["username"]
     )
  );
  $count = $statement->rowCount();
  if($count > 0)
 {
  $result = $statement->fetchAll();
    foreach($result as $row)
    {
      if(password_verify($_POST["password"], $row["password"]))
      {
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $sub_query = "
        INSERT INTO login_details 
        (user_id) 
        VALUES ('".$row['user_id']."')
        ";
        $statement = $connect->prepare($sub_query);
        $statement->execute();
        $_SESSION['login_details_id'] = $connect->lastInsertId();
        header("location:indexb.php");
      }
      else
      {
       $message = "<label>Wrong Password</label>";
      }
    }
 }
 else
 {
  $message = "<label>Wrong Username</labe>";
 }
}

?>

<html>  
    <head> 
    
        <title>Login Guardian</title>  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" type="text/css" href="css/LR.css"> 
    
<style type="text/css">
      .top{
       width: 100%;
    height: 50px;
      }
     

    </style>

    </head> 

    <body> 

       <div class="top"></div>

<div class=" col-sm-offset-4 container">
       <div class="header">
      <div class="logo">
        <a href="home.html"><img src="images/6a81202e-60d7-4e34-ad6c-d197b49bfdeb_200x200.png" height="125 px" width="126 px"></a></div>
      <div class="menu">
        <ul>
          
         
          <li><a class="btn" href="about.html"> About us </a> </li>
          <li><a class="btn" href="privacy.html"> Privacy </a> </li>
          <li><a class="btn" href="register.php">Register</a></li>
          <li><a class="btn" href="login.php"> Login </a> </li>
          
        </ul>
      </div>
   </div>
       </div>
   
    
     <h1 align="center">LOGIN</a></h1> 
     <br>
   <div class="col-sm-4 col-sm-offset-4 container">
   
   
   <div class="panel panel-default">
      
    <div class="panel-body">
     <form method="post">
      <p class="text-danger"><?php echo $message; ?></p>
      <div >
       
       <input type="text" placeholder="Username" name="username" class="form-control" required />
      </div>

      <br>

      <div >
       
       <input type="password" placeholder="Password" name="password" class="form-control" required />
      </div>
      <br>
       <input type="submit" name="login" class="btn btn-lg btn-primary btn-block" value="Login" />
      
     </form>
<p>Not added yet? <a href="register.php"> Sign Up</a></p>
          <p> <a href="home.html"> Back to Home</a></p>
           <hr>
            <p> Copyright &copy; 2020-<?= date('Y')?> All rights reserved </p>
    </div>

   </div>
 </div>

</div>


<br />

<!-- Footer -->
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
