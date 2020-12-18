<!DOCTYPE html>
<html>
<head>
<title>Delete from Inventory Table</title>
<style>
table {
border-collapse: collapse;
width: 60%;
color: #588c7e;
font-family: monospace;
font-size: 25px;
text-align: left;
}
th {
background-color: #588c7e;
color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}
</style>
</head>
<body onload="form.reset();"> 

<h2> Delete Inventory Itmes </h2>
<br><br><br>
<table>
<tr>
<th>Stock_id</th>
<th>Item name</th>
<th>Expiry Date</th>
<th>Quantity</th>
<th>Cost</th>
<th></th>
</tr>
<?php
$conn = pg_connect("host=localhost port=5432 dbname=DBMS_Project user=postgres password=new_password"); 
// Check connection

$sql = "SELECT *  FROM inventory";
$result = pg_query($sql);
$i=1;

$arr = [];


echo '<form method="post">';
// output data of each row
while ($row = pg_fetch_row($result)) {
    $arr[] = [
        '1' => $row[0],
        '2' => $row[1]
    ];
    
    $str = "b".$i;

    echo "<tr><td>" . $row[0]. "</td><td>" . $row[1] . "</td><td>"
    . $row[2]. "</td><td>".  $row[3] . "</td><td>" .$row[4] . "</td><td>"

    ."<input type='submit' name='$str' class='button' value='delete' />  </td></tr>";

    $i++;
}  
echo "</form>";
echo "</table>";


for($j=1;$j<$i;$j++){
    $str = "b".$j;
    if(array_key_exists("$str", $_POST)) { 
        button($str[1],$arr); 
    }
}    
function button($num,$arr) {
    $k = $arr[$num-1][1];
    $k2 = $arr[$num-1][2];
    $sql2 = "DELETE FROM inventory where stock_id='$k' and item_name='$k2'" ;
    $delete = pg_query($sql2); 
    header("Refresh:0");
}  

?>

</body>
</html>
 