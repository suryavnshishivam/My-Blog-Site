<?php
date_default_timezone_set("Asia/Kolkata");
$CurrentTime=time();
$DateTime=strftime("%B-%M-%Y %H:%M:%S",$CurrentTime);
echo $DateTime;

?>