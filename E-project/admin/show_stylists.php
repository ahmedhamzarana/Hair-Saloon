<?php

include('header.php');
include('../users/config.php');

?>

<div class="col-sm-12 col-xl-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Staff</h6>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Qualification</th>
                    <th scope="col">Experience</th>
                    <th scope="col">Services</th>
                    <th scope="col">Completed Tasks</th>
                    <th scope="col">Performance</th>
                </tr>
            </thead>
            <tbody id="show_stylists">
                <?php
                $select = "
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
                ORDER BY 
                    completed_appointments DESC";

                $stmt = $db->prepare($select);
                $stmt->execute();
                $result = $stmt->get_result();

                $grades = ["Excellent", "Great", "Good", "Fair", "Work Hard"];
                $grade_index = 0;

                while ($row = $result->fetch_assoc()) {
                    $stylist_id = $row['id'];

                    $select_services = "
                    SELECT 
                        services.servicesname 
                    FROM 
                        stylist_services 
                    INNER JOIN 
                        services 
                    ON 
                        stylist_services.service_id = services.id 
                    WHERE 
                        stylist_services.stylist_id = ?";

                    $stmt2 = $db->prepare($select_services);
                    $stmt2->bind_param("i", $stylist_id);
                    $stmt2->execute();
                    $result2 = $stmt2->get_result();

                    $services = [];
                    while ($row2 = $result2->fetch_assoc()) {
                        $services[] = $row2['servicesname'];
                    }
                    $service_list = implode(', ', $services);

                    $completed_appointments = $row['completed_appointments'] ?: 0;
                    $grade = $grades[$grade_index] ?? "Work Hard";

                    if ($completed_appointments > 0) {
                        $grade_index = min($grade_index + 1, count($grades) - 1);
                    }
                ?>
                    <tr>
                        <th scope="row"><?php echo htmlspecialchars($row['id']); ?></th>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['qualification']); ?></td>
                        <td><?php echo htmlspecialchars($row['experience']); ?></td>
                        <td><?php echo htmlspecialchars($service_list); ?></td>
                        <td><?php echo htmlspecialchars($completed_appointments); ?></td>
                        <td><?php echo htmlspecialchars($grade); ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include('footer.php');
?>
