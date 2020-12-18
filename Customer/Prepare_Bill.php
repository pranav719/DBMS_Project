<?php
$conn = pg_connect("host=localhost port=5432 dbname=DBMS_Project user=postgres password=new_password"); 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    
   $arr = json_decode($_POST["data"]);
   $cust_id = $_POST["cust_id"];
   $id = pg_fetch_row(pg_query("select max(order_id) from order_ "))[0] + 1;

   $totalCost=0;
   foreach($arr as  $values){
       $a = $values->{"dishName"};
       $b = $values->{"quantity"};
       $totalCost += $values->{"cost"};
       $d = pg_query("insert into order_ values('$id','$a','$b')");
   }
}
$date = date("d-m-Y");
date_default_timezone_set("Asia/Kolkata");
$time = date("h:i:s");

$e = pg_query("insert into orders values('$cust_id','$id','$date','$time','$totalCost')");

echo json_encode($id);

?>
