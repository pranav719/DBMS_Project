<?php

$temp = "";
$uerr = $passerr = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

  $conn = pg_connect("host=localhost port=5432 dbname=DBMS_Project user=postgres password=new_password"); 
  // Check connection

  $sql = "select customer_id,password from customer";
  $result = pg_query($sql);

  $arr = [];
  while($row = pg_fetch_row($result)){
    $arr[] = [
      'username' => $row[0],
      'password' => $row[1]
    ];
  }

 

  for($i=0;$i<count($arr);$i++){
      if($arr[$i]['username'] == $_POST["name"]){
        if($arr[$i]['password'] != $_POST["password"]){
          $passerr = "<p>incorrect password</p>";
          break;
        }
        else{
          $a = $arr[$i]['username'];
          header("Location: Select_Cuisine.html?cust_id=$a");
          break;
        }
      }
      else{
        $uerr = "<p>Invalid Username</p>";
      }
  }

}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>َLogin | SignUp</title>
  </head>
  <body onload="form.reset();">

<form id="form" class="box" method="post">
  <h1>Login</h1>
  <input type="text" name="name" placeholder="Customer Id" required>
  <input type="password" name="password" placeholder="Password" required>
  <input type="submit" name="" value="Login">
  <h5 class="forgot">Don't have an account? <a href="SignUpCustomer.php">SignUp</a></h5>
  
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
.box input[type = "text"],.box input[type = "password"]{
  border:0;
  background: none;
  display: block;
  margin: 20px auto;
  text-align: center;
  border: 2px solid #0004ff;
  padding: 14px 10px;
  width: 250px;
  outline: none;
  color: white;
  border-radius: 24px;
  transition: 0.25s;
}
.box input[type = "text"]:focus,.box input[type = "password"]:focus{
  width: 300px;
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

.forgot {
  color: white;  
  margin: 5px auto;
}

.box input[type = "submit"]:hover{
  background: #2ecc71;
}

</style>

  </body>
</html>