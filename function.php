<?php require_once("DB.php");?>
<?php
function Redirect_to($new_Location)
{
header("Location:".$new_Location);
exit;

}
function CheckUserNameExistsOrNot($UserName)
{
  global  $connectingDB;
  $sql ="SELECT username FROM admins WHERE username=:username";
  $stmt=$connectingDB->prepare($sql);
  $stmt->bindValue(':username',$UserName);
  $stmt->execute();
  $Result =$stmt->rowcount();
  if ($Result==1)
  {
      return true;
  }
   else
   {
      return false;
  }
}

function Login_Attempt($UserName,$Password) {
    global $connectingDB;
    $sql =" SELECT * FROM admins WHERE username=:userName AND password=:passWord LIMIT 1"; 
    $stmt=$connectingDB->prepare($sql);
    $stmt->bindValue(':userName',$UserName);
    $stmt->bindValue(':passWord',$Password);
    $stmt->execute();
    $Result =$stmt->rowcount();
    if ($Result==1){
      return $Found_Account=$stmt->fetch();
    }else {
       return null;
    }
}

function Confirm_Login()
{
if (isset($_SESSION["UserID"]))
 {
    return true;
    }
     else
    {
        $_SESSION["ErrorMessage"]="Login Requried !";
        Redirect_to("Login.php");
    }
}

function TotalPosts(){

  global $connectingDB;
  $sql ="SELECT COUNT(*) FROM comments";
  $stmt=$connectingDB->query($sql);
  $TotalRows=$stmt->fetch();
  $Totalcomments=array_shift($TotalRows);
  echo $Totalcomments;
}

function TotalCategories(){

  global $connectingDB;
  $sql ="SELECT COUNT(*) FROM Categories";
  $stmt=$connectingDB->query($sql);
  $TotalRows=$stmt->fetch();
  $TotalCategories=array_shift($TotalRows);
  echo $TotalCategories;

}
function Totaladmins(){
global $connectingDB;
$sql ="SELECT COUNT(*) FROM admins";
$stmt=$connectingDB->query($sql);
$TotalRows=$stmt->fetch();
$Totaladmins=array_shift($TotalRows);
echo $Totaladmins;
}

function TotalComments(){

  global $connectingDB;
  $sql ="SELECT COUNT(*) FROM comments";
  $stmt=$connectingDB->query($sql);
  $TotalRows=$stmt->fetch();
  $TotalComments=array_shift($TotalRows);
  echo $TotalComments;

}

function ApproveCommentAccordingtoPost($PostId){
global $connectingDB;
 $sqlApprove ="SELECT COUNT(*) FROM comments WHERE post_id='$PostId' AND status='ON'";
 $stmtApprove=$connectingDB->query($sqlApprove);
 $RowsTotal=$stmtApprove->fetch();
 $Total= array_shift($RowsTotal);
 return $Total;

}

function DisApproveCommentAccordingtoPost($PostId){
  global $connectingDB;
  $sqlDisApprove ="SELECT COUNT(*) FROM comments WHERE post_id='$PostId' AND status='OFF'";
  $stmtDisApprove=$connectingDB->query($sqlDisApprove);
  $RowsTotal=$stmtDisApprove->fetch();
  $Total= array_shift($RowsTotal);
  return $Total;
}
?>