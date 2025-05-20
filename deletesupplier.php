<?php

require_once('connection.php');
$carid=$_GET['id'];
$sql="DELETE from suppliers where supplier_id='$carid'";
$result=mysqli_query($con,$sql);

echo '<script>alert("SUPPLIER DELETED SUCCESSFULLY")</script>';
echo '<script> window.location.href = "adminsupplier.php";</script>';



?>