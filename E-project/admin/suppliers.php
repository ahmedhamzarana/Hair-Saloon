<?php

require '../users/config.php';

$supplier = $_GET['supplier'];

$sql = "SELECT * FROM inventory WHERE supplier = '$supplier'";

$result = mysqli_query($db, $sql);

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($data);
