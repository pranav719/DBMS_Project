<html>
<head>
<title>Insert in Employee Table</title>
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
    $nameerr = $iderr = $deserr = $salerr = "";
    $name = $emp_id = $des = $salary = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (empty($_POST["emp_id"])) {
            $iderr = "ID is required";
        } else {
            $emp_id = test_input($_POST["emp_id"]);
        }

        if (empty($_POST["name"])) {
            $nameerr = "name is required";
        } else {
            $name = test_input($_POST["name"]);
        }

        if (empty($_POST["designation"])) {
            $deserr = "Designation is required";
        } else {
            $des = test_input($_POST["designation"]);
        }

        if (empty($_POST["salary"])) {
            $salerr = "Salary is required"; 
        } else {
            $salary = test_input($_POST["salary"]);
        }


    }

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<h2> Insert in Employee Table </h2>
<p><spam class = "error">* required field</spam></p>
<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >

    Employee ID: <input type="integer" name = "emp_id" value = "<?php echo $emp_id;?>" required>
    <spam class="error">* <?php echo $iderr;?></spam>
    <br><br>

    Name: <input type="text" name = "name" value = "<?php echo $name;?>" required>
    <spam class="error">* <?php echo $nameerr;?></spam>
    <br><br>

    Designation: <input type = "text" name = "designation" value = "<?php echo $des;?>" required>
    <spam class="error">* <?php echo $deserr;?></spam>
    <br><br>

    Salary: <input type = "integer" name = "salary" value = "<?php echo $salary;?>" required>
    <spam class="error">* <?php echo $salerr;?></spam>
    <br><br>

    <input type = "submit" name = "submit" value = "Submit">
</form>


<?php   
    

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        echo "<h2> Your Input </h2>";
    echo $emp_id."<br>";
    echo $name."<br>".$des."<br>".$salary."<br>";

    $conn = pg_connect("host=localhost port=5432 dbname=DBMS_Project user=postgres password=new_password");  
    if (!$conn) {  
        echo "An error occurred.\n";  
        exit;  
    } 

    $str = "insert into employee values('$emp_id','$name','$des','$salary')";

    $result = pg_query($conn, $str);

    echo $result;
    }

?>

</body>
</html>