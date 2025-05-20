<?php
if(isset($_POST['addcar']) ){
    require_once('connection.php');
    $adminid=mysqli_real_escape_string($con,$_POST['adminid']);
    $adminpassword=mysqli_real_escape_string($con,$_POST['adminpassword']);
    $query="INSERT INTO admin(ADMIN_ID,ADMIN_PASSWORD) values('$adminid','$adminpassword')";
    $res=mysqli_query($con,$query);
    if($res){
        echo '<script>alert("New ADMIN Added Successfully!!")</script>';
        echo '<script> window.location.href = "adminmanagement.php";</script>';                }
}
else{
    $em="unknown error occured";
    header("Location: addadmin.php?error=$em");
}








?>
