<?php

require_once('connection.php');
$carid=$_GET['id'];
$sql="DELETE from admin where ADMIN_ID='$carid'";
$result=mysqli_query($con,$sql);

echo '<script>alert("ADMIN DELETED SUCCESSFULLY")</script>';
echo '<script> window.location.href = "adminmanagement.php";</script>';



?>