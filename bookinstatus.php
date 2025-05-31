<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKING STATUS</title>
</head>
<body>
<style>

*{
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
}

body{
    background: url("images/carbg2.jpg");
    background-position: center;
   
}
.box{
    position:center;    
    /* top: 50%;
    left: 50%; */
    padding: 20px;
    box-sizing: border-box;

    display: flex;
    align-content: center;
    justify-content: center;
    gap: 1rem;
    /* width: 700px;
    height: 250px; */
    /* margin-top: 100px;
    margin-left: 350px; */
  
    
}


.box .content{
    border-radius: 4px;
    box-shadow: 0 5px 15px rgba(0,0,0,.5);
    background: linear-gradient(to top, rgba(255, 251, 251, 1)70%,rgba(250, 246, 246, 1)90%);
    width: 50%;
    margin-left: 5px;
    font-size: larger;
    border-radius: 10px;
    padding: 15px;
}

.box .button{
    width: 240px;
    height: 40px;
    background: #ff7200;
    border:none;
    margin-top: 30px;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    color:#fff;
    transition: 0.4s ease;
}
.boxdetails{
    display: flex;
    gap: 1rem;
    justify-content: space-between;
}
.utton{
    width: 200px;
    height: 40px;
   
    background: #ff7200;
    border:none;
    font-size: 18px;
    border-radius: 5px;
    cursor: pointer;
    color:#fff;
    transition: 0.4s ease;
    margin-top: 10px;
    margin-left: 10px;
}
.utton a{
    text-decoration: none;
    color: white;
    font-weight: bold;
}

ul{
    /* float: left; */
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 1rem;
}

ul li{
    list-style: none;
    /* margin-left: 200px;
    margin-top: -130px; */
    font-size: 35px;

}
.name{
    font-weight: bold;
}

</style>



<?php
    require_once('connection.php');
    session_start();
    $email = $_SESSION['email'];

    $sql="select * from booking where EMAIL='$email' order by BOOK_ID DESC LIMIT 1";
    $name = mysqli_query($con,$sql);
    $rows=mysqli_fetch_assoc($name);
    if($rows==null){
        echo '<script>alert("No cars booked.")</script>';
        echo '<script> window.history.back();</script>';
    }
    else{
    $sql2="select * from users where EMAIL='$email'";
    $name2 = mysqli_query($con,$sql2);
    $rows2=mysqli_fetch_assoc($name2);
    $car_id=$rows['CAR_ID'];
    $sql3="select * from cars where CAR_ID='$car_id'";
    $name3 = mysqli_query($con,$sql3);
    $rows3=mysqli_fetch_assoc($name3);





?>
<div class="" style="flex-direction:column; display:flex">
           <ul><li> <button  class="utton"><a href="cardetails.php">Go to Home</a></button></li>
            <li class="name"><?php echo $rows2['FNAME']." ".$rows2['LNAME']?> Booking Details</li>



</ul>
    <div class="box">
         <div class="content" style="display:flex">
             <img src="images/<?php echo $rows3['CAR_IMG']?>" class="card-img-top" alt="<?php echo $rows3['CAR_IMG']?>" style="max-height: 200px;">
             <div class="" style="justify-content: space-between; flex-direction:column; display:flex">
                <div class="boxdetails">
                    <div class="boxtext">
                        <h4 style="font-weight:normal">Car Name</h4>
                        <h2><?php echo $rows3['CAR_NAME']?></h2>
                    </div>
                    <div class="boxtext">
                        <h4 style="font-weight:normal">Duration</h4>
                        <h2><?php echo $rows['DURATION']?></h2>
                    </div>
                </div>
                <div class="boxdetails">
                    <div class="boxtext">
                        <h2><?php echo ($rows['BOOK_STATUS']) ?></h2>
                    </div>
                </div>
             <!-- <h1>CAR NAME : <?php echo $rows3['CAR_NAME']?></h1><br>
             <h1>NO OF DAYS : <?php echo $rows['DURATION']?></h1><br>
             <h1>BOOKING STATUS : <?php echo $rows['BOOK_STATUS']?></h1><br> -->
             </div>
             
         </div>
     </div>



</div>
<?php }
?>
    
</body>
</html>