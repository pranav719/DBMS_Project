<!DOCTYPE html>
<html>
<head>
<title>Table with database</title>
<style>
table {
border-collapse: collapse;
width: 100%;
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
<body>
<table>
<tr>
<th>Stock_Id</th>
<th>ITEM_name</th>
<th>Expiry_Date</th>
<th>Quantity</th>
<th>Cost</th>
</tr>
<?php
$conn = pg_connect("host=localhost port=5432 dbname=DBMS_Project user=postgres password=new_password"); 
// Check connection

$sql = "SELECT *  FROM inventory";
$result = pg_query($sql);

// output data of each row
while ($row = pg_fetch_row($result)) {  
  echo "<tr><td>" . $row[0]. "</td><td>" . $row[1] . "</td><td>"
. $row[2]. "</td><td>".$row[3] . "</td><td>" . $row[4] . "</td></tr>";
}  
echo "</table>";

?>
</table>
</body>
</html>
 