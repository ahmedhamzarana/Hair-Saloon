
<?php

include('header.php');
include('../users/config.php');

?>

<div class="col-sm-12 col-xl-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Appointments</h6>
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
                    <th scope="col">Cancel</th>
                    <th scope="col">Confirm</th>
                </tr>
            </thead>
            <tbody id="viewappoint">
                <?php
                // Use a prepared statement
                $query = "
                    SELECT 
                        appointment.*, 
                        client_users.name AS client_name, 
                        stylist_users.name AS stylist_name, 
                        services.servicesname,
                        stylist_slots.slot_date, 
                        stylist_slots.start_time, 
                        stylist_slots.end_time
                    FROM 
                        appointment 
                    JOIN 
                        users AS client_users ON appointment.client_id = client_users.id 
                    JOIN 
                        stylists ON appointment.stylist_id = stylists.id 
                    JOIN 
                        users AS stylist_users ON stylists.user_id = stylist_users.id 
                    JOIN 
                        services ON appointment.service_id = services.id 
                    JOIN 
                        stylist_slots ON appointment.time_id = stylist_slots.id
                ";

                $stmt = $db->prepare($query);

                if ($stmt) {
                    // Execute the prepared statement
                    $stmt->execute();

                    // Get the result
                    $result = $stmt->get_result();

                    // Fetch data and display
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($row['id']); ?></th>
                            <td><?php echo htmlspecialchars($row['client_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['stylist_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['servicesname']); ?></td>
                            <td><?php echo htmlspecialchars($row['price']); ?></td>
                            <td><?php echo htmlspecialchars($row['slot_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['start_time'] . ' - ' . $row['end_time']); ?></td>
                            <td>
                                <a href="cancelappoint.php?time_id=<?php echo urlencode($row['time_id']); ?>&client_id=<?php echo urlencode($row['client_id']); ?>&service_id=<?php echo urlencode($row['service_id']); ?>&stylist_id=<?php echo urlencode($row['stylist_id']); ?>&id=<?php echo urlencode($row['id']); ?>">
                                    <button class="bg-danger btn-lg text-white"><i class="fa-solid fa-trash"></i></button>
                                </a>
                            </td>
                            <td>
                                <a href="confirmappoint.php?time_id=<?php echo urlencode($row['time_id']); ?>&client_id=<?php echo urlencode($row['client_id']); ?>&service_id=<?php echo urlencode($row['service_id']); ?>&stylist_id=<?php echo urlencode($row['stylist_id']); ?>&id=<?php echo urlencode($row['id']); ?>">
                                    <button class="bg-success btn-lg text-white"><i class="fa-solid fa-check"></i></button>
                                </a>
                            </td>
                        </tr>
                <?php
                    }

                    // Close the statement
                    $stmt->close();
                } else {
                    echo "<tr><td colspan='9'>Failed to prepare the query.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php

include('footer.php');

?>
