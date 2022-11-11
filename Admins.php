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
    $UserName=$_POST["username"];
    $Name=$_POST["Name"];
    $Password=$_POST['Password'];
    $ConfirmPassword=$_POST['ConfirmPassword'];
    $admin =$_SESSION["UserName"];

    date_default_timezone_set("Asia/Kolkata");
    $CurrentTime=time();
    $DateTime=strftime("%B-%M-%Y %H:%M:%S",$CurrentTime);
    echo $DateTime;
    
   
    
    if (empty($UserName)||empty($Password)||empty($ConfirmPassword))
    {
       $_SESSION["ErrorMessage"]="All fields must be filled out";
        Redirect_to("Admins.php");  
    } 
     elseif (strlen($Password)<4)
       
    {
        $_SESSION["ErrorMessage"]="Password should be greater than 3 character";
        Redirect_to("Admins.php");

    } 
    elseif ($Password !== $ConfirmPassword)
   
    {
        $_SESSION["ErrorMessage"]="Password and confirm Password should match";
        Redirect_to("Admins.php");
    }
    elseif (CheckUserNameExistsOrNot($UserName))
   
    {
        $_SESSION["ErrorMessage"]="Username Exists. Try Another One";
        Redirect_to("Admins.php");
    }
    else
    {
            // Query to insert new admins in DB when everythink is fine
                global $connectingDB;

            $sql ="INSERT INTO admins(datetime,username,password,aname,addedby)";
            $sql .=" VALUES(:dateTime,:userName,:password,:aName,:adminName)";
            $stmt =$connectingDB ->prepare($sql);
            $stmt->bindValue(':dateTime',$DateTime);
            $stmt->bindValue(':userName',$UserName);
            $stmt->bindValue(':password',$Password);
            $stmt->bindValue(':aName',$Name);
            $stmt->bindValue(':adminName',$admin);

            $Execute=$stmt->execute();

                if($Execute)
                {
                    $_SESSION["SuccessMessage"]="New Admin with the name of ".$Name." added Successfully";
                    Redirect_to("Admins.php");

                } 
                else
                {
                    $_SESSION["ErrorMessage"]="Something went wrong. Try Again";
                    Redirect_to("Admins.php");     
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
    <title>Admins page</title>
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
        <h1><i class="fas fa-user" style="color:#27aae1;"></i> Manage Admins</h1>
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


            <form class="" action="Admins.php" method="POST">
                <div class="card bg-secondary text-light mb-3">
                    <div class="card-header">
                        <h1>Add New Admin</h1>

                        </div>
                            <div class="card-body bg-dark">
                                <div class="form-group">
                                    <label for="username"> <span class="FieldInfo">Username: </span> </label>
                         <input class="form-control" type="text" name="username" id="username"   value=""> 

                                            </div>
                            <div class="form-group">
                             <label for="Name"> <span class="FieldInfo">Name: </span> </label>
                         <input class="form-control" type="text" name="Name" id="Name"    value=""> 
                         <small class=" text-muted ">Optional </small>

                                            </div>
                                        
                             <div class="form-group">
                                    <label for="Password"> <span class="FieldInfo">Password: </span> </label>
                                        <input class="form-control" type="Password" name="Password" id="Password" value=""> 

                                            </div>
                                            <div class="form-group">
                                    <label for="ConfirmPassword"> <span class="FieldInfo"> Confirm Password: </span> </label>
                                        <input class="form-control" type="Password" name="ConfirmPassword" id="ConfirmPassword" value=""> 

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
                <h2> Existing Admin</h2>
<table class="table table-striped table-hover">
    <thear class="thead-dark">
        <tr>
            <th>No.</th>
            <th>Date&Time</th>
            <th> UserName </th>
            <th>Admin Name</th>
            <th>Added By</th>
            <th>Action</th>
            
            
        </tr>

    </thear>



  
    <?php 
    global $connectingDB;
    $sql = "SELECT * FROM admins ORDER BY  id desc ";
    $Execute= $connectingDB->query($sql);
    $SrNo=0;
    while($DataRows=$Execute->fetch()){
        $AdminId=$DataRows["id"];
        $DateTime=$DataRows["datetime"];
        $AdminUsername=$DataRows["username"];
        $AdminName=$DataRows["aname"];
        $AddedBy =$DataRows["addedby"];
        $SrNo++;
        
    
    ?>
    <tbody>
        <tr>
            <td> <?php  echo htmlentities($SrNo);?> </td>
            <td> <?php  echo htmlentities($DateTime);?></td>
            <td> <?php  echo htmlentities($AdminUsername);?></td>
            <td> <?php  echo htmlentities($AdminName);?> </td>
            <td> <?php  echo htmlentities($AddedBy);?> </td>
            
           <td> <a href="DeleteAdmins.php?id=<?php echo $AdminId;?>"class="btn btn-danger"> Delete</a> </td>
            

        </tr>
        
    </tbody>
    <?php }?>
    </table>



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