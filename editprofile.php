<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Edit Profile</title>
   <link rel="stylesheet" href="css/regs.css" type="text/css">
     <style>
      body{
        /* background:  #fdcd3b;
        background-size: auto;
         background-position:unset; */
         /* background-repeat: ; */
    background: linear-gradient(to top, rgba(253, 205, 59,0.75)50%),url("./images/regs.jpg");
    background-size: cover;
    background-position:left;
      }
      input#psw, input#cpsw{
    width:100%;
    border:1px solid #ddd;
    border-radius: 3px;
    outline: 0;
    padding: 7px;
    background-color: #fff;
    box-shadow:inset 1px 1px 5px rgba(0,0,0,0.3);
    }
      #message {
      display:none;
      background: #f1f1f1;
      color: #000;
      position: relative;
      padding: 20px;
      
      width: 400px;
      margin-left:1000px;
      margin-top: -500px;
    }

    #message p {
      padding: 10px 35px;
      font-size: 18px;
    }

    /* Add a green text color and a checkmark when the requirements are right */
    .valid {
      color: green;
    }

    .valid:before {
      position: relative;
      left: -35px;
      content: "✔";
    }

    /* Add a red text color and an "x" icon when the requirements are wrong */
    .invalid {
      color: red;
    }

    .invalid:before {
      position: relative;
      left: -35px;
      content: "✖";
    }
    /* New element: Splitscreen */
    .splitscreen{
      display: flex;
      justify-content: space-between;
      gap: 1rem;
    }
    .formlabel{
      width: 100%;
    }

</style> 
</head>
<body>
    
<?php

    require_once('connection.php');
        session_start();

    $value = $_SESSION['email'];
    $_SESSION['email'] = $value;
    
    $sql="select * from users where EMAIL='$value'";
    $name = mysqli_query($con,$sql);
    $rows=mysqli_fetch_assoc($name);

if(isset($_POST['regs']))
{
    $fname=mysqli_real_escape_string($con,$_POST['fname']);
    $lname=mysqli_real_escape_string($con,$_POST['lname']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $dom=mysqli_real_escape_string($con,$_POST['dom']);
    $nik=mysqli_real_escape_string($con,$_POST['nik']);
    $ph=mysqli_real_escape_string($con,$_POST['ph']);
   
    $gender=mysqli_real_escape_string($con,$_POST['gender']);
    if(empty($fname)|| empty($lname)|| empty($email)|| empty($dom)|| empty($nik)|| empty($ph)|| empty($gender))
    {
        echo '<script>alert("Some fields are blank. Please fill in appropriately.")</script>';
    }
    else{
       $sql="UPDATE users 
        
        set FNAME = '$fname', 
        LNAME = '$lname',
        DOMICILE = '$dom',
        NIK = '$nik',
        PHONE_NUMBER = $ph,
        GENDER = '$gender'
        WHERE EMAIL = '$email'
        ";
        $result = mysqli_query($con,$sql);
        if($result){
            echo '<script>alert("Update successful!")</script>';
            echo '<script> window.location.href = "cardetails.php";</script>';       
           }
        else{
            echo '<script>alert("please check the connection")</script>';
        }
      }
}


?>




    <button id="back" onclick="window.history.back()"><a>HOME</a></button>
    <h1 id="fam">EDIT PROFILE</h1>
 <div class="main">
        
        <div class="register">
        
        <form id="register" action="editprofile.php" method="POST">    
          <div class="splitscreen">
              <div class="formlabel">
            <label>First Name</label>
            <br>
            <input type ="text" name="fname"
            class="name" title="Enter Your First Name" placeholder="e.g. John" 
            value="<?= $rows["FNAME"] ?? "" ?>"
            required>
            <br><br>
              </div>
              <div class="formlabel">

            <label>Last Name</label>
            <br>
            <input type ="text" name="lname"
            class="name" title="Enter Your Last Name" placeholder="e.g. Smith" 
            value="<?= $rows["LNAME"] ?? "" ?>"
            required>
            <br><br>
              </div>
          </div>
          <div class="splitscreen">
          <div class="formlabel">
            <label>Email</label>
            <br>
            <input type="email" name="email"
            class="name" 
            value="<?= $rows["EMAIL"] ?? "" ?>"
            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="ex: example@ex.com"placeholder="Enter Valid Email" required>
            <br><br>
          </div>
          <div class="formlabel">
            <label>Domicile Address</label>
            <br>
            <input type="text" name="dom"
            value="<?= $rows["DOMICILE"] ?? "" ?>"
            class="name" placeholder="Enter address" required>
            <br><br>
          </div>  
          </div>

          <div class="formlabel">
            <label>NIK</label>
            <br>
            <input type="text" name="nik"
            value="<?= $rows["NIK"] ?? "" ?>"
            class="name" placeholder="16 digits of NIK" minlength="16" maxlength="16" 
            onkeypress="return onlyNumberKey(event)" required>
            <br><br>
          </div>
          <div class="formlabel">
            <label>Phone Number</label>
            <br>
            <input type="tel" name="ph" maxlength="13" 
            value="<?= $rows["PHONE_NUMBER"] ?? "" ?>"
            onkeypress="return onlyNumberKey(event)"
            class="name" placeholder="Maximum of 13 digits" required>
            <br><br>
          </div>
            <label>Gender</label><br>
                  <input type="radio" id="input_enabled" name="gender" value="male" style="width:40px">
                    <label for="one">Male</label>
                    <br>
                    <input type="radio" id="input_disabled" name="gender" value="female" style="width:40px" />
                    <label for="two">Female</label>

            <br><br>
          <div class="formlabel">
<input type="submit" class="btnn"  value="EDIT PROFILE" name="regs" style="background-color: #ff7200;color: white">
          </div>
            
        
        
        </input>
            
        </form>
        </div> 
    </div>
    <div id="message">
  <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>
<script>
var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
}

  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>  
<script>
    function onlyNumberKey(evt) {
          
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        // ASCII Codes smaller than 32 are unprintable characters
        // ASCII Codes 48 to 57 represent decimal numbers, 0 to 9
        // Reference: https://www.ascii-code.com/
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>
</body>
</html>