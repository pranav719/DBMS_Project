
<?php


if($_SERVER["REQUEST_METHOD"] == "POST"){

  $conn = pg_connect("host=localhost port=5432 dbname=DBMS_project user=postgres password=Nucleus@123"); 
  // Check connection

  $sql = "select max(customer_id) from customer ";

  $a = pg_fetch_row(pg_query($sql))[0] + 1;
  $b = $_POST["name"];
  $c = $_POST["phone"];
  $d = $_POST["password"];

  $sql2 = pg_query("insert into customer values('$a','$b','$c','$d')");

  header("Location: Select_cuisine.php?cust_id=$a");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | SignUp</title>
</head>
<body onload="form.reset();">

    <form id="form" class="box" method="post" action="" >
        <h1>SignUp</h1>
        <input type="text" name="name" placeholder="Name" required>
       
        <input type="phone" id="phone" name="phone" maxlength="13" placeholder="Phone with country code" required> 
        
        <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
        title="Must contain at least one number, one uppercase, one lowercase letter and at least 8 or more characters"
        placeholder="Choose Password" required>
        <input type="password" placeholder="Confirm Password" name="cpassword" id="confirm_password" required>
        <input type="submit" name="sp" value="SignUp">
        <h5 class="forgot">Already have an account? <a href="login-customer.php">LogIn</a></h5>

    </form>

<style>
body{
  margin: 0;
  padding: 0;
  font-family: sans-serif;
  background-image: url("img5.jpg");
}
.box{
  width: 400px;
  padding: 60px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  background: black;
  text-align: center;
}
.box h1{
  color: white;
  text-transform: uppercase;
  font-weight: 500;
}
.box input[type = "text"],.box input[type = "password"],.box input[type = "email"],.box input[type ="phone"]
{
  border:0;
  background: none;
  display: block;
  margin: 20px auto;
  text-align: center;
  border: 2px solid #0004ff;
  padding: 14px 10px;
  width: 300px;
  outline: none;
  color: white;
  border-radius: 24px;
  transition: 0.25s;
}
.box input[type = "text"]:focus,.box input[type = "password"]:focus,.box input[type = "email"]:focus,.box input[type ="phone"]:focus
{
  width: 350px;
  border-color: #eff300;
}
.box input[type = "submit"]{
  border:0;
  background: none;
  display: block;
  margin: 20px auto;
  text-align: center;
  border: 2px solid #00ff0d;
  padding: 14px 40px;
  outline: none;
  color: white;
  border-radius: 24px;
  transition: 0.25s;
  cursor: pointer;
}

.box input[type = "submit"]:hover{
  background: #2ecc71;
}


.forgot {
  color: white;  
}

</style>
<script>
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
</body>
</html>
