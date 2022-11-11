<?php require_once("DB.php");
?>
<?php require_once("function.php");
?>
<?php require_once("Session.php");
?>

<?php
$SearchQueryParameter = $_GET["id"];
if(isset($_POST["Submit"]))
{
    $Name=$_POST["CommenterName"];
    $Email=$_POST["CommenterEmail"];
    $Comment =$_POST["CommenterThoughts"];
    

    date_default_timezone_set("Asia/Kolkata");
    $CurrentTime=time();
    $DateTime=strftime("%B-%M-%Y %H:%M:%S",$CurrentTime);
    //echo $DateTime;l
    
   

    if (empty($Name)||empty($Email)||empty($Comment))
    {
       $_SESSION["ErrorMessage"]="All fields must be filled out";
        Redirect_to("Fullpost.php?id={$SearchQueryParameter}");  
    }
    elseif (strlen($Comment)>500)
    {
        $_SESSION["ErrorMessage"]="Comment length should be less than 500 character";
        Redirect_to("Fullpost.php?id=${SearchQueryParameter}");
    } else {

    
               // Query to insert comment in DB when everythink is fine
                global $connectingDB;

            $sql ="INSERT INTO comments(datetime,name,email,comment,approvedby,status,post_id)";
            $sql .=" VALUES (:dateTime,:name,:email,:comment,'Pending','OFF',:postId)";
            $stmt =$connectingDB ->prepare($sql);
            $stmt->bindValue(':dateTime',$DateTime);
            $stmt->bindValue(':name',$Name);
            $stmt->bindValue(':email',$Email);
            $stmt->bindValue(':comment',$Comment);
            $stmt->bindValue(':postId',$SearchQueryParameter);
        
            $Execute = $stmt -> execute();
            var_dump($Execute);
         
            

             if($Execute){
                  $_SESSION["SuccessMessage"]="Comment Submitted Successfully";
                  Redirect_to("Fullpost.php?id={$SearchQueryParameter}");
              } else{
                  $_SESSION["ErrorMessage"]="Something went wrong. Try Again !";
                   Redirect_to("Fullpost.php?id={$SearchQueryParameter}");    
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
    <title>Full Post Page</title>
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

            // The defult SQL query
            else {
                $PostsIdFromURL=$_GET["id"];
                if (!isset($PostsIdFromURL)){
                    $_SESSION["Error Message"]="Bad Request!";
                    Redirect_to("Blog.php");
                }

                $sql ="SELECT * FROM  posts WHERE id='$PostsIdFromURL'" ;
                $stmt=$connectingDB->query($sql);
                $Result=$stmt->rowcount();
                if ($Result!=1){
                    $_SESSION["ErrorMessage"]="Bad Request !";
                    Redirect_to("Blog.php?page=1");

                }
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
<small class="text-muted">Category:<span class="text-dark"><a href="Blog.php?category=<?php echo htmlentities($Category);?>><?php echo htmlentities($Category);?></a></span> & Written by <span class="text-dark"><a href="Profile.php?username=<?php echo htmlentities($Admin);?>"> <?php echo htmlentities ($Admin); ?> </a></span> On <span class="text-dark"> <?php  echo htmlentities ($DateTime); ?></span></small>
                
                
                <hr>
                <p class="card-text"> 
                <?php  echo nl2br ($PostDescription); ?> </p>
      
        </div>
        <?php }   ?>
        </div>
        <!-- comment part start -->
                <!-- Fetching existing comment Start -->
                <span class="FieldInfo"> Comments</span>
                <br>
                <?php
                 global $connectingDB;
                 $sql ="SELECT * FROM comments
                  WHERE post_id='$SearchQueryParameter' AND status ='ON'";
                 $stmt =$connectingDB->query($sql);
                 while ($DataRows =$stmt->fetch()){
                $CommentDate     = $DataRows['datetime'];
                $CommenterName     = $DataRows['name'];
                $CommentContent  = $DataRows['comment'];  ?>
        </div>
    
    <div class="media .CommentBlock">
    <img class="d-block img-fluid align-self-start" src="img/womanfit " alt="">
        <div class="media-body ml-2">
            <h6 class="lead"> <?php  echo $CommenterName;?></h6>
            <p class="small"> <?php echo $CommentDate; ?></p>
            <p> <?php echo $CommentContent; ?></p>
        </div>

    </div>

<hr>
<?php } ?>

                <!-- Fetching existing comment End -->

<div class="">
    <form class="" action="Fullpost.php?id=<?php echo $SearchQueryParameter ?>" method="post">
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="FieldInfo">Share your thoughts about this post </h5>

        </div>
<div class="card-body"> 
    <div class="form-group">
        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fas-user"></i>

            </span>
            </div> 
        <input class=" form-control " type="text" name="CommenterName" placeholder="Name" value=""></input>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fas-envelope "></i>

            </span>
            </div> 
        <input class=" form-control" type="email" name="CommenterEmail" placeholder="Email" value=""></input>
        </div>
    </div>
    <div class="form-group">
        <textarea  name="CommenterThoughts" class="form-control" rows="6 " cols="80">

        </textarea>
        <div class="">
                <button type="Submit" name="Submit" class="btn btn-primary"> Submit</button>
        </div>

    </div>
</div>
    </div>

    </form>
            </div>        
<!-- comment part end start -->
</div>
<!-- Main area-->


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
                         <a href="Blog.php?Category=<?php echo $CategoryName; ?>">   <span class="heading"><?php echo $CategoryName;?></span></a> <br>
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
                  <a href="Fullpost.php?id=<?php echo htmlentities($Id) ?>" target="_black" >  <h6 class="lead"><?php echo htmlentities($Title); ?></h6></a>
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

</div></div>
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
</div></div>
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