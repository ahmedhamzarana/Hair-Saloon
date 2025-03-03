
<?php 
$id=$_GET['id'];
$stylist_id=$_GET['stylist_id'];
$client_id=$_GET['client_id'];
$service_id=$_GET['service_id'];
$time_id=$_GET['time_id'];


include('../users/config.php');

$query="DELETE FROM appointment where id=$id;";

$query.="INSERT INTO `cancelappoint`(`client_id`, `stylist_id`, `service_id`, `time_id`) VALUES ('$client_id','$stylist_id','$service_id','$time_id')";


$exe=mysqli_multi_query($db,$query);


echo "<script>alert('Delete successfully')</script>";
echo "<script>window.location.href='viewappoint.php'</script>";

?>