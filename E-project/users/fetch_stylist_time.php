<?php

require 'config.php';

$stylist_id = $_GET['stylist_id'];
$stylist_date = $_GET['stylist_date'];

$sql = "SELECT * FROM stylist_slots WHERE stylist_id = '$stylist_id' AND slot_date = '$stylist_date' AND status = 0";
$result = mysqli_query($db, $sql);

$row = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($row);
