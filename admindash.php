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


.content-table{
   border-collapse: collapse;
    
    font-size: 0.9em;
  
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    box-shadow:0 0  20px rgba(0,0,0,0.15);
    margin:auto;
    margin-top: 25px;
    width: 1400px;
    height: fit-content;
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
    margin-top: 70px;
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
</style>

<?php
require_once('adminnav.php');
require_once('connection.php');
$query="select *from feedback";
$queryy=mysqli_query($con,$query);
$num=mysqli_num_rows($queryy);


?>

    <div class="hai">
        <div>
            <h1 class="header">FEEDBACKS</h1>
            <div>
                <div>
                    <table class="content-table">
                <thead>
                    <tr>
                        <th>FEEDBACK_ID</th> 
                        <th>EMAIL</th>
                        <th>COMMENT</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                
                
                while($res=mysqli_fetch_array($queryy)){
                
                
                ?>
                <tr  class="active-row">
                    <td><?php echo $res['FED_ID'];?></php></td>
                    <td><?php echo $res['EMAIL'];?></php></td>
                    <td><?php echo $res['COMMENT'];?></php></td>
                </tr>
               <?php } ?>
                </tbody>
                </table>
                </div>
            </div>
        </div>
     
</body>
</html>