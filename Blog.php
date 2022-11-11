<?php require_once("DB.php");
?>
<?php require_once("function.php");
?>
<?php require_once("Session.php");
?>
<?php 
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
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
    <title>Blog page</title>
    <style media="screen"> .heading{
    font-family: Bitter,Georgia, 'Times New Roman', Times, serif;
    font-weight: bold;
    color: #005e90;
}
.heading:hover{
    color: #0090db;
}
</style>
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
    <div class="container">
        <div class="row mt-4">
            <!-- Main area -->
            <div class="col-sm-8">
            <h1> The Complete Responsive CMS Blog</h1>
            <h1 class="lead"> The Complete Blog by using PHP by Suryavnshi Shivam</h1>

            <?php
                echo ErrorMessage();
                echo SuccessMessage();

                ?>
             <?php 
             global $connectingDB;
                if (isset($_GET["SearchButton"])){
                 $Search =$_GET["Search"]; 

                    $sql = "SELECT * FROM  posts
                     WHERE datetime LIKE :search
                     OR title LIKE    :search 
                     OR category LIKE :search 
                     OR post     LIKE :search ";
                     $stmt =$connectingDB->prepare($sql);
                     $stmt->bindValue(':search','%'.$Search.'%');
                     $stmt->execute();
                }
            //Query when pagination is active i.e blog.php?page=1                
                elseif(isset($_GET["page"])){
                    $Page = $_GET["page"];
                    if ($Page==0 || $Page<1){
                    $ShowPostFrom=0;
                    }else{
                        $ShowPostFrom=($Page*3)-3;   
                    }
                   
                    $sql ="SELECT * FROM posts ORDER BY id desc  LIMIT $ShowPostFrom,3";
                    $stmt=$connectingDB->query($sql);
                }
                //Query When Category is active in URL Tab
                elseif (isset($_GET["category"])){
                    $Category=$_GET["category"];
                    $sql="SELECT * FROM posts WHERE category='$Category' ORDER BY id desc";
                    $stmt=$connectingDB->query($sql);



                }

            // The defult SQL query
            else {
                $sql ="SELECT * FROM  posts ORDER BY id desc LIMIT 0,3" ;
                $stmt=$connectingDB->query($sql);
            }
           

            while($DataRows=$stmt->fetch()){

                $PostsId           =  $DataRows["id"];
                $DateTime          =  $DataRows["datetime"];
                $PostTitle         =  $DataRows["title"];
                $Category          =  $DataRows["category"];
                $Admin             =  $DataRows["author"];
                $Image             =  $DataRows["image"];
                $PostDescription   =  $DataRows["post"];
             ?>

            <div class="card ">
                <img src="img/<?php echo htmlentities ($Image);?>" style="max -height 45px;" class="img-fluid card-img-top" />
            <div class="card-body">
                <h4 class="card-title"> <?php echo htmlentities ($PostTitle);?> </h4>
                <small class=" text-muted">Category: <span class="text-dark"> 
                    <a href="Blog.php?category="<?php echo htmlentities($Category);?>><?php echo htmlentities($Category);?></a></span> 
                    & Written by <span class="text-dark"><a href="Profile.php?username=<?php echo htmlentities($Admin);?>">
                     <?php echo htmlentities ($Admin); ?> </a></span> On <span class="text-dark">
                          <?php  echo htmlentities ($DateTime); ?></span></small>
                <span style="float:right;" class="badge text-dark badge-dark" > Comments 
                <?php echo ApproveCommentAccordingtoPost($PostsId);?>
             </span>
                
                <hr>
                <p class="card-text"> 
                <?php if (strlen($PostDescription)>150){
          $PostDescription =substr($PostDescription,0,150)."..."; } echo htmlentities ($PostDescription); ?> </p>
                <a href="FullPost.php?id=<?php  echo $PostsId;?>" style="float:right;">
                <span class="btn btn-info">Read More  >> </span>>
        </a>
        </div></div>
        <?php }   ?>
             <!--   pagination -->
             <nav>
                 <ul class="pagination pagination-lg">
                     <!--Creating Backword Button -->
            <?php if (isset($Page)){
                if ($Page>1){

                
                ?>
            <li class="page-item ">
            <a href="Blog.php?page=<?php echo $Page-1; ?>" class="page-link">&laquo;</a>
                        </li> 
                        <?php } }?>
                    <?php 
                    global $connectingDB;
                    $sql="SELECT COUNT(*) FROM posts";
                    $stmt=$connectingDB->query($sql);
                    $RowPagination=$stmt->fetch();
                    $TotalPosts=array_shift($RowPagination);
                   // echo $TotalPosts."<br>";
                    $PostPaagination=$TotalPosts/5;
                    $PostPaagination=ceil($PostPaagination);
                   // echo $PostPaagination;
                    for ($i=1; $i <=$PostPaagination ; $i++) { 
                        if (isset($Page)){
                            if ($i==$Page) {
                                ?>
                    <li class="page-item active">
                        <a href="Blog.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                    </li> 
                <?php
                 } else { ?>
                            <li class="page-item ">
                            <a href="Blog.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                        </li> 
                <?php        }      
            
            } }  ?>
<!--Creating Forword Button -->
            <?php if (isset($Page)&&!empty($Page)){
                if ($Page+1<=$PostPaagination){

                
                ?>
            <li class="page-item ">
            <a href="Blog.php?page=<?php echo $Page+1; ?>" class="page-link">&raquo;</a>
                        </li> 
                        <?php } }?>
                     </ul>
                   </nav>
                </div>
                
<!-- Main area end -->

<!-- side area start-->
            <div class="col-sm-4"  >
            <div class="card mt-4">
            <div class="card-body">
                <img src="img/laptop" class="d-block img-fluid mb-3" alt="">
                <div class="text-center">
                A warm greeting to everyone present here. Today I am here to talk about technology and how it has gifted us with various innovations.
                 Technology as we know it is the application of scientific ideas to develop a machine or a device for serving the needs of humans.
                  We, human beings, are completely dependent on technology in our daily life. We have used technology in every aspect of our life starting 
                  from household needs, schools, offices, communication and entertainment. Our life has been more comfortable due to the use of technology.
                   We are in a much better and comfortable position as compared to our older generation. This is possible because of various contributions
                    and innovations made in the field of technology. Everything has been made easily accessible for us at our fingertips right from buying 
                    a thing online to making any banking transaction. It has also led to the invention of the internet which gave us access to search for any
                     information on google. But there are also some disadvantages. Relying too much on technology has made us physically lazy and unhealthy due
                      to the lack of any physical activity. Children have become more prone to video games and social media which have led to obesity and depression.
                       Since they are no longer used to playing outside and socialising, they often feel isolated. Therefore, we must not totally be dependent on 
                       technology and should try using it in a productive way.

                </div>

                </div>

                </div>
                <br>
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        <h2 class="lead">Sign Up!</h2>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-success btn-block text-center text-white mb-4" name="button">Join the Forum </button>
                        <button type="button" class="btn btn-danger btn-block text-center text-white mb-4" name="button">Login </button>
                   <div class="input-group mb-3">
                       <input type="text" class="form-control" name="" placeholder="Enter your email"  value="">
                       <div class="input-group-append">
                           <button type="button" class="btn btn-primary btn-sm text-center text-white" name="button" >Subscribe Now</button>
                        </div>
                        </div>
                        </div>
                        </div>
                        

                    <br>
                    <div class="card">
                        <div class="card-header bg-primary text-light">
                            <h2 class="lead">Categories</h2>
                            </div>
                            <div class="card-body">
                                <?php 
                                global $connectingDB;
                                $sql="SELECT * FROM categories ORDER BY id desc";
                                $stmt=$connectingDB->query($sql);
                                while ($DataRows = $stmt->fetch() ) {
                                    $CategoryId=$DataRows["id"];
                                    $CategoryName=$DataRows["title"];

                                    
                            ?>
                         <a href="Blog.php?category=<?php echo $CategoryName; ?>">   <span class="heading"><?php echo $CategoryName;?></span></a> <br>
                            <?php } ?>
                             </div>
                            </div>
                            
  <br>
  <div class="card">
      <div class="card-header bg-info text-white">
          <h2 class="lead"> Recent Posts</h2>
           </div>
           <div class="card-body">
               <?php 
               global $connectingDB;
               $sql="SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
               $stmt=$connectingDB->query($sql);
               while ($DataRows=$stmt->fetch()){
                   $Id          = $DataRows['id'];
                   $Title       = $DataRows['title'];
                   $DateTime    = $DataRows['datetime'];
                   $Image       = $DataRows['image'];
               ?>
               <div class="media">
                   <img src="img/<?php echo htmlentities($Image); ?> " class="d-block img-fluid align-self-start" width="90" height="94" alt="">
                <div class="media-body ml-2">
                  <a href="Fullpost.php?id=<?php echo htmlentities($Id); ?>" target="_black" >  <h6 class="lead"><?php echo htmlentities($Title); ?></h6></a>
                    <p class="small"><?php echo htmlentities($DateTime); ?></p>

                </div>
               </div>
               <hr>
               <?php } ?>
           </div>
  </div>
  </div>


<!-- side area end-->
</div>
</div>

 <!-- header end -->
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