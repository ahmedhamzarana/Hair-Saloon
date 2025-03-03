<?php

include('header.php');
include('../users/config.php');

?>

<div class="col-sm-12 col-xl-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Stylists Time Slots</h6>
        <a href="stylist_time.php"><button class="btn btn-success btn-sm" style="float: right;">Add New</button></a>
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">Stylists Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT stylists.id, users.name FROM stylists JOIN users ON stylists.user_id = users.id";
                $stmt = $db->prepare($sql);

                $stmt->execute();

                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td>
                            <a href="stylist_show_times.php?id=<?php echo urlencode($row['id']); ?>">
                                <button class="btn btn-warning">View</button>
                            </a>
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

include('footer.php');

?>
