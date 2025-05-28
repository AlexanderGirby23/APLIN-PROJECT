<?php

require_once('connection.php');
$carid=$_GET['id'];
$book_id=$_GET['bookid'];
$sql2="SELECT *from booking where BOOK_Id=$book_id";
$result2=mysqli_query($con,$sql2);
$res2 = mysqli_fetch_assoc($result2);
$sql="SELECT *from cars where CAR_ID=$carid";
$result=mysqli_query($con,$sql);
$res = mysqli_fetch_assoc($result);

if($res['AVAILABLE']=='Y')
{
    echo '<script>alert("Car already returned")</script>';
    echo '<script> window.location.href = "adminbook.php";</script>';
}
elseif ($res['BOOK_STATUS'] == "UNDER PROCESSING"){
    echo '<script>alert("Unable to return, booking has not yet been approved")</script>';
    echo '<script> window.location.href = "adminbook.php";</script>';
}
else{
    
    $sql4="UPDATE cars set AVAILABLE='Y' where CAR_ID=$res[CAR_ID]";
    $query2=mysqli_query($con,$sql4);
    $sql5="UPDATE booking set BOOK_STATUS='RETURNED', RETURN_DATE = SYSDATE() where BOOK_ID=$res2[BOOK_ID]";
    $query=mysqli_query($con,$sql5);
    echo '<script>alert("Car returned successfully")</script>';
    echo '<script> window.location.href = "adminbook.php";</script>';
}  



?>