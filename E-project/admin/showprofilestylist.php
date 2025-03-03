<?php

include('../users/config.php');
include('header.php');

$query = "SELECT * FROM stylists WHERE user_id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $_SESSION['i']); 
$stmt->execute();
$result = $stmt->get_result();
$row2 = $result->fetch_assoc();

?>

<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Update Form</h6>
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="experience" class="form-label">Experience</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($row2['experience']); ?>" name="experience" id="experience" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="qualification" class="form-label">Qualification</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($row2['qualification']); ?>" name="qualification" id="qualification">
                    </div>
                    <div class="mb-3">
                        <label for="salary" class="form-label">Salary</label>
                        <input type="number" class="form-control" name="salary" value="<?php echo htmlspecialchars($row2['salary']); ?>" id="salary" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="services" class="form-label">Services</label>
                        <br>
                        <?php
                        $query2 = "SELECT * FROM services";
                        $exe2 = mysqli_query($db, $query2);

                        $selected_services_query = "SELECT service_id FROM stylist_services WHERE stylist_id = ?";
                        $stmt_selected = $db->prepare($selected_services_query);
                        $stmt_selected->bind_param("i", $_SESSION['stylist_id']);
                        $stmt_selected->execute();
                        $selected_services_result = $stmt_selected->get_result();

                        $selected_services = [];
                        while ($selected_row = $selected_services_result->fetch_assoc()) {
                            $selected_services[] = $selected_row['service_id'];
                        }

                        while ($row = mysqli_fetch_assoc($exe2)) {
                            $isChecked = in_array($row['id'], $selected_services) ? 'checked' : '';
                        ?>
                            <input type="checkbox" value="<?php echo htmlspecialchars($row['id']); ?>" name="services[]" <?php echo $isChecked; ?>>
                            <label for=""><?php echo htmlspecialchars($row['servicesname']); ?></label><br>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Image</label>
                        <input type="file" class="form-control bg-dark" onchange="document.querySelector('#image').src=window.URL.createObjectURL(this.files[0])" name="img" id="img" aria-describedby="emailHelp">
                        <img src="stylist/<?php echo htmlspecialchars($row2['image']); ?>" id="image" width="150px" alt="">
                    </div>
                    <div class="mb-3">
                        <label for="img2" class="form-label">Portfolio</label>
                        <input type="file" class="form-control bg-dark" onchange="document.querySelector('#image2').src=window.URL.createObjectURL(this.files[0])" name="img2" id="img2" aria-describedby="emailHelp">
                        <img src="stylist/<?php echo htmlspecialchars($row2['portfolio']); ?>" id="image2" width="150px" alt="">
                    </div>
                    <button type="submit" class="btn btn-primary" name="btnsubmit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

if (isset($_POST['btnsubmit'])) {
    $experience = $_POST['experience'];
    $qualification = $_POST['qualification'];
    $salary = $_POST['salary'];
    $services = $_POST['services'];

    $img = $_FILES['img']['name'];
    $img2 = $_FILES['img2']['name'];

    if ($img == "") {
        $img = $row2['image'];
    } else {
        $tmpimg = $_FILES['img']['tmp_name'];
        unlink('stylist/' . $row2['image']);
        move_uploaded_file($tmpimg, 'stylist/' . $img);
    }
    if ($img2 == "") {
        $img2 = $row2['portfolio'];
    } else {
        $tmpimg2 = $_FILES['img2']['tmp_name'];
        unlink('stylist/' . $row2['portfolio']);
        move_uploaded_file($tmpimg2, 'stylist/' . $img2);
    }

    $query = "UPDATE `stylists` SET 
              `experience` = ?, 
              `qualification` = ?, 
              `salary` = ?, 
              `image` = ?, 
              `portfolio` = ? 
              WHERE user_id = ?";
    $stmt_update = $db->prepare($query);
    $stmt_update->bind_param("ssissi", $experience, $qualification, $salary, $img, $img2, $_SESSION['i']); // Bind parameters

    if ($stmt_update->execute()) {
        $delete_query = "DELETE FROM stylist_services WHERE stylist_id = ?";
        $stmt_delete = $db->prepare($delete_query);
        $stmt_delete->bind_param("i", $_SESSION['stylist_id']);
        $stmt_delete->execute();

        $insert_query = "INSERT INTO stylist_services (stylist_id, service_id) VALUES (?, ?)";
        $stmt_insert = $db->prepare($insert_query);

        foreach ($services as $service_id) {
            $stmt_insert->bind_param("ii", $_SESSION['stylist_id'], $service_id);
            $stmt_insert->execute();
        }

        echo "<script>alert('Credentials Updated Successfully')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
}

?>

<?php
include('footer.php');
?>
