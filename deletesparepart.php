<?php

require_once('connection.php');
$carid=$_GET['id'];
$sql="DELETE from master_spareparts where sparepart_id='$carid'";
$result=mysqli_query($con,$sql);

echo '<script>alert("SPAREPART DELETED SUCCESSFULLY")</script>';
echo '<script> window.location.href = "adminsparepart.php";</script>';



?>