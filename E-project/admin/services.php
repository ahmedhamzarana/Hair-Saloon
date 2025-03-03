<?php 

include('../users/config.php');
include('header.php');

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xl-12 mt-5">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Services</h6>
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Services Names</label>
                        <input type="text" class="form-control" name="services" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Prices</label>
                        <input type="number" class="form-control" name="price" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="addservices">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
if(isset($_POST['addservices'])){
    $services = $_POST['services'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $tempimage = $_FILES['image']['tmp_name'];

    move_uploaded_file($tempimage, 'service/' . $image);

    $query = "INSERT INTO services (servicesname, price, image) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);

    $stmt->bind_param('sis', $services, $price, $image);

    if ($stmt->execute()) {
        echo "<script>alert('Service added successfully')</script>";
        echo "<script>window.location.href='services.php'</script>";
    } else {
        echo "<script>alert('Error adding service')</script>";
    }

    $stmt->close();
}
?>

<?php 

include('footer.php');

?>
