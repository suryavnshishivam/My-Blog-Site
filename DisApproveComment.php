<?php require_once("DB.php");
?>
<?php require_once("function.php");
?>
<?php require_once("Session.php");
?>

<?php 
if (isset($_GET["id"])){
    $SearchQueryParameter = $_GET["id"];
    global $connectingDB;
    $Admin = $_SESSION["AdminName"];
    $sql ="UPDATE comments SET status ='OFF' ,approvedby='$Admin' WHERE id='$SearchQueryParameter'";
    $Execute= $connectingDB->query($sql);
    if ($Execute){
        $_SESSION["SuccessMessage"]="Comment Dis-Approved Successfully !";
        Redirect_to("Comments.php");
    }else{
        $_SESSION["ErrorMessage"]="Something went Wrong. Try Again !";
        Redirect_to("Comments.php");
    }

}
?> 