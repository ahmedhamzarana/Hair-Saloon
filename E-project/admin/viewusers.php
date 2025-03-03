<?php

include('header.php');
include('../users/config.php');

?>

<div class="col-sm-12 col-xl-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Users</h6>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                </tr>
            </thead>
            <tbody id="users_table">
                <?php
                $query = "SELECT * FROM users WHERE role = ?";
                $stmt = $db->prepare($query);

                if ($stmt) {
                    $role = '0'; 
                    $stmt->bind_param("s", $role);

                    $stmt->execute();

                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($row['id']); ?></th>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                        </tr>
                <?php
                    }

                    $stmt->close();
                } else {
                    echo "<tr><td colspan='4'>Failed to prepare the query.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php

include('footer.php');

?>
