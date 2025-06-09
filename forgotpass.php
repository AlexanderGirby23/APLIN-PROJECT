<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>REGISTRATION</title>
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
if(isset($_POST['regs']))
{
    $email=mysqli_real_escape_string($con,$_POST['email']);
    
    $pass=mysqli_real_escape_string($con,$_POST['pass']);
    $cpass=mysqli_real_escape_string($con,$_POST['cpass']);

    $Pass=md5($pass);
    $pass2 = $pass;
    if(empty($email)|| empty($pass))
    {
        echo '<script>alert("Some fields are blank. Please fill in appropriately.")</script>';
    }
    else{
        if($pass==$cpass){
        $sql2="SELECT * from users where EMAIL='$email'";
        $res=mysqli_query($con,$sql2);
        if(mysqli_num_rows($res)>0){
            $sql="update users 
            set PASSWORD = '$Pass'
            where EMAIL = '$email'
            and deleted is null";
            $result = mysqli_query($con,$sql);
            if($result){
                echo '<script>alert("Password successfully reset and changed!")</script>';
                echo '<script> window.location.href = "index.php";</script>';       
              }
            else{
                echo '<script>alert("please check the connection")</script>';
            }
        }
        else{
            echo '<script>alert("E-mail has not been registered. \nPlease choose a registered e-mail.")</script>';
            echo '<script> window.location.href = "forgotpass.php";</script>';
        }

        }
        else{
            echo '<script>alert("Passwords must match in order to reset.")</script>';
            echo '<script> window.location.href = "forgotpass.php";</script>';
        }
    }
}


?>




    <button id="back"><a href="index.php">HOME</a></button>
    <h1 id="fam">Forgot your password?</h1>
 <div class="main">
        
        <div class="register">
        <h2>Reset Password</h2>
        
        <form id="register" action="forgotpass.php" method="POST">    
          <div class="formlabel">
            <label>Email</label>
            <br>
            <input type="email" name="email"
            class="name" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="ex: example@ex.com"placeholder="Enter Valid Email" required>
            <br><br>
          </div>

          <div class="splitscreen">
            <div class="formlabel">
              <label>New Password</label>
              <br>
              <input type="password" name="pass"
              id="psw" placeholder="Enter Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
              <br><br>
            </div>
            <div class="formlabel">
              <label>Confirm Password</label>
              <br>
              <input type="password" name="cpass" 
              id="cpsw" placeholder="Re-enter the password" required>
              <br><br>
            </div>
          </div>

          <div class="formlabel">
<input type="submit" class="btnn"  value="RESET PASSWORD" name="regs" style="background-color: #ff7200;color: white">
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