
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

include('../users/config.php');

$id = $_GET['id'];
$stylist_id = $_GET['stylist_id'];
$client_id = $_GET['client_id'];
$service_id = $_GET['service_id'];
$time_id = $_GET['time_id'];

$stylistname = "SELECT * FROM stylists JOIN users ON stylists.user_id = users.id WHERE stylists.id = $stylist_id";
$exe2 = mysqli_query($db, $stylistname);
$row = mysqli_fetch_assoc($exe2);


$client_name = "SELECT * FROM users WHERE id = $client_id";
$exe3 = mysqli_query($db, $client_name);
$row3 = mysqli_fetch_assoc($exe3);


include('email.php');
sendMail($row3['email'], "Confirmation Email", "Your appointment with {$row['name']} has been Booked successfuly, Please visit at your schedule time");




$query = "DELETE FROM appointment where id=$id;";

$query .= "INSERT INTO `confirmappoint`(`client_id`, `stylist_id`, `service_id`, `time_id`) VALUES ('$client_id','$stylist_id','$service_id','$time_id')";



$exe = mysqli_multi_query($db, $query);

echo "<script>alert('Booking successfully')</script>";
echo "<script>window.location.href='viewappoint.php'</script>";

?>