<?php require_once("DB.php");
?>
<?php require_once("function.php");
?>
<?php require_once("Session.php");
?>

 <?php 
if (isset($_SESSION["UserID"])){
    Redirect_to("Dashboard.php");
}


        if (isset($_POST["Submit"]))
        {
            $UserName = $_POST["username"];
            $Password = $_POST["password"];

            if (empty($UserName)||empty($Password))
            {
                $_SESSION["ErrorMessage"]="All fileds must be filled out";
                Redirect_to("Login.php");
            } else
            {
                    // code for checking username and password from database
                    $Found_Account=Login_Attempt($UserName,$Password);
                  if ($Found_Account)
                  {
                  $_SESSION["UserID"]=$Found_Account["id"];
                  $_SESSION["UserName"]=$Found_Account["username"];
                  $_SESSION["AdminName"]=$Found_Account["aname"];

                  $_SESSION["SuccessMessage"]="Wellcome ".$_SESSION["AdminName"] ."!";
                  if (isset($_SESSION["TrackingURL"])) {
                    Redirect_to($_SESSION["TrackingURL"]);
                  }else   {
             
                      Redirect_to("Dashboard.php"); 
                }
            }else {
                   $_SESSION["ErrorMessage"]="Incorrect Username/Password";
                   Redirect_to("Login.php"); 
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
    <script src="https://kit.fontawesome.com/899f6019c7.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
   <!--navbar-->
   <div style="height: 10px; background:#27aae1;"> </div>
   <nav  class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
    <a href="#" class="navbar-brand "> Suryavnshi.com </a>
    <button class="navbar-toggler" data-toggler="collapse" data-target="#navbarcollapseBoost">
        <span class="navbar-toggler-icon"></span>

    </button>
    <div class="collapse navbar-collapse" id="navbarcollapseBoost"> 
   

</div>
</div>    

</nav>
<div style="height: 10px; background:#27aae1;"> </div> 
<!--navbar end -->
 <!-- header-->
 <header class="bg-dark text-white py-3">
     <div class="container">
    <div class="row">
        <div class="col-md-12">
            
        </div>

        </div>
        </div>

        </header>
 <!-- header end -->
  <!-- Main Area Start -->
    <section class="container py-2 mb-4">
        <div class="row">
            <div class="offset-sm-3 col-sm-6" style="min-height:500px;">
            <br><br><br>
  <?php
echo ErrorMessage();
echo SuccessMessage();

?>
            <div class="card bg-secondary text-light">
                <div class="card-header">
                    <h4>Wellcome Back !</h4>
                    </div>
                    <div class="card-body bg-dark">
                    
                <form class=" " action="Login.php" method="post">
                    <div class="form-group">
                         <label for="username"><span class="FildInfo">Username:</span></label>
                         <div class="input-group mb-3">
                             <div class="input-group-prepend">
                                 <span class="input-group-text text-white bg-info"><i class="fas fa-user"> </i></span>

                             </div>
                             <input type="text" class="form-control" name="username" id="username" value=""> 
                            </input>

                         </div>

                    </div>
                    <div class="form-group">
                         <label for="password"><span class="FildInfo">Password:</span></label>
                         <div class="input-group mb-3">
                             <div class="input-group-prepend">
                                 <span class="input-group-text text-white bg-info"><i class="fas fa-lock"> </i></span>

                             </div>
                             <input type="password" class="form-control" name="password" id="password" value=""> 
                            </input>

                         </div>

                    </div>
                <input type="submit" name="Submit" class="btn btn-info btn-block" value="Login">

                </form>

                </div>

            </div>

            </div>

        </div>

    </section>






   <!-- Main Area End -->




<br>
<!-- footer -->
<footer class="bg-dark text-white"> 
<div class="container">
    <div class="row">
        <div class="col">

        
        <p class="lead text-center">Theme By | Suryavnshi Shivam | <span id="year"></span>&copy; ---All right Reserved. </p>
            <p class="text-center small"> <a style="color:white text-decoration:none; cursor: pointer;" hrefe="http://suryavnshi.com/coupons/" target="blank">
            This side is only used study purpose suryavnshi.com have all the rights. no one is allow to distribute
                copies other than <br>&trade; suryavnshi.com &trade; Udemy ;&trade; skillshare; &trade;stackskills</a></p>
    </div>
</div>
</div>
</footer>
<div style="height: 10px; background:#27aae1;"> </div> 
<!-- footer end -->




 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>   
<script>
    $('#year').text(new Date().getFullYear);
</script>

</body>
</html>