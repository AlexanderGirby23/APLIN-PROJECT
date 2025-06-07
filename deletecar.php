<?php

require_once('connection.php');
$carid=$_GET['id'];
$sql="UPDATE cars set DELETED = CURRENT_TIMESTAMP() where CAR_ID=$carid";
$result=mysqli_query($con,$sql);

echo '<script>alert("CAR DELETED SUCCESSFULLY")</script>';
echo '<script> window.location.href = "adminvehicle.php";</script>';



?>