<?php

require '../users/config.php';
session_start();

$stylist_id = $_POST['stylist_id'];
$slot_date = $_POST['slot_date'];
$slot_ids = $_POST['slot_ids'];
$start_times = $_POST['start_times'];
$end_times = $_POST['end_times'];

foreach ($slot_ids as $index => $slot_id) {
    $start_time = $start_times[$index];
    $end_time = $end_times[$index];

    if (!empty($start_time) && !empty($end_time)) {
        $update_query = "UPDATE stylist_slots 
                         SET start_time = '$start_time', end_time = '$end_time' 
                         WHERE id = $slot_id AND stylist_id = $stylist_id";
        mysqli_query($db, $update_query);
    }
}

if (isset($_POST['new_start_times'])) {
    $new_start_times = $_POST['new_start_times'];
    $new_end_times = $_POST['new_end_times'];

    foreach ($new_start_times as $index => $start_time) {
        $end_time = $new_end_times[$index];

        if (!empty($start_time) && !empty($end_time)) {
            $insert_query = "INSERT INTO stylist_slots (stylist_id, slot_date, start_time, end_time, status)
                             VALUES ($stylist_id, '$slot_date', '$start_time', '$end_time', 0)";
            mysqli_query($db, $insert_query);
        }
    }
}

header("Location: stylist_show_times.php?id=$stylist_id");
