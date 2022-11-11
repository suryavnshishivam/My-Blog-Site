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
if(isset($_POST["Submit"]))
{
    $postTitle=$_POST["postTitle"];
    $Category=$_POST["Category"];
    $Image=$_FILES["Image"]["name"];
    $Target ="img/".basename($_FILES["Image"]["name"]);
    $PostText = $_POST["PostDescription"];
    $admin =$_SESSION["UserName"];
    ;

    date_default_timezone_set("Asia/Kolkata");
    $CurrentTime=time();
    $DateTime=strftime("%B-%M-%Y %H:%M:%S",$CurrentTime);
    //echo $DateTime;
    
   

    if (empty($postTitle))
    {
       $_SESSION["ErrorMessage"]="Title cant be empty";
        Redirect_to("post.php");  
    }
    elseif (strlen($postTitle)<5)
    {
        $_SESSION["ErrorMessage"]="Post title should be greater than 5 character";
        Redirect_to("post.php");
    }
    elseif(strlen($PostText)>999)
    {
        $_SESSION["ErrorMessage"]="Post Description  should be less than 1000 character";
        Redirect_to("post.php");
    }
        else 
        {
                // Query to insert post in DB when everythink is fine
                global $connectingDB;

            $sql ="INSERT  INTO posts(datetime,title,category,author,image,post)";
            $sql .=" VALUES(:dateTime,:postTitle ,:categoryName,:adminName,:imageName,:PostDescription)";
            $stmt =$connectingDB ->prepare($sql);
            $stmt->bindValue(':dateTime',$DateTime);
            $stmt->bindValue(':postTitle',$postTitle);
            $stmt->bindValue(':categoryName',$Category);
            $stmt->bindValue(':adminName',$admin);
            $stmt->bindValue(':imageName',$Image);
            $stmt->bindValue(':PostDescription',$PostText);
            $Execute=$stmt->execute();

            move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);

                if($Execute)
                {
                    $_SESSION["SuccessMessage"]="Post with id :" .$connectingDB->lastInsertId(). " Added Successfully";
                    Redirect_to("post.php");

                } 
                else
                {
                    $_SESSION["ErrorMessage"]="Something went wrong. Try Again";
                    Redirect_to("post.php");     
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
    <title>Add New Post </title>
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
        <h1><i class="fas fa-text-height" style="color:#27aae1;"></i> Manage Categories</h1>
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

?>


            <form class="" action="post.php" method="POST" enctype="multipart/form-data">
                <div class="card bg-secondary text-light mb-3">
                    <div class="card-header">
                        <h1>Add New Post</h1>

                        </div>
                            <div class="card-body bg-dark">
                                <div class="form-group">
                                    <label for="title"> <span class="FieldInfo">Post Title: </span> </label>
                                        <input class="form-control" type="text" name="postTitle" id="title" placeholder="Type title here " value=""> 

                                            </div>

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
        <div class="custom=file">
<input class="custom-file-input" type="File" name="Image"  id="imageSelect" value="">
<label for="imageSelect" class="custom-file-label"> Select Image </label>
</div>
</div>

<div class="form-group">
    <label for="Post"> <span class="FieldInfo"> Post: </span></label>
    <textarea class="form-control" id="post" name="PostDescription" row="30" cols="100"></textarea>
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