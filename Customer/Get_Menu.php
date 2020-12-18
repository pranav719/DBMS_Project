<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

$conn = pg_connect("host=localhost port=5432 dbname=DBMS_Project user=postgres password=new_password");  


$data = array();
$cuisine = json_decode($_POST["data"]);
//$cuisine="North Indian";

$result1= pg_query($conn, "SELECT dish_name FROM menu where cuisine='$cuisine' group by dish_name");

$data1 = array();
$data2 = array();
$i=0;
while($row = pg_fetch_row($result1)) {
    $data1[$i] = $row[0];
    $i++;
    $a = $row[0];
    $result2 = pg_query($conn, "SELECT quantity FROM menu where dish_name='$a' and cuisine='$cuisine'");
    $j=0;
    while($row2 = pg_fetch_row($result2)){
        $data[$row[0]][$j] = $row2[0];
        $b=$row2[0];
        $cost = pg_fetch_row(pg_query("select cost from menu where dish_name='$a' and quantity='$b' and cuisine='$cuisine'"))[0];
        $str = 'cost_'.$row2[0];
        $data[$row[0]][$str] = $cost;
        $j++;
    }
    
}
$data['dishNames'] = $data1;

echo json_encode($data);
}

?>