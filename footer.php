
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