<?php

include('config.php');
$services=$_GET['services'];

$query="SELECT * FROM services where id=$services";
$exe=mysqli_query($db,$query);

$row=mysqli_fetch_assoc($exe);
echo json_encode($row);

?>