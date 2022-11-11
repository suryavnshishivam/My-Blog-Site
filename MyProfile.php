<?php require_once("DB.php");
?>
<?php require_once("function.php");
?>
<?php require_once("Session.php");
?>
<?php 
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login(); ?>

<?php
//Fetching the exsiting Admin data start
$AdminId=$_SESSION["UserID"];
global $connectingDB;
$sql="SELECT * FROM admins WHERE id='$AdminId'";
$stmt=$connectingDB->query($sql);
while ($DataRows= $stmt->fetch()){
$ExistingName=$DataRows['aname'];
$ExistingUsername=$DataRows['username'];
$ExistingHeadline=$DataRows['aheadline'];
$ExistingBio=$DataRows['abio'];
$ExistingImage=$DataRows['aimage'];
}
//Fetching the exsiting Admin data end 
if(isset($_POST["Submit"]))
{
    $AName=$_POST["Name"];
    $AHeadline=$_POST["Headline"];
    $ABio = $_POST["Bio"];
    $Image=$_FILES["Image"]["name"];
    $Target ="img/".basename($_FILES["Image"]["name"]);

    if (strlen($AHeadline)>30)
    {
        $_SESSION["ErrorMessage"]="Headline Should be less than 30 characters";
        Redirect_to("MyProfile.php");
    }
    elseif(strlen($ABio)>500)
    {
        $_SESSION["ErrorMessage"]="Bio should be less than 500 character";
        Redirect_to("MyProfile.php");
    }
        else 
        {
              // Query to Update Admi in DB when everythink is fine
              global $connectingDB;
              if (!empty($_FILES["Image"]["name"])){
                  $sql ="UPDATE admins 
               SET aname='$AName', aheadline='$AHeadline', abio='$ABio', aimage='$Image'
               WHERE id= '$AdminId'";

              }else {
                $sql ="UPDATE admins 
                SET aname= '$AName', aheadline='$AHeadline',abio='$ABio'
                WHERE id= '$AdminId'";
              }

              
          
          $Execute =$connectingDB->query($sql);
          move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);

                if($Execute)
                {
                    $_SESSION["SuccessMessage"]="Details Update Successfully";
                    Redirect_to("MyProfile.php");

                } 
                else
                {
                    $_SESSION["ErrorMessage"]="Something went wrong. Try Again";
                    Redirect_to("MyProfile.php");     
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
    <title>My Profile </title>
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
            <a href="MyProfile.php" class="nav-link"> <i class="fa-solid fa-user text-success"></i>My Profile</a>
            </li>
            <li class="nav-item">
                <a href="Dashboard.php" class="nav-link"> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="Post2.php" class="nav-link">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a href="categories.php" class="nav-link">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a href="Admins.php" class="nav-link">Manage Admins</a>
                            </li>
                            <li class="nav-item">
                                <a href="Comments.php" class="nav-link"> Comments</a>
                                </li>
                                <li class="nav-item">
                                    <a href="Blog.php ?page=1" class="nav-link">Live Blog</a>
                                    </li>

    </ul>
    <ul class="navbar-nav ml-auto">  
        <<li class="nav-item"><a href="Logout.php" class="nav-link text-danger "> 
            <i class="fa-solid fa-user-times"></i>Logout</a></li>
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
        <div class="col-md-12">
        <h1><i class="fas fa-text-user text-success  mb-2"></i> @<?php  echo $ExistingUsername;?></h1>
        <small><?php echo $ExistingHeadline;?> </small>
        </div>
        </div>
        </div>

        </header>
 <!-- header end -->
<!--Main area-->
<section class="container py-2 mb-4">
    <div class="row" >
    <!-- Left Area -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h3> <?php echo $ExistingName ?></h3>
                </div class="card-body">
                <img src="img/<?php echo $ExistingImage;?>" class="block img-fluid mb-3" alt="">  
                <div class="">
               <?php echo $ExistingBio; ?>
                </div>
                <div>

                </div>


            </div>

        </div>
        
        <!-- Right Area -->
        <div class="col-md-9" style="min-height:400px;">
<?php
echo ErrorMessage();
echo SuccessMessage();

?>


<form class="" action="MyProfile.php" method="POST" enctype="multipart/form-data">
    <div class="card bg-dark text-light">
        <div class="card-header bg-secondary text-light">
            <h4>Edit Profile</h4>

        </div>
        <div class="card-body ">
            <div class="form-group">
<input class="form-control" type="text" name="Name" id="title" placeholder="Your name " value="">
               
</div>
<div class="form-group">
<input class="form-control" type="text" id="title" placeholder="Headline" value="" name="Headline">
<small class="text-muted">Add a Professional headline like , 'Engineer at SOFTec or 'Web Deplover'</small>
<span class="text-danger">Not more than 30 characters</span>

               
</div>

<div class="form-group">
    <textarea placeholder="Bio" class="form-control" id="post" name="Bio" row="30" cols="100"></textarea>
</div>
        


    <div class="form=group mb-1">
        <div class="custom=file">
<input class="custom-file-input" type="File" name="Image"  id="imageSelect" value="">
<label for="imageSelect" class="custom-file-label"> Select Image </label>
</div>
</div>




 <div class="row">
 <div class="col-lg-6 mb-2" >
 <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"> </i>Back to Dashboard</a>
 </div>
 <div class="col-lg-6 mb-2">
    <button type="Submit" name="Submit" class="btn btn-success btn-block"> 
    <i class="fas fa-check"> </i>Publish </button>
    </div>
    </div>
        </div>
             </div>
                </form>
                    </div>
                        </div>
                            </section>
        <!--Main area end -->



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