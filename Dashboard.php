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
    <title>Dashboard</title>
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
                                    <a href="Blog.php" class="nav-link">Live Blog</a>
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
            <h1><i class="fas fa--height" style="color:#27aae1;"></i>Dashboard</h1>
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
            <a href="Comment.php.php" class="btn btn-success btn-block">
                <i class="fas fa-folder-check "> </i> Approve Comments

</a>
</div>
        </div>
        </div>

        </header>
 <!-- header end -->

<!-- Main area -->
<section class="container py- 2mb-4">
    <div class="row">
    <?php
echo ErrorMessage();
echo SuccessMessage();

?>
<!-- left side area start-->
    <div class="col-lg-2 d-none d-md-block">
        <div class="card text-center bg-dark text-white mb-3">
            <div class=" card-body ">
                <h1 class="lead"> Posts </h1>
                <h4 class="display-5"></h4>
                <i class="fab fa-readme"></i>
                <?php 
                global $connectingDB;
                $sql ="SELECT COUNT(*) FROM posts";
                $stmt=$connectingDB->query($sql);
                $TotalRows=$stmt->fetch();
                $TotalPosts=array_shift($TotalRows);
                echo $TotalPosts;
                ?>
            </div>

        </div>
        
        <div class="card text-center bg-dark text-white mb-3">
            <div class=" card-body ">
                <h1 class="lead"> Categories </h1>
                <h4 class="display-5"></h4>
                <i class="fas fa-folder"></i>
                <?php 
                TotalCategories();
                ?>
            </div>

        </div>

        <div class="card text-center bg-dark text-white mb-3">
            <div class=" card-body ">
                <h1 class="lead"> Admins </h1>
                <h4 class="display-5"></h4>
                <i class="fas fa-users"></i>
                <?php 
                Totaladmins();
                ?>
            </div>

        </div>

        <div class="card text-center bg-dark text-white mb-3">
            <div class=" card-body ">
                <h1 class="lead"> Comments</h1>
                <h4 class="display-5"></h4>
                <i class="fas fa-comments"></i>
                <?php 
                TotalComments();
                ?>
                     </div>

                 </div>

                </div>
    
<!-- left side area end-->

<!-- right side area start-->  

        <div class="col-lg-10 ">
            <h1> Top Posts</h1>
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Date&Time</th>
                        <th>Author</th>
                        <th>Comments</th>
                        <th>Deatils</th>
                    </tr>

                </thead>
                <?php 
              $SrNo=0;
              global $connectingDB;
              $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,5"; 
              $stmt=$connectingDB->query($sql);
              while ($DataRows=$stmt->fetch()){
                  $PostId=$DataRows["id"];
                  $DateTime=$DataRows["datetime"];
                  $Author=$DataRows["author"];
                  $Title=$DataRows["title"];
                  $SrNo++;
              
              ?>
              <tbody>
                  <tr>
                      <td><?php echo $SrNo; ?></td>
                      <td><?php echo $Title; ?></td>
                      <td><?php echo $DateTime; ?></td>
                      <td><?php echo $Author; ?></td>
                      <td>
                      
                          <?php 
                         $Total=ApproveCommentAccordingtoPost($PostId);
                          if ($Total>0){ ?>
                            <span class="badge text-dark badge-success">
                            
                            <?php
                              echo $Total;?>
                              </span>
                        <?php  }
                          ?>

                      </span>

                      <?php 
                         $Total=DisApproveCommentAccordingtoPost($PostId);

                          if ($Total>0){ ?>
                            <span class="badge text-dark badge-danger">
                            
                            <?php
                              echo $Total;?>
                              </span>
                        <?php  }
                          ?>

                      </span>
                    </td>
                      <td> <a target="_black" href="Fullpost.php ? id=<?php echo $PostId; ?> ">
                       <span class="btn btn-info "> Preview </span>
                       </a>
                       </td>
                  </tr>
              </tbody>
              <?php } ?>

            </table>

        </div>

<!-- right side area end-->  
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