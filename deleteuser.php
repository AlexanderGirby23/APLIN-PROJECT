<?php
// require_once('adminnav.php');
require_once('connection.php');
$email=$_GET['id'];
$sql2 = "SELECT * from users where email = '$email'";
$sql_r = mysqli_fetch_assoc(mysqli_query($con, $sql2));

print_r($sql_r);
if (isset($_GET['delete'])) {
    switch ($_GET['delete']) {
        case '1':
$sql="UPDATE users set deleted = current_timestamp() where EMAIL='$email'";
$result=mysqli_query($con,$sql);



echo '<script>alert("User has been deleted.")</script>';
            break;
        
        default:
            # code...
            break;
    }
    echo '<script> window.location.href = "adminusers.php";</script>';
}




?>
<div class="container mt-5">
<h1>Delete user?</h1>
<p>User <?= $sql_r['FNAME'] ?> <?= $sql_r['LNAME'] ?> is about to be deleted.</p>
<p>This cannot be undone!</p>
<a href="deleteuser.php?id=<?= $email ?>&delete=1" class="btn btn-danger">Delete user</a>    
<a href="deleteuser.php?id=<?= $email ?>&delete=0" class="btn btn-danger">Cancel</a>    

</div>
