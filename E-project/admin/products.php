<?php

include('../users/config.php');
include('header.php')

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xl-12 mt-5">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Products</h6>
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Products Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                            aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Prices</label>
                        <input type="number" class="form-control" name="price" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Product Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="exampleInputEmail1"
                            aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Product Category</label>
                        <select name="category" class="form-control">
                            <?php
                            $select = "SELECT * from services";

                            $result = mysqli_query($db, $select);
                            if (mysqli_num_rows($result) > 0) {
                            ?>
                                <option selected disabled>Select Service</option>
                                <?php
                                while ($row2 = mysqli_fetch_assoc($result)) {
                                ?>
                                    <option value="<?php echo $row2['id'] ?>"><?php echo $row2['servicesname'] ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option selected disabled>No Service Available</option>
                            <?php
                            }
                            ?>



                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="exampleInputEmail1"
                            aria-describedby="emailHelp">

                    </div>


                    <button type="submit" class="btn btn-primary" name="addproduct">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['addproduct'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $image = $_FILES['image']['name'];
    $tempimage = $_FILES['image']['tmp_name'];
    move_uploaded_file($tempimage, 'products/' . $image);


    $query = "INSERT INTO products (name,price,quantity,category,image) values ('$name','$price','$quantity','$category','$image')";
    $exe = mysqli_query($db, $query);

    if ($exe) {


        echo "<script>alert('Product added successfully')</script>";
        echo "<script>window.location.href='products.php'</script>";
    }
}
?>




<?php

include('footer.php')
?>