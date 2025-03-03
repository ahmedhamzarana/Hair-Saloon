<?php

include 'header.php';
require '../users/config.php';
?>


<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
                <div>
                    <a href="showinventory.php"><button class="btn btn-success btn-sm" style="float: right;">Back</button></a>
                    <h3>Add Item In Inventory</h3>
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="slot_date" value="">



                    <div id="time-slots">

                        <div class="time-slot">

                            <div class="mb-3 mt-3">
                                <label for="exampleInputEmail1" class="form-label">Item Name</label>
                                <input type="text" class="form-control" value="" name="name" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">

                            </div>
                            <div class="mb-3 mt-3">
                                <label for="exampleInputEmail1" class="form-label">Item Quantity</label>
                                <input type="number" class="form-control" value="" name="quantity" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">

                            </div>
                            <div class="mb-3 mt-3">
                                <label for="exampleInputEmail1" class="form-label">Item Min Quantity</label>
                                <input type="number" class="form-control" value="" name="minquantity" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">

                            </div>
                            <div class="mb-3 mt-3">
                                <label for="exampleInputEmail1" class="form-label">Item Price/Unit</label>
                                <input type="number" class="form-control" value="" name="price" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">

                            </div>
                            <div class="mb-3 mt-3">
                                <label for="exampleInputEmail1" class="form-label">Item Supplier</label>
                                <input type="text" class="form-control" value="" name="supplier" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">

                            </div>

                            <button type="button" class="delete-slot btn btn-primary btn-sm" data-slot-id="">Delete</button>



                        </div>
                    </div>
             
                    <div id="new-time-slots">
                    </div>
                    <button type="button" class="btn btn-dark mt-4" id="add-slot">Add New Slot</button>


                    <button type="submit" class="btn btn-success mt-4" style="float: right;" name="btnsubmit">Add Item</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

if (isset($_POST['btnsubmit'])) {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $minquantity = $_POST['minquantity'];
    $price = $_POST['price'];
    $supplier = $_POST['supplier'];

    $sql = "INSERT INTO inventory(item_name, quantity, min_quantity, price, supplier) VALUES ('$name', '$quantity', '$minquantity', '$price', '$supplier')";

    $result = mysqli_query($db, $sql);

    if ($result) {
        echo "<script>alert('Item Added Successful')</script>";
        echo "<script>window.location.href='inventory.php'</script>";
    }
}

include 'footer.php';

?>