<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> Edit Admin Profile 
           
    </h6>
  </div>

  <div class="card-body">
  <?php    
    $connection= mysqli_connect("localhost","root","","banner");
  if (isset($_POST['edit_btn']))
{
    $id= $_POST['edit_id'];
    $query="SELECT * FROM register WHERE id='$id'";
    $query_run=mysqli_query($connection, $query);

    foreach ($query_run as $row )
    {
        ?>

            <form action="code.php" method="POST">
                <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
            <div class="form-group">
                <label> Username </label>
                <input type="text" name="edit_username" value="<?php echo $row['username'] ?>" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="edit_email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="edit_password" value="<?php echo $row['password'] ?>" class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label>UserType</label>
                <select name="update_usertype" class="form-control" >
                <option value="admin">Admin</option>
                <option value="user">user</option>
                </select>
            </div>



            <a href="register.php" class="btn btn-danger" > Cancel</a>
                <button  type="submit"  name="updatebtn" class="btn btn-primary" > Updated  </button>

                </form>
            <?php
    }    

}
?>     

  </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->



<?php
include('includes/scripts.php');
//include('includes/footer.php');
?>