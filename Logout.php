<?php require_once("function.php");
?>
<?php require_once("Session.php");
?>

<?php 

$_SESSION["UserID"]=null;
$_SESSION["UserName"]=null;
$_SESSION["AdminName"]=null;

session_destroy();
Redirect_to("Login.php");



?>