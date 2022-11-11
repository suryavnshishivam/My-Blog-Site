<?php require_once("DB.php");
?>
<?php require_once("function.php");
?>
<?php require_once("Session.php");?>

<?php 
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
//echo $_SESSION["TrackingURL"];
Confirm_Login(); ?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/899f6019c7.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Post</title>
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
                        <a href="Categories.php" class="nav-link">Categories</a>
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
        <li class="nav-item"><a href="Logout.php" class="nav-link text-danger "> 
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
            <h1><i class="fas fa-text-height" style="color:#27aae1;"></i> Blog Posts</h1>
        </div>

        <div class="col-lg-3 mb-2">
            <a href="post.php" class="btn-info btn-block">
                <i class="fas fa-folder-plus"> </i> Add new Post
</a>
</div>
        <div class="col-lg-3 mb-4">
            <a href="categories.php" class="btn-info btn-block">
                <i class="fas fa-folder-plus"> </i> Add new Category
</a>
</div>
        <div class="col-lg-3 mb-4">
            <a href="Admin.php.php" class="btn btn-warning btn-block">
                <i class="fas fa-folder-user-plus"> </i> Add new Admin
</a>
</div>

        <div class="col-lg-3 mb-4">
            <a href="Comments.php" class="btn btn-success btn-block">
                <i class="fas fa-folder-check "> </i> Approve Comments

</a>
</div>
        </div>
        </div>

        </header>
 <!-- header end -->

<!-- Main area -->
<section class="container py- 2mb-4">
    <div class="col-lg-12">

    <?php
echo ErrorMessage();
echo SuccessMessage();

?>
        <table class=" table table-striped table-hover"> 
            <thead class="thead-darl"> 

            
        <tr>
                
        <th> #</th>
        <th>Title </th>
        <th>Category </th>
        <th> Date&Time</th>
        <th>Author </th>
        <th>Banner </th>
        <th>Comments</th>
        <th>Action</th>
        <th>Live Preview </th>
</tr>
    </thead>


        <?php 
        global $connectingDB;
        $sql =" SELECT * FROM posts";
        $stmt = $connectingDB->query($sql);
        $Sr =0;
        while ($DataRows=$stmt->fetch())
        {
                $Id         =  $DataRows["id"];
                $DateTime   =  $DataRows["datetime"];
                $PostTitle  =  $DataRows["title"];
                $Category   =  $DataRows["category"];
                $Admin      =  $DataRows["author"];
                $Image      =  $DataRows["image"];
                $PostText   =  $DataRows["post"];
                $Sr++;
 ?>             

                <tbody> 

        <tr>
            
        <td> 
                    <?php echo $Sr;?>
                
        </td>

        <td>
                     <?php  
                        if (strlen($PostTitle)>20){ $PostTitle = substr($PostTitle,0,14).'..';} 
                        echo $PostTitle; ?> 
        </td>
        <td>         <?php 
                        if (strlen($Category)>3){ $Category = substr($Category,0,3).'..';} 
                        echo  $Category; ?> 
        </td>

        <td>         <?php 
                        if (strlen($DateTime)>11){ $DateTime = substr($DateTime,0,11).'..';} 
                        echo $DateTime; ?> 
        </td>
        <td>         <?php 
                        if (strlen($Admin)>6){ $Admin = substr($Admin,0,6).'..';}   
                        echo $Admin; ?> 
        </td>

        <td> <img src="img/<?php echo $Image; ?>" width="170px;" height="50px"></td>
        <td>
                      
                          <?php 
                         $Total=ApproveCommentAccordingtoPost($Id);
                          if ($Total>0){ ?>
                            <span class="badge text-dark badge-success">
                            
                            <?php
                              echo $Total;?>
                              </span>
                        <?php  }
                          ?>

                      </span>

                      <?php 
                         $Total=DisApproveCommentAccordingtoPost($Id);

                          if ($Total>0){ ?>
                            <span class="badge text-dark badge-danger">
                            
                            <?php
                              echo $Total;?>
                              </span>
                        <?php  }
                          ?>

                      </span>
                    </td>
        <td> <a href="Editpost.php? id=<?php echo $Id;?>"> <span class="btn btn-warning">Edit </span></a>
             <a href="Deletepost.php? id=<?php echo $Id;?>"> <span class="btn btn-danger">Delete </span></a>
    </td>
        <td><a href="Fullpost.php? id=<?php echo $Id;?>" target=" _blank"> <span class="btn btn-primary">LivePreview </span></a></td>
</tr>
</tbody>

<?php  } ?>
        </table>
    </div>
    


</section>




<!-- Main Area end -->



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