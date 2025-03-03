<?php 

include('../users/config.php');
include('header.php');

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xl-12 mt-5">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Add Client</h6>
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="number" class="form-control" name="phone" id="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="image" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Select Role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="0">User</option>
                            <option value="1">Stylist</option>
                            <option value="2">Receptionist</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="addclient">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
if (isset($_POST['addclient'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = md5($_POST['password']);
    $image = $_FILES['image']['name'];
    $tempimage = $_FILES['image']['tmp_name'];

    move_uploaded_file($tempimage, 'service/' . $image);

    $query = "INSERT INTO users (name, phone, email, password, role, img) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ssssss", $name, $phone, $email, $password, $role, $image);

        if ($stmt->execute()) {
            echo "<script>alert('Client added successfully')</script>";
            echo "<script>window.location.href='show_stylists.php'</script>";
        } else {
            echo "<script>alert('Error adding client')</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Failed to prepare the statement.')</script>";
    }
}

include('footer.php');
?>
