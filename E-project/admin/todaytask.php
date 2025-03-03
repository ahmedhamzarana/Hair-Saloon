<?php

include('header.php');
include('../users/config.php');

$alert = "SELECT 
    confirmappoint.*, 
    client_users.name AS client_name, 
    stylist_users.name AS stylist_name, 
    services.servicesname,services.price,
    stylist_slots.slot_date,stylist_slots.start_time,stylist_slots.end_time
FROM 
    confirmappoint 
JOIN 
    users AS client_users ON confirmappoint.client_id = client_users.id 
JOIN 
    stylists ON confirmappoint.stylist_id = stylists.id 
JOIN 
    users AS stylist_users ON stylists.user_id = stylist_users.id 
JOIN 
    services ON confirmappoint.service_id = services.id 
JOIN 
    stylist_slots ON confirmappoint.time_id = stylist_slots.id 
WHERE 
    DATE(stylist_slots.slot_date) = CURDATE() + INTERVAL 1 DAY;";

$alertexe = mysqli_query($db, $alert);

while ($alertrow = mysqli_fetch_assoc($alertexe)) {
?>
    <div class='alert alert-primary text-center mt-3 mb-3'>Your Appointment with
        <?php echo $alertrow['client_name'] ?> is tomorrow, <?php echo $alertrow['slot_date'] ?></div>
<?php
}


if ($_SESSION['r'] == '3') {
    $select = "SELECT 
    confirmappoint.*, 
    client_users.name AS client_name, 
    stylist_users.name AS stylist_name, 
    services.servicesname,services.price,
    stylist_slots.slot_date,stylist_slots.start_time,stylist_slots.end_time
FROM 
    confirmappoint 
JOIN 
    users AS client_users ON confirmappoint.client_id = client_users.id 
JOIN 
    stylists ON confirmappoint.stylist_id = stylists.id 
JOIN 
    users AS stylist_users ON stylists.user_id = stylist_users.id 
JOIN 
    services ON confirmappoint.service_id = services.id 
JOIN 
    stylist_slots ON confirmappoint.time_id = stylist_slots.id;
";
} else {

    $select = "SELECT 
    confirmappoint.*, 
    client_users.name AS client_name, 
    stylist_users.name AS stylist_name, 
    services.servicesname,services.price,
    stylist_slots.slot_date,stylist_slots.start_time,stylist_slots.end_time
FROM 
    confirmappoint 
JOIN 
    users AS client_users ON confirmappoint.client_id = client_users.id 
JOIN 
    stylists ON confirmappoint.stylist_id = stylists.id 
JOIN 
    users AS stylist_users ON stylists.user_id = stylist_users.id 
JOIN 
    services ON confirmappoint.service_id = services.id 
JOIN 
    stylist_slots ON confirmappoint.time_id = stylist_slots.id
 WHERE 
                        confirmappoint.stylist_id = {$_SESSION['stylist_id']} 
                        AND DATE(confirmappoint.created_at) = CURDATE() and confirmappoint.status=0;
";
}

$result = mysqli_query($db, $select);


?>


<div class="col-sm-12 col-xl-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Users</h6>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Client Name</th>
                    <th scope="col">Stylist Name</th>
                    <th scope="col">Service</th>
                    <th scope="col">Price</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Status</th>

                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {

                ?>
                    <tr>
                        <th scope="row"><?php echo $row['id'] ?></th>
                        <td><?php echo $row['client_name'] ?></td>
                        <td><?php echo $row['stylist_name'] ?></td>
                        <td><?php echo $row['servicesname'] ?></td>
                        <td><?php echo $row['price'] * 30 / 100 ?></td>
                        <td><?php echo $row['slot_date'] ?></td>
                        <td><?php echo $row['start_time'] . ' - ' . $row['end_time'] ?></td>

                        <?php
                        if ($_SESSION['r'] == '3') {

                            if ($row['status'] == 0) {

                                if ($row['slot_date'] > date('Y-m-d')) {
                        ?>
                                    <td>
                                        <p>Waiting for the time</p></a>

                                    <?php
                                } else {
                                    ?>
                                    <td><button type="button" class="btn btn-primary">
                                            Pending
                                        </button>

                                    <?php                            }
                                    ?>
                                <?php

                            } else {

                                ?>
                                    <td><button class="btn btn-success" style="cursor: not-allowed;">Completed</button>
                                    <?php
                                }

                                    ?>


                    </tr>
                    <?php
                        } else {

                            if ($row['status'] == 0) {

                                if ($row['slot_date'] > date('Y-m-d')) {
                    ?>
                            <td>
                                <p>Waiting for the time</p></a>

                            <?php
                                } else {
                            ?>
                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['id'] ?>">
                                    Pending
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
                                                    <input type="hidden" value="<?php echo $row['id']; ?> " name="appoint">
                                                    <input type="hidden" value="<?php echo $row['price'] * 30 / 100 ?>" name="price">
                                                    <input type="hidden" value="<?php echo $row['price'] ?>" name="totalprice">

                                                    <select name="item_name" class="form-control">

                                                        <?php
                                                        $sql = "SELECT * FROM inventory";
                                                        $exe = mysqli_query($db, $sql);
                                                        while ($row2 = mysqli_fetch_assoc($exe)) {
                                                        ?>
                                                            <option value="<?php echo $row2['id'] ?>"><?php echo $row2['item_name'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <input type="number" name="quantity" class="form-control mt-3" min="1" max="1">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="btnsubmit">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php                            }
                            ?>
                        <?php

                            } else {

                        ?>
                            <td><a href="stylisttask.php"><button class="btn btn-success" style="cursor: not-allowed;">Completed</button></a>
                            <?php
                            }

                            ?>


                            </tr>
                    <?php

                        }
                    }
                    ?>

            </tbody>
        </table>
    </div>
</div>


<?php
if (isset($_POST['btnsubmit'])) {

    $id = $_POST['appoint'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $totalprice = $_POST['totalprice'] - $price;


    $query = "update inventory set quantity = quantity - $quantity where id=$item_name;";


    $query .= "UPDATE confirmappoint set status =1, price=$price, totalprice=$totalprice where id=$id;";



    $exe = mysqli_multi_query($db, $query);


    echo "<script>alert('Completed')</script>";
    echo "<script>window.location.href='stylisttask.php'</script>";
}
?>








<?php

include('footer.php');

?>