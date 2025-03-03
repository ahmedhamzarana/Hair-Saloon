<?php

include('../users/config.php');
include('header.php');

?>
<style>
    img {
        margin-top: 10px;
        width: 150px;
    }
</style>

<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Registration Form</h6>
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Experience</label>
                        <input type="text" class="form-control" name="experience" id="exampleInputEmail1"
                            aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Qualification</label>
                        <input type="text" class="form-control" name="qualification" id="exampleInputPassword1">
                    </div>


                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Salary</label>
                        <input type="number" class="form-control" name="salary" id="exampleInputEmail1"
                            aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Services</label>
                        <br>
                        <?php

                        $query2 = "SELECT * FROM services";
                        $exe2 = mysqli_query($db, $query2);
                        while ($row = mysqli_fetch_assoc($exe2)) {

                        ?>
                            <input type="checkbox" value="<?php echo $row['id'] ?>" name="services[]">
                            <label for=""><?php echo $row['servicesname'] ?></label>
                        <?php

                        }


                        ?>
                        </select>


                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Image</label>
                        <input type="file" onchange="document.querySelector('#image').src=window.URL.createObjectURL(this.files[0])" class="form-control bg-dark" name="img" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                        <img src="" id="image" alt="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Portfolio</label>
                        <input type="file" onchange="document.querySelector('#image2').src=window.URL.createObjectURL(this.files[0])" class="form-control bg-dark" name="img2" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                        <img src="" id="image2" alt="">

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
    $tmpimg = $_FILES['img']['tmp_name'];
    move_uploaded_file($tmpimg, 'stylist/' . $img);

    $img2 = $_FILES['img2']['name'];
    $tmpimg2 = $_FILES['img2']['tmp_name'];
    move_uploaded_file($tmpimg2, 'stylist/' . $img2);
    $query = "INSERT INTO `stylists`(`user_id`, `experience`, `qualification`,`salary`,`image`,`portfolio`) VALUES ('{$_SESSION['i']}','$experience','$qualification','$salary','$img','$img2')";
    $exe = mysqli_query($db, $query);

    if ($exe) {
        $stylist_id = mysqli_insert_id($db);
        foreach ($services as $service) {

            $insert = "INSERT INTO stylist_services (stylist_id, service_id) VALUES ($stylist_id, $service)";
            $result = mysqli_query($db, $insert);
        }
        if ($result) {

            echo "<script>alert('Crediantial submitted')</script>";
            echo "<script>window.location.href='index.php'</script>";
        }
    }
}

?>


<?php
include('footer.php')
?>