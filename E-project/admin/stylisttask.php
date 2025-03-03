<?php

include('header.php');
include('../users/config.php');

$alert_query = "
    SELECT 
        confirmappoint.*, 
        client_users.name AS client_name, 
        stylist_users.name AS stylist_name, 
        services.servicesname, services.price,
        stylist_slots.slot_date, stylist_slots.start_time, stylist_slots.end_time
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
        DATE(stylist_slots.slot_date) = CURDATE() + INTERVAL 1 DAY;
";

$alert_stmt = $db->prepare($alert_query);
$alert_stmt->execute();
$alert_result = $alert_stmt->get_result();

while ($alertrow = $alert_result->fetch_assoc()) {
    ?>
    <div class='alert alert-primary text-center mt-3 mb-3'>
        Your Appointment with <?php echo htmlspecialchars($alertrow['client_name']); ?> 
        is tomorrow, <?php echo htmlspecialchars($alertrow['slot_date']); ?>
    </div>
<?php
}

if ($_SESSION['r'] == '3') {
    $select_query = "
        SELECT 
            confirmappoint.*, 
            client_users.name AS client_name, 
            stylist_users.name AS stylist_name, 
            services.servicesname, services.price,
            stylist_slots.slot_date, stylist_slots.start_time, stylist_slots.end_time
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
    $select_query = "
        SELECT 
            confirmappoint.*, 
            client_users.name AS client_name, 
            stylist_users.name AS stylist_name, 
            services.servicesname, services.price,
            stylist_slots.slot_date, stylist_slots.start_time, stylist_slots.end_time
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
            confirmappoint.stylist_id = ?;
    ";
}

$select_stmt = $db->prepare($select_query);

if ($_SESSION['r'] != '3') {
    $select_stmt->bind_param("i", $_SESSION['stylist_id']);
}

$select_stmt->execute();
$result = $select_stmt->get_result();

?>

<div class="col-sm-12 col-xl-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Stylist Task</h6>
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
            <tbody id="stylisttask">
                <?php
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo htmlspecialchars($row['id']); ?></th>
                        <td><?php echo htmlspecialchars($row['client_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['stylist_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['servicesname']); ?></td>
                        <td><?php echo htmlspecialchars($row['price'] * 30 / 100); ?></td>
                        <td><?php echo htmlspecialchars($row['slot_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['start_time'] . ' - ' . $row['end_time']); ?></td>
                        <td>
                            <?php
                            if ($row['status'] == 0) {
                                if ($row['slot_date'] > date('Y-m-d')) {
                                    echo '<p>Waiting for the time</p>';
                                } else {
                                    echo '<button class="btn btn-primary">Pending</button>';
                                }
                            } else {
                                echo '<button class="btn btn-success" style="cursor: not-allowed;">Completed</button>';
                            }
                            ?>
                        </td>
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
    $id = $_POST['appoint'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $totalprice = $_POST['totalprice'] - $price;

    $inventory_query = "UPDATE inventory SET quantity = quantity - ? WHERE id = ?";
    $appointment_query = "UPDATE confirmappoint SET status = 1, price = ?, totalprice = ? WHERE id = ?";

    $stmt1 = $db->prepare($inventory_query);
    $stmt1->bind_param("ii", $quantity, $item_name);

    $stmt2 = $db->prepare($appointment_query);
    $stmt2->bind_param("dii", $price, $totalprice, $id);

    if ($stmt1->execute() && $stmt2->execute()) {
        echo "<script>alert('Completed')</script>";
        echo "<script>window.location.href='stylisttask.php'</script>";
    } else {
        echo "<script>alert('Error updating the appointment.')</script>";
    }
}

include('footer.php');
?>
