<?php
session_start();
require '../users/config.php';
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$slot_id = $_POST['slot_id'];
$stylist_id = $_POST['stylist_id'];

// Query to delete slot
$delete_query = "DELETE FROM stylist_slots WHERE id = $slot_id AND stylist_id = $stylist_id";
mysqli_query($db, $delete_query);

echo json_encode(['success' => true]);
