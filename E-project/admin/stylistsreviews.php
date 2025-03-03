<?php
include('header.php');
include('../users/config.php');
?>

<div class="col-sm-12 col-xl-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Reviews</h6>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Stylist Name</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Created Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $baseQuery = "
                    SELECT 
                        reviews.id,
                        reviews.rating,
                        reviews.comment,
                        reviews.created_at,
                        stylist_user.name AS stylist_name,
                        client_user.name AS client_name
                    FROM 
                        reviews
                    JOIN 
                        stylists ON reviews.stylist_id = stylists.id
                    JOIN 
                        users AS stylist_user ON stylists.user_id = stylist_user.id
                    JOIN 
                        users AS client_user ON reviews.user_id = client_user.id
                ";

                if ($_SESSION['r'] == '1') {
                    $baseQuery .= " WHERE reviews.stylist_id = ?";
                    $stmt = $db->prepare($baseQuery);
                    $stmt->bind_param('i', $_SESSION['stylist_id']); 
                } else {
                    $stmt = $db->prepare($baseQuery);
                }

                $stmt->execute();
                $result = $stmt->get_result(); 

                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $row['id']; ?></th>
                        <td><?php echo htmlspecialchars($row['stylist_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['client_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['rating']); ?> Stars</td>
                        <td><?php echo htmlspecialchars($row['comment']); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    </tr>
                <?php
                }
                $stmt->close(); 
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include('footer.php');
?>
