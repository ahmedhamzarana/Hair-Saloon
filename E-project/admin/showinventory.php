<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include('../users/config.php');
include('header.php');

$sql = "SELECT * FROM inventory WHERE quantity < min_quantity";
$exe = mysqli_query($db, $sql);

$lowStockItems = [];

if (mysqli_num_rows($exe) > 0) {
    while ($row2 = mysqli_fetch_assoc($exe)) {
        $lowStockItems[] = $row2['item_name'];
        echo "<div class='alert alert-primary text-center mt-3 mb-3'>{$row2['item_name']} ({$row2['quantity']}) - Low Stock Alert!</div>";
    }

    $body = "Alert: The following items have low stock:\n\n";
    $body .= implode("\n", $lowStockItems);
}
?>

<div class="col-sm-12 col-xl-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Inventory</h6>
        <a href="inventory.php"><button class="btn btn-success btn-sm m-2" style="float: right;">Add New</button></a>
        <button type="button" class="btn btn-warning btn-sm m-2" name="btnmail" style="float: right;" data-bs-toggle="modal" data-bs-target="#exampleModalmail">
            Send Mail
        </button>
        
        <div class="modal fade" id="exampleModalmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelmail">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="sendmail.php" method="post">
                        <div class="modal-body">
                            <select name="supplier" id="supplier" class="form-control" required>
                                <option selected disabled>Select Supplier</option>
                                <?php
                                $sql = "SELECT DISTINCT supplier FROM inventory";
                                $result = mysqli_query($db, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <option value="<?php echo $row['supplier'] ?>"><?php echo $row['supplier'] ?></option>
                                <?php } ?>
                            </select>
                            <div id="item_name" name="item_name" class="mt-3"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send Mail</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Item Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Min Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Action</th>
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
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['id'] ?>">
                                Add Quantity
                            </button>
                            <div class="modal fade" id="exampleModal<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel<?php echo $row['id'] ?>">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="post">
                                            <div class="modal-body">
                                                <input type="number" name="quantity" class="form-control" min="1" required>
                                                <input type="hidden" name="itemid" value="<?php echo $row['id'] ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="btnsubmit">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $("#supplier").on('change', function(e) {
            e.preventDefault();

            var supplier = $("#supplier").val();

            $.ajax({
                url: 'suppliers.php',
                type: 'GET',
                data: {
                    supplier: supplier
                },
                dataType: 'json',
                success: function(response) {
                    $("#item_name").empty();

                    if (response.length > 0) {
                        $.each(response, function(key, value) {
                            var quantity = parseFloat(value.quantity);
                            var minQuantity = parseFloat(value.min_quantity);
                            var check = quantity < minQuantity ? "checked" : "";

                            var output = `
                                <div class="mt-3">
                                    <label>
                                        <input type="checkbox" name="items[${key}]" value="${value.item_name}" ${check}>
                                        ${value.item_name} (Available: ${value.quantity})
                                        <input type="number" name="quantity[${key}]" value="10" min="1">
                                    </label>
                                </div>
                            `;
                            $("#item_name").append(output);
                        });
                    } else {
                        var output = `<p>No Low Quantity Stock Available</p>`;
                        $("#item_name").append(output);
                    }
                }
            });
        });
    });
</script>

<?php
if (isset($_POST['btnsubmit'])) {
    $quantity = $_POST['quantity'];
    $id = $_POST['itemid'];

    $query = "UPDATE inventory SET quantity = quantity + ? WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ii', $quantity, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Update Quantity Successfully')</script>";
        echo "<script>window.location.href='showinventory.php'</script>";
    } else {
        echo "<script>alert('Error updating quantity')</script>";
    }

    $stmt->close();
}
?>

<?php
include('footer.php');
?>
