<?php 
$conn=new mysqli("localhost","root","","carousel");

$msg ='';

if (isset($_POST['upload'])){
    $image= $_FILES['image']['name'];
    $path='image/'.$image;

    $sql = $conn->query("INSERT INTO slider (image_path) VALUES ('$path')");
    

    if ($sql){
        move_uploaded_file($_FILES['image']['tmp_name'],$path);
        $msg= 'Image Uploded  Successfully!';
}
else{
    $msg= 'Image Upload Failed!';
}
}
$result = $conn->query("SELECT image_path FROM slider");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic BS4  Carousel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
 
</head>
<body>
    <h2 class="text-center bg-dark text-light pb-2">Dynamic Bootstrap 4 Carousel Using  PHP & MySQLi</h2>
    
    <div class="container-fluid">
        <div class="row justify-content-center mb-2" >
            <div class="col-lg-10">
            <div id="demo" class="carousel slide" data-ride="carousel">

<!-- Indicators -->
<ul class="carousel-indicators">
        
        <?php 
        $i = 0;
        foreach($result as $row){
            $actives = '';
            if ($i==0){
                $actives = 'active';
            }
            ?>
            <li data-target="#demo" data-slide-to="<?= $i; ?>" class="<?= $actives;?>"></li>
            <?php  $i++; }?>
</ul>

<!-- The slideshow -->
<div class="carousel-inner">
<?php 
        $i = 0;
        foreach($result as $row){
            $actives = '';
            if ($i==0){
                $actives = 'active';
            }
            ?>
            
  <div class="carousel-item <?= $actives; ?>">
    <img src="<?= $row['image_path'] ?>" width = "100%" height="400px">
  </div>
  
  <?php $i++; } ?>
  
</div>

<!-- Left and right controls -->
<a class="carousel-control-prev" href="#demo" data-slide="prev">
  <span class="carousel-control-prev-icon"></span>
</a>
<a class="carousel-control-next" href="#demo" data-slide="next">
  <span class="carousel-control-next-icon"></span>
</a>

</div>
            </div>
        </div>

    <div class="row justify-content-center">
        <div class="col-lg-4 bg-dark rounded px-4">
            <h4 class="text-center text-light p-1">Select Image to Upload!
            </h4>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="file" name="image" class="from-control p-1" required>
                </div>
                <div class="form-group">
                    <input type="Submit" name="upload" class="btn btn-warning 
                    btn-block" value="Upload Image">
                </div>
                <div class="form-group">
                    <h5 class="text-center text-light"><?= $msg;  ?></h5>
                </div>
                
            </form>
    </div>  
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>