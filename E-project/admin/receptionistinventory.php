<?php


include('../users/config.php');
include('header.php');

// Fetch items with low stock
$sql = "SELECT * FROM inventory WHERE quantity < min_quantity";
$exe = mysqli_query($db, $sql);

    if(mysqli_num_rows($exe)>0){

        while($row=mysqli_fetch_assoc($exe)){

            echo "<div class='alert alert-primary text-center mt-3 mb-3'>{$row['item_name']} ({$row['quantity']}) - Low Stock Alert!</div>";
        }
        
    }
?>

<div class="col-sm-12 col-xl-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Users</h6>
        <a href="inventory.php"><button class="btn btn-success btn-sm" style="float: right;">Add New</button></a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Item Name</th>
                    <th scope="col">Quanity</th>
                    <th scope="col">Min Quanity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Supplier</th>
   
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM inventory ORDER BY id DESC";
                $result = mysqli_query($db, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $row['item_name'] ?></td>
                        <td><?php echo $row['quantity'] ?></td>
                        <td><?php echo $row['min_quantity'] ?></td>
                        <td><?php echo $row['price'] ?></td>
                        <td><?php echo $row['supplier'] ?></td>
                                           </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>



<?php
if (isset($_POST['btnsubmit'])) {

    $quantity = $_POST['quantity'];
    $id = $_POST['itemid'];

    $query = "UPDATE inventory set quantity=quantity + $quantity where id=$id";
    $exe2 = mysqli_query($db, $query);

    echo "<script>alert('Update Quantity Successfuly')</script>";
    echo "<script>window.location.href='showinventory.php'</script>";
}
?>


<?php

include('footer.php');

?>