<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR</title>
</head>
<body>

<style>
*{
    margin: 0;
    padding: 0;

}
.hai{
    width: 100%;
    background: linear-gradient(to top, rgba(0,0,0,0)50%, rgba(0,0,0,0)50%),url("../images/carbg2.jpg");
    background-position: center;
    background-size: cover;
    height: 109vh;
    animation: infiniteScrollBg 50s linear infinite;
}
.main{
    width: 100%;
    background: linear-gradient(to top, rgba(0,0,0,0)50%, rgba(0,0,0,0)50%);
    background-position: center;
    background-size: cover;
    height: 109vh;
    animation: infiniteScrollBg 50s linear infinite;
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

.content-table{
   border-collapse: collapse;
    
    font-size: 1em;
    /* min-width: 400px; */
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    box-shadow:0 0  20px rgba(0,0,0,0.15);
    margin: auto;
    margin-top: 25px;
    width: 900px;
    height: 300px;
}
.content-table thead tr{
    background-color: orange;
    color: white;
    text-align: left;
}

.content-table th,
.content-table td{
    padding: 12px 15px;


}

.content-table tbody tr{
    border-bottom: 1px solid #dddddd;
}
.content-table tbody tr:nth-of-type(even){
    background-color: #f3f3f3;

}
.content-table tbody tr:last-of-type{
    border-bottom: 2px solid orange;
}

.content-table thead .active-row{
    font-weight:  bold;
    color: orange;
}


.header{
    margin-top: -700px;
    margin-left: 650px;
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

.but a{
    text-decoration: none;
    color: black;
    
}
</style>
<?php
// require('adminnav.php');
require_once('connection.php');
require('protected.php');
$query="SELECT *from booking ORDER BY BOOK_ID DESC";    
$queryy=mysqli_query($con,$query);

// under processing
$queryup="SELECT *from booking where BOOK_STATUS = 'UNDER PROCESSING' ORDER BY BOOK_ID DESC";    
$queryyup=mysqli_query($con,$queryup);
$numup=mysqli_num_rows($queryyup);

// approved
$queryapp="SELECT *from booking where BOOK_STATUS = 'APPROVED' ORDER BY BOOK_ID DESC";    
$queryyapp=mysqli_query($con,$queryapp);
$numapp=mysqli_num_rows($queryyapp);

// returned (history)
$queryret="SELECT *from booking where BOOK_STATUS = 'RETURNED' ORDER BY BOOK_ID DESC";    
$queryyret=mysqli_query($con,$queryret);



?>
<script>
        window.onload = () =>{
        $("#navbar").load("./adminnav.php");
    }
</script>
    <div id="navbar">

    </div>
<div class="hai">

         </div>
        <div>
            <h1 class="header">BOOKINGS</h1>
            <h2 style="text-align: center;">Under Processing</h2>
            <div>
                <div>
                    <table class="content-table">
                <thead>
                    <tr>
                        <th>CAR ID</th>
                        <th>EMAIL</th>
                        <th>BOOK DATE</th>
                        <th>DURATION</th>
                        <th>PHONE NUMBER</th>
                        <th>RETURN DATE</th>
                        <th>BOOKING STATUS</th>
                        <th>TAKE METHOD</th>
                        <th>ADDRESS</th>
                        <th>APPROVE</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                
                while($res=mysqli_fetch_array($queryyup)){
                
                ?>
                <tr  class="active-row">
                    
                    <td><?php echo $res['CAR_ID'];?></php></td>
                    <td><?php echo $res['EMAIL'];?></php></td>
                    <td><?php echo $res['BOOK_DATE'];?></php></td>
                    <td><?php echo $res['DURATION'];?></php></td>
                    <td><?php echo $res['PHONE_NUMBER'];?></php></td>
                    <td><?php echo $res['RETURN_DATE'];?></php></td>
                    <td><?php echo $res['BOOK_STATUS'];?></php></td>
                    <td><?php echo $res['TAKE_METHOD'];?></php></td>
                    <td><?php echo $res['ADDRESS'];?></php></td>
                    <td><button type="submit"  class="but"  name="approve"><a href="approve.php?id=<?php echo $res['BOOK_ID']?>">APPROVE</a></button></td>
                </tr>
               <?php } ?>
                </tbody>
                </table>
                
                </div>
            </div>
            <br><br>
            <h2 style="text-align: center;">Approved</h2>
            <div>
                <div>
                <?php if ($numapp) { ?>
                    <table class="content-table">
                <thead>
                    <tr>
                        <th>CAR ID</th>
                        <th>EMAIL</th>
                        <th>BOOK DATE</th>
                        <th>DURATION</th>
                        <th>PHONE NUMBER</th>
                        <th>RETURN DATE</th>
                        <th>BOOKING STATUS</th>
                        <th>TAKE METHOD</th>
                        <th>ADDRESS</th>
                        <th>RETURN CAR</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                
                while($res=mysqli_fetch_array($queryyapp)){
                
                ?>
                <tr  class="active-row">
                    
                    <td><?php echo $res['CAR_ID'];?></php></td>
                    <td><?php echo $res['EMAIL'];?></php></td>
                    <td><?php echo $res['BOOK_DATE'];?></php></td>
                    <td><?php echo $res['DURATION'];?></php></td>
                    <td><?php echo $res['PHONE_NUMBER'];?></php></td>
                    <td><?php echo $res['RETURN_DATE'];?></php></td>
                    <td><?php echo $res['BOOK_STATUS'];?></php></td>
                    <td><?php echo $res['TAKE_METHOD'];?></php></td>
                    <td><?php echo $res['ADDRESS'];?></php></td>
                    <td><button type="submit" class="but" name="approve" disabled=
                    <?= $res['BOOK_STATUS'] == "RETURNED" ? true :false ?>
                    ><a href="adminreturn.php?id=<?php echo $res['CAR_ID']?>&bookid=<?php echo $res['BOOK_ID']?>">
                        <?= $res['BOOK_STATUS'] == "RETURNED" ? "RETURNED" : "SET RETURNED" ?></a></button></td>
                </tr>
               <?php }?>
                </tbody>
                </table>
                <?php }  else { echo "<h2 style='text-align: center'>None here!</h2>'"; }?>
                </div>
            </div>
            <br><br>
            <h2 style="text-align: center;">Returned</h2>
            <div>
                <div>
                    <table class="content-table">
                <thead>
                    <tr>
                        <th>CAR ID</th>
                        <th>EMAIL</th>
                        <th>BOOK DATE</th>
                        <th>DURATION</th>
                        <th>PHONE NUMBER</th>
                        <th>RETURN DATE</th>
                        <th>BOOKING STATUS</th>
                        <th>TAKE METHOD</th>
                        <th>ADDRESS</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                
                while($res=mysqli_fetch_array($queryyret)){
                
                ?>
                <tr  class="active-row">
                    
                    <td><?php echo $res['CAR_ID'];?></php></td>
                    <td><?php echo $res['EMAIL'];?></php></td>
                    <td><?php echo $res['BOOK_DATE'];?></php></td>
                    <td><?php echo $res['DURATION'];?></php></td>
                    <td><?php echo $res['PHONE_NUMBER'];?></php></td>
                    <td><?php echo $res['RETURN_DATE'];?></php></td>
                    <td><?php echo $res['BOOK_STATUS'];?></php></td>
                    <td><?php echo $res['TAKE_METHOD'];?></php></td>
                    <td><?php echo $res['ADDRESS'];?></php></td>
                </tr>
               <?php } ?>
                </tbody>
                </table>
                
                </div>
            </div>
            <br><br>
            <!-- <div>
                <div>
                    <table class="content-table">
                <thead>
                    <tr>
                        <th>CAR ID</th>
                        <th>EMAIL</th>
                        <th>BOOK DATE</th>
                        <th>DURATION</th>
                        <th>PHONE NUMBER</th>
                        <th>RETURN DATE</th>
                        <th>BOOKING STATUS</th>
                        <th>TAKE METHOD</th>
                        <th>ADDRESS</th>
                        <th>APPROVE</th>
                        <th>CAR RETURNED</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                
                while($res=mysqli_fetch_array($queryy)){
                
                ?>
                <tr  class="active-row">
                    
                    <td><?php echo $res['CAR_ID'];?></php></td>
                    <td><?php echo $res['EMAIL'];?></php></td>
                    <td><?php echo $res['BOOK_DATE'];?></php></td>
                    <td><?php echo $res['DURATION'];?></php></td>
                    <td><?php echo $res['PHONE_NUMBER'];?></php></td>
                    <td><?php echo $res['RETURN_DATE'];?></php></td>
                    <td><?php echo $res['BOOK_STATUS'];?></php></td>
                    <td><?php echo $res['TAKE_METHOD'];?></php></td>
                    <td><?php echo $res['ADDRESS'];?></php></td>
                    <td><button type="submit"  class="but"  name="approve"><a href="approve.php?id=<?php echo $res['BOOK_ID']?>">APPROVE</a></button></td>
                    <td><button type="submit" class="but" name="approve" disabled=
                    <?= $res['BOOK_STATUS'] == "RETURNED" ? true :false ?>
                    ><a href="adminreturn.php?id=<?php echo $res['CAR_ID']?>&bookid=<?php echo $res['BOOK_ID']?>">
                        <?= $res['BOOK_STATUS'] == "RETURNED" ? "RETURNED" : "SET RETURNED" ?></a></button></td>
                </tr>
               <?php } ?>
                </tbody>
                </table>
                
                </div>
            </div> -->
        </div>
</body>
</html>