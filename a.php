<input type="text" name="Username"/>
<?php
$params = array($_POST['Username']);

$server = "ILLUSION2";
$options = array("Database"=>"Serenity_dev1", "UID"=>"Serenity_dev1", "PWD"=>"aHZw46MjapFLpeJr");
$conn = sqlsrv_connect($server, $options);
echo $sql = "SELECT * FROM SystemUser WHERE Username = ? ";
$stmt = sqlsrv_query($conn, $sql, $params);
if(sqlsrv_has_rows($stmt))
{
    echo "Welcome.";
}
else
{
    echo "Invalid password.";
}
?>