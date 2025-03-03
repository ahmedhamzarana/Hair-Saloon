<?php

include('header.php');
if (!isset($_SESSION['i'])) {
    echo "<script>alert('Please Login First')</script>";
    echo "<script>window.location.href='signin.php'</script>";
 
}
$query = "SELECT * FROM stylists join services on stylists.services = services.id where stylists.id = {$_GET['id']}";
$exe = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($exe);

$currentdate = date('Y-m-d');

// Use a single equals sign for comparison and ensure the date format is correct
// $query5 = "DELETE FROM stylist_slots WHERE slot_date < '$currentdate'";
// $exe5 = mysqli_query($db, $query5);
// echo $query5;

?>

<div class="container-fluid">
    <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a href="index.html" class="">
                        <h3 class="text-primary">Elegance Saloon</h3>
                    </a>
                    <h3>Appointment Form</h3>
                </div>
                <form method="post">
                    <input type="hidden" value="<?php echo $_GET['id'] ?>" id="stylist_id">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingText" name="name" value="<?php echo $_SESSION['n'] ?>" readonly placeholder="jhondoe">
                        <label for="floatingText">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" name="email" value="<?php echo $_SESSION['e'] ?>" readonly placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating mb-4">
                        <select name="services" id="services" class="form-control">
                            <option selected disabled>Select Service</option>
                            <?php
                            $query2 = "SELECT services.id,services.servicesname FROM stylist_services INNER JOIN stylists ON stylist_services.stylist_id = stylists.id INNER JOIN services ON stylist_services.service_id = services.id WHERE stylist_services.stylist_id = {$_GET['id']}";
                            $exe2 = mysqli_query($db, $query2);
                            while ($row2 = mysqli_fetch_assoc($exe2)) {
                            ?>
                                <option value="<?php echo $row2['id'] ?>"><?php echo $row2['servicesname'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-floating mb-4">


                        <select name="price"  class="form-control" id="price">
                            <option selected disabled>First Select Service</option>
                        </select>

                        <label for="time">Price</label>

                    </div>



                    <div class="form-floating mb-4">


                        <select name="time" class="form-control" id="stylist_date">
                            <?php
                            $select = "SELECT DISTINCT slot_date FROM stylist_slots WHERE slot_date > '$currentdate' and stylist_id = {$_GET['id']}";

                            $result = mysqli_query($db, $select);
                            if (mysqli_num_rows($result) > 0) {
                            ?>
                                <option selected disabled>Select Date</option>
                                <?php
                                while ($row2 = mysqli_fetch_assoc($result)) {
                                ?>
                                    <option value="<?php echo $row2['slot_date'] ?>"><?php echo $row2['slot_date'] ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option selected disabled>No Slots Are Available</option>
                            <?php
                            }
                            ?>



                        </select>
                        <label for="time">Choose Date</label>

                    </div>

                    <div class="form-floating mb-4">


                        <select name="time_id" class="form-control" id="stylist_time">
                            <option selected disabled>First Select Date</option>
                        </select>

                        <label for="time">Select Time</label>

                    </div>


                    <button type="submit" name="btnregister" class="btn btn-primary py-3 w-100 mb-4">Register</button>
                    <p class="text-center mb-0">Already have an Account? <a href="">Sign In</a></p>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $("#stylist_date").on('change', function() {
            var stylist_id = $("#stylist_id").val();
            var stylist_date = $("#stylist_date").val();
            $.ajax({
                url: 'fetch_stylist_time.php',
                type: 'GET',
                data: {
                    stylist_id: stylist_id,
                    stylist_date: stylist_date
                },
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    console.log(response.length);

                    $("#stylist_time").empty();
                    if (response.length > 0) {

                        $.each(response, function(key, value) {
                            var output =
                                `
                        <option value=${value.id}>${value.start_time + ' - ' + value.end_time}</option>
                        `
                            $("#stylist_time").append(output)
                        })

                    } else {


                        $("#stylist_time").append("<option selected disabled>No Time Available For This Date...</option>")
                    }

                }
            })
        })
        $('#services').on('change', function() {
            services = $('#services').val();
       
            $.ajax({
                url:'serviceprice.php',
                type:'GET',
                data:{
                    services:services

                },
                dataType:'json',
                success:function(result){
                    console.log(result.price);
                    console.log(result);
                    $('#price').empty()
                    output2=`<option selected readonly value="${result.price}">${result.price}</option>`
                    $('#price').append(output2)
                    
                }
            })
        })
    })
</script>

<?php

if (isset($_POST['btnregister'])) {

    $user_id = $_SESSION['i'];
    $stylist_id = $_GET['id'];
    $service_id = $_POST['services'];
    $time_id = $_POST['time_id'];
    $price = $_POST['price'];


    $query = "INSERT INTO `appointment`(`client_id`, `stylist_id`, `service_id`, `time_id`,`price`) VALUES ('$user_id','$stylist_id','$service_id','$time_id','$price');";
    $query .= "UPDATE stylist_slots SET status = 1 WHERE id = $time_id";
    $exe = mysqli_multi_query($db, $query);

    if ($exe) {

        echo "<script>alert('Appointment Booked Successfully. Wait for Receptionist Approved!')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
}


?>

<?php


include('footer.php');
?>