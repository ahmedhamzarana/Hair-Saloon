<?php

include('../users/config.php');

$search = $_GET['search'];

if ($_GET['url'] == '/hair_saloon/admin/viewusers.php') {
    $query1 = "SELECT * FROM users WHERE role = '0' AND name LIKE '%$search%'";
    $exe1 = mysqli_query($db, $query1);

    $row = mysqli_fetch_all($exe1, MYSQLI_ASSOC);

    echo json_encode($row);
} else if ($_GET['url'] == "/hair_saloon/admin/show_stylists.php") {
    $query2 = "SELECT * FROM stylists 
               JOIN users ON stylists.user_id = users.id 
               WHERE users.role = '1' AND users.name LIKE '%$search%'";

    $exe2 = mysqli_query($db, $query2);

    $row2 = mysqli_fetch_all($exe2, MYSQLI_ASSOC);

    echo json_encode($row2);
} else if ($_GET['url'] == "/hair_saloon/admin/services.php") {
    $query3 = "SELECT * FROM services WHERE servicesname LIKE '%$search%'";

    $exe3 = mysqli_query($db, $query3);

    $row3 = mysqli_fetch_all($exe3, MYSQLI_ASSOC);

    echo json_encode($row3);
} else if ($_GET['url'] == "/hair_saloon/admin/showinventory.php") {
    $query4 = "SELECT * FROM inventory WHERE item_name LIKE '%$search%'";

    $exe4 = mysqli_query($db, $query4);

    $row4 = mysqli_fetch_all($exe4, MYSQLI_ASSOC);

    echo json_encode($row4);
} else if ($_GET['url'] == "/hair_saloon/admin/viewappoint.php") {
    $query5 = "SELECT 
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
    WHERE 
        client_users.name LIKE '%$search%' 
        OR stylist_users.name LIKE '%$search%'";

    $exe5 = mysqli_query($db, $query5);

    $row5 = mysqli_fetch_all($exe5, MYSQLI_ASSOC);

    echo json_encode($row5);
} else if ($_GET['url'] == "/hair_saloon/admin/checkappoint.php") {
    $query6 = "SELECT 
    confirmappoint.*, 
    client_users.name AS client_name, 
    stylist_users.name AS stylist_name, 
    services.servicesname,
    stylist_slots.slot_date,
    stylist_slots.start_time,
    stylist_slots.end_time
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
    client_users.name LIKE '%$search%' OR 
    stylist_users.name LIKE '%$search%';
";

    $exe6 = mysqli_query($db, $query6);

    $row6 = mysqli_fetch_all($exe6, MYSQLI_ASSOC);

    echo json_encode($row6);
} else if ($_GET['url'] == "/hair_saloon/admin/show_stylists.php") {
    $query7 = "SELECT 
    confirmappoint.*, 
    client_users.name AS client_name, 
    stylist_users.name AS stylist_name, 
    services.servicesname,
    services.price,
    stylist_slots.slot_date,
    stylist_slots.start_time,
    stylist_slots.end_time
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
    client_users.name LIKE '%$search%' OR 
    stylist_users.name LIKE '%$search%';

";

    $exe7 = mysqli_query($db, $query7);

    $row7 = mysqli_fetch_all($exe7, MYSQLI_ASSOC);

    echo json_encode($row7);
} else if ($_GET['url'] == "/hair_saloon/admin/stylisttask.php") {
    $query = "
SELECT 
    stylists.id, 
    stylists.experience, 
    stylists.qualification, 
    users.name, 
    users.email,
    (
        SELECT COUNT(confirmappoint.id)
        FROM confirmappoint
        WHERE confirmappoint.stylist_id = stylists.id 
        AND confirmappoint.status = 1 
        AND confirmappoint.updated_at >= NOW() - INTERVAL 5 DAY
    ) AS completed_appointments
FROM 
    stylists 
INNER JOIN 
    users 
ON 
    stylists.user_id = users.id
WHERE 
    users.name LIKE '%$search%' 
    OR users.email LIKE '%$search%' 
    OR stylists.qualification LIKE '%$search%'
ORDER BY 
    completed_appointments DESC";

    $result = mysqli_query($db, $query);

    // Fetch data and send as JSON
    $stylists = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $stylist_id = $row['id'];
        $services_query = "
        SELECT 
            services.servicesname 
        FROM 
            stylist_services 
        INNER JOIN 
            services 
        ON 
            stylist_services.service_id = services.id 
        WHERE 
            stylist_services.stylist_id = $stylist_id";

        $services_result = mysqli_query($db, $services_query);
        $services = [];
        while ($service_row = mysqli_fetch_assoc($services_result)) {
            $services[] = $service_row['servicesname'];
        }
        $row['services'] = implode(', ', $services);
        $stylists[] = $row;
    }
    echo "<pre>";
    print_r($stylists);
    echo "</pre>";
    echo json_encode($stylists);
}
