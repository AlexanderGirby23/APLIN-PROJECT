<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</head>

<?php 
    require_once('connection.php');

    $value = $_SESSION['email'];
    $_SESSION['email'] = $value;
    
    $sql="select * from users where EMAIL='$value'";
    $name = mysqli_query($con,$sql);
    $rows=mysqli_fetch_assoc($name);
    $sql2="select *from cars where AVAILABLE='Y'";
    $cars= mysqli_query($con,$sql2);
    
    // $row=mysqli_fetch_assoc($cars);
    
    
?>
<div class="container">
    <div class="row">
    <?php
        while($result= mysqli_fetch_array($cars))
        {
            // echo $result['CAR_ID'];
            // echo $result['AVAILABLE'];
            
    ?>    
    
        <div class="col">
            <form method="POST">
                <div class="card">
                    <img src="images/<?php echo $result['CAR_IMG']?>" class="card-img-top" alt="<?php echo $result['CAR_IMG']?>" style="max-height: 200px;">
                    <div class="card-body">
                            <p class="card-text">Fuel Type : <a><?php echo $result['FUEL_TYPE']?></a></p>
                            <p class="card-text">CAPACITY : <a><?php echo $result['CAPACITY']?></a> </p>
                            <p class="card-text">Rent Per Day : <a>₹<?php echo $result['PRICE']?>/-</a> </p>
                            <button type="submit"  name="booknow" class="utton" style="margin-top: 5px;"><a href="booking.php?id=<?php echo $res;?>">book</a></button>
                    </div>
                </div>
                <!-- <div class="box">
                    <div class="imgBx">
                        <img src="">
                    </div>
                    <div class="content">
                        <?php $res=$result['CAR_ID'];?>
                        <h1><?php echo $result['CAR_NAME']?></h1>
                        <h2>Fuel Type : <a><?php echo $result['FUEL_TYPE']?></a> </h2>
                        <h2>CAPACITY : <a><?php echo $result['CAPACITY']?></a> </h2>
                        <h2>Rent Per Day : <a>₹<?php echo $result['PRICE']?>/-</a></h2>
                        <button type="submit"  name="booknow" class="utton" style="margin-top: 5px;"><a href="booking.php?id=<?php echo $res;?>">book</a></button>
                    </div>
                </div> -->
            </form>
        </div>
    <?php
        }
    
    ?>

    </div>
</div>
<?php 
    require_once('connection.php');
    $value = $_SESSION['email'];
    
    $sql="select * from users where EMAIL='$value'";
    $name = mysqli_query($con,$sql);
    $rows=mysqli_fetch_assoc($name);
    
?>

    

 