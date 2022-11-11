<?php require_once("DB.php");
?>
<?php require_once("function.php");
?>
<?php require_once("Session.php");
?>

<!-- Fetching Existing Data-->

<?php 
$SarchQueryParameter =$_GET['username'];
global $connectingDB;
$sql= "SELECT aname,aheadline,abio,aimage FROM admins WHERE username=:userName";
$stmt=$connectingDB->prepare($sql);
$stmt->bindValue(':userName',$SarchQueryParameter);
$stmt->execute();
$Result= $stmt->rowcount();
if ($Result==1){
    while ($DataRows=$stmt->fetch()){
        $ExistingName= $DataRows["aname"];
        $ExistingBio= $DataRows["abio"];
        $ExistingImage= $DataRows["aimage"];
        $ExistingHeadline= $DataRows["aheadline"];
    }
}else{
    $_SESSION["ErrorMessage"]="Bad Request !!";
    Redirect_to("Blog.php?page=1");
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
    <title>Profile</title>
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
    <ul class="navbar-nav mr-auto"> 

            <li class="nav-item">
                <a href="Blog.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="Blog.php" class="nav-link">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Contact Us </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link"> Features</a>
                                </li>
                               

    </ul>
    <ul class="navbar-nav ml-auto">  
       <form class="form-inline d-none d-sm-block"  action="Blog.php">
           <div class=" form-group">
           <input class="form-control mr-2" type="text" name="Search" placeholder="Search here" value="">

            <button  class="btn btn-primary" name="SearchButton">Go</button>
          
</div>
        </form>
    </ul>

</div>
</div>    

</nav>
<div style="height: 10px; background:#27aae1;"> </div> 
<!--navbar end -->

 <!-- header-->
 <header class="bg-dark text-white py-3">
     <div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1><i class="fas fa-user text-success mr-2" style="color:#27aae1;"></i><?php echo $ExistingName;?></h1>
            <h3><?php echo $ExistingHeadline;?></h3>
        </div>

        </div>
        </div>

        </header>
 <!-- header end -->
 <section class="container py-2 mb-4">
     <div class="row">
         <div class="col-md-3">
             <img src="img/<?php echo $ExistingImage;?>" class="d-block img-fluid mb-3 rounded-circle" alt="">
         </div>
         <div class="col-md-9 " style="min-height:400px;">
             <div class="card">
                 <div class="card-body">
                     <p class="lead"><?php echo $ExistingBio;?></p>

                 </div>

             </div>

         </div>

     </div>

 </section>
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