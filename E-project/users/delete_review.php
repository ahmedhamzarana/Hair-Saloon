<?php
include('config.php');
$stylistid=$_POST['stylistid'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $review_id = (int)$_POST['review_id'];

    $delete_query = "DELETE FROM reviews WHERE id = $review_id";
    if (mysqli_query($db, $delete_query)) {
        echo "<script>alert('Review deleted successfully');</script>";
    } else {
        echo "<script>alert('Failed to delete review. Please try again.');</script>";
    }

    echo "<script>window.location.href='stylistabout.php?id=$stylistid';</script>";
}
?>
