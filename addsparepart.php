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
body{
    background-image: url("../images/regs.jpg");
    
    
    background-size: cover;
    background-position: center;
    /* margin-top: 0px; */
    
}
.main{
    width: 400px;
    margin: 100px auto 0px auto;
    margin-top: 30px;
}
.btnn{
    width: 240px;
    height: 40px;
    background: #ff7200;
    border:none;
    margin-top: 30px;
    margin-left: 40px;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    color:#fff;
    transition: 0.4s ease;
}

.btnn:hover{
    background: #fff;
    color:#ff7200;
}

.btnn a{
    text-decoration: none;
    color: black;
    font-weight: bold;
}

h2{
    text-align: center;
    padding: 20px;
    font-family: sans-serif;

}
.register{
    background-color: rgba(0,0,0,0.6);
    width: 100%;
    font-size: 18px;
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.3);
    box-shadow: 2px 2px 15px rgba(0,0,0,0.3);
    color: #fff;
    margin: auto;

}

form#register{
    margin: 40px;
    margin-top: 10px;

}

label{
    font-family: sans-serif;
    font-size: 18px;
    font-style: italic;
}

input#name{
    width:300px;
    border:1px solid #ddd;
    border-radius: 3px;
    outline: 0;
    padding: 7px;
    background-color: #fff;
    box-shadow:inset 1px 1px 5px rgba(0,0,0,0.3);
}


#back{
    width: 100px;
    height: 40px;
    background: #ff7200;
    border:none;
    margin-top: 10px;
    margin-left: 20px;
    font-size: 18px;
   

}


#back a{
    text-decoration: none;
    color: black;
    font-weight: bold;
}

#fam{
    color: #ff7200;
    /* font-family: 'Times New Roman'; */
    font-size: 50px;
    padding-left: 20px;
    margin-top:-10px;
    text-align: center;
    letter-spacing: 2px;
    display: inline;
    margin-left: 250px;
}

.reg{
    width: 100%;
}



</style>



<?php
    require_once('connection.php');
    $query="SELECT *from suppliers";    
    $queryy=mysqli_query($con,$query);
    $num=mysqli_num_rows($queryy);


?>



<button id="back"><a href="adminsparepart.php">HOME</a></button> 
    
 <div class="main">
        
        <div class="register">
        <h2>Enter Sparepart</h2>
        <form id="register"  action="registersparepart.php" method="POST">    
            <label>Sparepart Name : </label>
            <br>
            <input type ="text" name="sparepart_name"
            id="name" placeholder="Enter Sparepart Name" required>
            <br><br>

            <label>Description : </label>
            <br>
            <textarea name="description" id="name" style="width: 320px;"></textarea>
            <br><br>

            <label>Price : </label>
            <br>
            <input type ="number" name="price"
            id="name" placeholder="Enter Price" required>
            <br><br>

            <label>Stock : </label>
            <br>
            <input type ="number" name="stock"
            id="name" placeholder="Enter Stock" required>
            <br><br>

            <label>Address : </label>
            <br>
            <select name="supplier_id" id="supplier_id" style="width: 320px; height:30px">
                <?php
                while($res=mysqli_fetch_array($queryy)){
                ?>
                    <option value="<?= $res['supplier_id'] ?>"><?= $res['supplier_name'] ?></option>
                <?php } ?>
            </select>
            <br><br>

            <input type="submit" class="btnn"  value="ADD Sparepart" name="addsupplier">
            
        
        
        </input>
            
        </form>
        </div> 
    </div.main>
</body>
</html>