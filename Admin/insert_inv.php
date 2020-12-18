<html>
<head>
<title> Insert in Inventory Table </title>
<style>
    .error {color: #ff0000;}
    body{
        font-size: 25px;
    }
    input{
        height : 27px;
    }
</style>
</head>
<body onload="form.reset();">

<?php
    $nameerr = $iderr = $exerr = $quaerr = $costerr = "";
    $Iname = $sto_id  = $quan = $cost = $expiry = "";
    

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (empty($_POST["sto_id"])) {
            $iderr = "ID is required";
        } else {
            $sto_id = test_input($_POST["sto_id"]);
        }

        if (empty($_POST["Iname"])) {
            $nameerr = "Item name is required";
        } else {
            $Iname = test_input($_POST["Iname"]);
        }

        if (empty(date('d-m-Y', strtotime($_POST["expiry"])))) {
            $exerr = "Expiry is required";
        } else {
            $expiry = date('d-m-Y', strtotime($_POST["expiry"]));
        }

        if (empty($_POST["quantity"])) {
            $quaerr = "Quantity is required"; 
        } else {
            $quan = test_input($_POST["quantity"]);
        }
        
        if (empty($_POST["cost"])) {
            $costerr = "Cost is required"; 
        } else {
            $cost = test_input($_POST["cost"]);
        }

    }

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<h2> Inventory data insertion </h2>
<p><spam class = "error">* required field</spam></p>
<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >

    Stock ID:_____________<input type="integer" name = "sto_id" value = "<?php echo $sto_id;?>">
    <spam class="error">* <?php echo $iderr;?></spam>
    <br><br>

    Item Name:___________<input type="text" name = "Iname" value = "<?php echo $Iname;?> ">
    <spam class="error">* <?php echo $nameerr;?></spam>
    <br><br>

    Epiry date:___________<input type = "date" name = "expiry" value = "<?php echo date('d-m-Y');?> ">
    <spam class="error">* <?php echo $exerr;?></spam>
    <br><br>

    Quantity(kg):_________<input type = "integer" name = "quantity" value = "<?php echo $quan;?>">
    <spam class="error">* <?php echo $quaerr;?></spam>
    <br><br>

    Cost:________________<input type = "integer" name = "cost" value = "<?php echo $cost;?> ">
    <spam class="error">* <?php echo $costerr;?></spam>
    <br><br>

    <input type = "submit" name = "submit" value = "Submit">
</form>


<?php   
    

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        echo "<h2> Your Input </h2>";
    echo $sto_id."<br>";
    echo $Iname."<br>".$expiry."<br>".$quan."<br>".$cost."<br>";

    $conn = pg_connect("host=localhost port=5432 dbname=DBMS_Project user=postgres password=new_password");  
    if (!$conn) {  
        echo "An error occurred.\n";  
        exit;  
    } 

    $str = "insert into inventory values('$sto_id','$Iname','$expiry','$quan','$cost')";

    $result = pg_query($conn, $str);

    echo $result;
    }

?>

</body>
</html>