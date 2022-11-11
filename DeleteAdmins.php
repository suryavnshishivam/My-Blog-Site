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
    
    $sql ="DELETE FROM admins WHERE id='$SearchQueryParameter'";
    $Execute= $connectingDB->query($sql);
    if ($Execute){
        $_SESSION["SuccessMessage"]="Admin Deleted Successfully !";
        Redirect_to("Admins.php");
    }else{
        $_SESSION["ErrorMessage"]="Something went Wrong. Try Again !";
        Redirect_to("Admins.php");
    }

}
?> 