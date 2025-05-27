
<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- <title>CAR RENTAL</title>
    <script type="text/javascript">
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
    </script>
    <script type="text/javascript">
        function preventBack() {
            window.history.forward(); 
        }
          
        setTimeout("preventBack()", 0);
          
        window.onunload = function () { null };
    </script> -->
    <style> 
        .navbar{
    width: 1200px;
    height: 75px;
    margin: auto;
    display: flex;
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
    /* float: left; */
    height: 70px;

}

ul{
    float: left;
    display: flex;
    justify-content: center;
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

.adminbtn{
    width: 150px;
    height: 40px;
    background: #ff7200;
    border:none;
    
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    color:#fff;
    transition: 0.4s ease;

}
.adminbtn a{
    text-decoration: none;
    color: black;
}

    </style>
</head>



<?php
// added navigation

?>
        <div class="navbar">
        <h2 class="logo">CaRs</h2>
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="aboutus2.html">ABOUT</a></li>
                    <li><a href="#">SERVICES</a></li>
                    
                    <li><a href="contactus2.html">CONTACT</a></li>
                  <!-- <li> <button class="adminbtn"><a href="adminlogin.php">ADMIN LOGIN</a></button></li> -->
                </ul>
            
          
        </div>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>

</html>
