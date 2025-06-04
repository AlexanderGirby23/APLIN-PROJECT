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

<body class="body">

<style>
*{
    margin: 0;
    padding: 0;

}

body{
    background: linear-gradient(to top, rgba(255, 255, 255, 0.750)50%),url("./images/carbg2.jpg");
    /* background: url("images/carbg2.jpg"); */
    background-position: center;
    background-size: cover;
}
/* .main{
   
    width: 100%;
     background: linear-gradient(to top, rgba(0,0,0,0)50%, rgba(0,0,0,0)50%);
    background-position: center;
    background-size: cover;
    height: 109vh; 
    animation: infiniteScrollBg 50s linear infinite;
} */
.navbar{
    width: 100%;
    height: 75px;
    margin: auto;
    display: block;
    align-items: center;
}

.icon{
    width:200px;
    float: left;
    height : 70px;
}

.logo{
    color: #ff7200;
    font-size: 35px;
    font-family: Arial;
    padding-left: 20px;
    float:left;
    padding-top: 10px;

}
.menu{
    width: 400px;
    float: left;
    height: 70px;

}

ul{
    float: left;
    display: flex;
    /* justify-content: center; */
    align-items: center;
}

ul li{
    list-style: none;
    margin-left: 62px;
    margin-top: 27px;
    font-size: 14px;

}

ul li a{
    text-decoration: none;
    color: black;
    font-family: Arial;
    font-weight: bold;
    transition: 0.4s ease-in-out;

}

ul li a:hover{
    color:orange;

}
.box{
    padding: 20px;
    box-sizing: border-box;
    background: #fff;
    border-radius: 4px;
    box-shadow: 0 5px 15px rgba(0,0,0,.5);
    background: linear-gradient(to top, rgba(255, 251, 251, 0.8)50%,rgba(250, 246, 246, 0.8)50%);
    display: flex;
    align-content: center;
    width: 600px;
    height: 200px;
    float:left;
}

.box .imgBx{
    width: 150px;
    flex:0 0 150px;
}

.box .imgBx img{
    max-width: 150%;
}

.box .content{
    padding-left: 100px;
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

.utton{
    width: 240px;
    height: 40px;
   
    background: #ff7200;
    border:none;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    color: #ffffff;
}
.utton a{
    cursor: pointer;
    color: #ffffff;
    text-decoration: none;
}



.de{
    /* float: left;
    clear: left; */
    display: block;
}


.de li a:hover{
    color:black;

}
.de .lis:hover{
    color: white;
}


.nn{
    width:100px;
    /* background: #ff7200; */
    border:none;
    height: 40px;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    color:white;
    transition: 0.4s ease;

}


.nn a{
    text-decoration: none;
    color: black;
    font-weight: bold;
    
}

.overview{
    text-align: center;

    margin-top: 40px;
}

.circle{
    border-radius:48%;
    width:65px;
}

.phello{
    width: 200px;
    margin-left: -50px;
    padding: 0px;
}

#stat{
    margin-left: -8px;
}




</style>


<?php 
    require_once('connection.php');
    require_once('protected.php');
        // session_start();

    $value = $_SESSION['email'];
    $_SESSION['email'] = $value;
    
    $sql="select * from users where EMAIL='$value'";
    $name = mysqli_query($con,$sql);
    $rows=mysqli_fetch_assoc($name);
    $sql2="select *from cars where AVAILABLE='Y'";
    $cars= mysqli_query($con,$sql2);
    
    // $row=mysqli_fetch_assoc($cars);
    
    
?>
</script>
<div class="cd">
    <div class="main">
        <div class="navbar">
            <h2 class="logo">CaRs</h2>
            <div class="menu">
               
                <ul>
                    <li><a href="#">HOME</a></li>
                    <li><a href="aboutus.html">ABOUT</a></li>
                    
                    <li><a href="contactus.html">CONTACT</a></li>
                    <li><a href="feedback/Feedbacks.php" title="Got anything to to say? Send feedback here">FEEDBACK</a></li>
                    <li><button class="nn" title="End your session and log out"><a href="logout.php">LOGOUT</a></button></li>
                    <li><img src="images/profile.png" class="circle" alt="Alps"></li>
                    <li><p class="phello">HELLO! &nbsp;<a id="pname"><?php echo $rows['FNAME']." ".$rows['LNAME']?></a></p></li>
                    <li><a id="stat" href="bookinstatus.php" title="See your bookings">BOOKING STATUS</a></li>
                    <li><a href="editprofile.php" title="Make changes to your profile">EDIT PROFILE</a></li>
                </ul>
            </div>
            
            
        </div>
    <h1 class="overview">OUR CARS OVERVIEW</h1>

    <div class="container">
        <div class="row" style="display: grid; grid-template-columns: repeat(4, 1fr);">
        <?php
            while($result= mysqli_fetch_array($cars))
            {
        ?>    
    
        <div class="col">
            <form method="POST">
                    <div class="card" style="height: 30rem">
                        <img src="images/<?php echo $result['CAR_IMG']?>" class="card-img-top" alt="<?php echo $result['CAR_IMG']?>" style="max-height: 200px;">
                        <div class="card-body" style="display:flex; justify-content:space-between; flex-direction:column">
                            <div class="">
                            <p class="card-text" title="Name of the car to rent">Car Name : <a><?php echo $result['CAR_NAME']?></a></p>
                            <p class="card-text" title="Fuel the car uses">Fuel Type : <a><?php echo $result['FUEL_TYPE']?></a></p>
                            <p class="card-text" title="This includes goods and seat capacity">Capacity : <a><?php echo $result['CAPACITY']?></a> </p>
                            <p class="card-text" title="Fee to charge per day">Rent Per Day : <a><?php echo $result['PRICE']?>/-</a> </p>
                            </div>
                            <div class="">
                            <a href="">
                            <button name="details" class="utton" style="margin-top: 5px;" title="Still in development. Do not click!">
                                Details
                            </button></a>
                            <a href="booking.php?id=<?php echo $result['CAR_ID'];?>">
                                <button name="booknow" class="utton" style="margin-top: 5px;" title="Book this rent now">
                                Book Rent
                            </button>
                            </a>                                
                            </div>


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
    // // $sql2="select *from cars where CAR_ID=1";
    // $cars= mysqli_query($con,"select *from cars where CAR_ID=1");
    
    // $row=mysqli_fetch_assoc($cars);
    
        
        
    
    
    ?>
    </div>
  </div>
</div>
    
    

 
    
     
</body>
</html>