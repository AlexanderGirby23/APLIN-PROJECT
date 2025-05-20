<?php
if(isset($_POST['addsupplier']) ){
    require_once('connection.php');

    $sparepart_name=mysqli_real_escape_string($con,$_POST['sparepart_name']);
    $description=mysqli_real_escape_string($con,$_POST['description']);
    $price=mysqli_real_escape_string($con,$_POST['price']);
    $stock=mysqli_real_escape_string($con,$_POST['stock']);
    $supplier_id=mysqli_real_escape_string($con,$_POST['supplier_id']);
    $query="INSERT INTO master_spareparts(sparepart_name,description,price,stock,supplier_id) values('$sparepart_name','$description','$price','$stock','$supplier_id')";
    $res=mysqli_query($con,$query);
    if($res){
        echo '<script>alert("New Spareparts Added Successfully!!")</script>';
        echo '<script> window.location.href = "adminsparepart.php";</script>';                }
}
else{
    $em="unknown error occured";
    header("Location: addsparepart.php?error=$em");
}

?>
