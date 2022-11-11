<?php require_once("DB.php");
?>
<?php require_once("function.php");
?>
<?php require_once("Session.php");
?>
<?php Confirm_Login(); ?>


<?php

$SarchQueryParameter= $_GET["id"];
if(isset($_POST["Submit"]))
{
    
    $postTitle=$_POST["postTitle"];
    $Category=$_POST["Category"];
    $Image=$_FILES["Image"]["name"];
    $Target ="img/".basename($_FILES["Image"]["name"]);
    $PostText = $_POST["PostDescription"];
    $admin ="suryavnshi";
    
    date_default_timezone_set("Asia/Kolkata");
    $CurrentTime=time();
    $DateTime=strftime("%B-%M-%Y %H:%M:%S",$CurrentTime);
    //echo $DateTime;
    
   

    if (empty($postTitle))
    {
       $_SESSION["ErrorMessage"]="Title cant be empty";
        Redirect_to("post2.php");  
    }
    elseif (strlen($postTitle)<5)
    {
        $_SESSION["ErrorMessage"]="Post title should be greater than 5 character";
        Redirect_to("post2.php");
    }
    elseif(strlen($PostText)>9999)
    {
        $_SESSION["ErrorMessage"]="Post Description  should be less than 10000character";
        Redirect_to("post2.php");
    }
        else 
        {
                // Query to Update post in DB when everythink is fine
                global $connectingDB;
                if (!empty($_FILES["Image"]["name"])){
                    $sql ="UPDATE posts
                 SET title = '$postTitle', category='$Category',image='$Image', post='$PostText'
                 WHERE id= '$SarchQueryParameter'";

                }else {
                    $sql ="UPDATE posts
                 SET title = '$postTitle', category='$Category', post='$PostText'
                 WHERE id= '$SarchQueryParameter'";
                }

                
            
            $Execute =$connectingDB->query($sql);
            move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);

                if($Execute)
                {
                    $_SESSION["SuccessMessage"]="Post Updated Successfully";
                    Redirect_to("post2.php");

                } 
                else
                {
                    $_SESSION["ErrorMessage"]="Something went wrong. Try Again !";
                    Redirect_to("post2.php");     
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
    <title>Edit Post</title>
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
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/AI.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/code.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item shivam">
      <img src="img/computer2.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
 <!-- header-->
 <header class="bg-dark text-white py-3">
     <div class="container">
    <div class="row">
        <div class="col-md-12">
        <h1><i class="fas fa-text-height" style="color:#27aae1;"></i> Edit Post</h1>
        </div>
        </div>
        </div>

        </header>
 <!-- header end -->
<!--Main area-->
<section class="container py-2 mb-4">
    <div class="row" >
        <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
<?php
echo ErrorMessage();
echo SuccessMessage();
//Fetching Existing Content according to our
global $connectingDB;
 
$sql =" SELECT * FROM posts WHERE id='$SarchQueryParameter'";
$stmt= $connectingDB -> query($sql);
while ($DataRows=$stmt->fetch()){

    $TitleToBeUpdated = $DataRows['title'];
    $CategoryToBeUpdated = $DataRows['category'];
    $ImageToBeUpdated = $DataRows['image'];
    $PostToBeUpdated = $DataRows['post'];
}

?>


            <form class="" action="Editpost.php? id=<?php echo $SarchQueryParameter;?>"  method="POST" enctype="multipart/form-data">
                <div class="card bg-secondary text-light mb-3">
                    <div class="card-body bg-dark">
                        <div class="form-group">

                        <label for="title"> <span class="FieldInfo">Post Title: </span> </label>

 <input class="form-control" type="text" name="postTitle" id="title" placeholder="Type title here " value=" <?php echo $CategoryToBeUpdated;?> "> 

                                            </div>
    <span class="FieldInfo"> Existing Category: </span>
    <?php echo $CategoryToBeUpdated;?>
<br>

<div class="form-group">
    <label for="CategoryTitle"> <span class="FieldInfo"> Chose category </span> </label>
    <select class="form-control" id="CategoryTitle" name="Category">
       <?php 
       //fetching all the categories from categories table
       global $connectingDB;
       $sql="SELECT * FROM  categories";
       $stmt=$connectingDB->query($sql);

    while ($DataRows = $stmt-> Fetch())
 {

 $id=$DataRows["id"];
 $CategoryName=$DataRows["title"];
   
       ?>

<option> <?php  echo $CategoryName; ?> </option>
            <?php } ?>
</select>
</div>

    <div class="form=group mb-1">
    <span class="FieldInfo"> Existing Image: </span>
    <img class="mb-1" src="img1/" <?php echo $ImageToBeUpdated;?> width="170px"; height="70px;">

 <div class="custom=file">
<input class="custom-file-input" type="File" name="Image"  id="imageSelect" value="">
<label for="imageSelect" class="custom-file-label"> Select Image </label>
</div>
</div>

<div class="form-group">
    <label for="Post"> <span class="FieldInfo"> Post: </span></label>
    <textarea class="form-control" id="post" name="PostDescription" row="30" cols="100">
<?php  echo $PostToBeUpdated;   ?>
    
    </textarea>
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