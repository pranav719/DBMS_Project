<?php

$temp = "";
$uerr = $passerr = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

  $conn = pg_connect("host=localhost port=5432 dbname=DBMS_Project user=postgres password=new_password"); 
  // Check connection

  $sql = "select manager_loginid,password from manager";
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
          header("Location: Adminpage.html");
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

<form id="form" class="box" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
  <h1>Login<?php echo $temp ?></h1>
  <input type="text" name="name" placeholder="Username" required>
  <spam class="error"> <?php echo $uerr;?></spam>
  <input type="password" name="password" placeholder="Password" required>
  <spam class="error"><?php echo $passerr;?></spam>
  <input type="submit" name="" value="Login">

  
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
p{
    color: #FFF;
}

</style>

  </body>
</html>