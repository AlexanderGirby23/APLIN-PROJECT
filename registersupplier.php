<?php
if(isset($_POST['addsupplier']) ){
    require_once('connection.php');

    $supplier_name=mysqli_real_escape_string($con,$_POST['supplier_name']);
    $contact_name=mysqli_real_escape_string($con,$_POST['contact_name']);
    $phone_number=mysqli_real_escape_string($con,$_POST['phone_number']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $address=mysqli_real_escape_string($con,$_POST['address']);
    $query="INSERT INTO suppliers(supplier_name,contact_name,phone_number,email,address) values('$supplier_name','$contact_name','$phone_number','$email','$address')";
    $res=mysqli_query($con,$query);
    if($res){
        echo '<script>alert("New Suppliers Added Successfully!!")</script>';
        echo '<script> window.location.href = "adminsupplier.php";</script>';                }
}
else{
    $em="unknown error occured";
    header("Location: addsupplier.php?error=$em");
}

?>
