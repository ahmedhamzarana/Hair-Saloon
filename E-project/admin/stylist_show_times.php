<?php

include('header.php');
include('../users/config.php');

$stylist_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

?>

<div class="col-sm-12 col-xl-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Slots</h6>
        <a href="stylist_time.php"><button class="btn btn-success btn-sm" style="float: right;">Add New</button></a>
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">Slot Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($_SESSION['r'] == '3') {
                    $sql = "SELECT DISTINCT slot_date FROM stylist_slots WHERE stylist_id = ? ORDER BY slot_date DESC";
                } else {
                    $sql = "SELECT DISTINCT slot_date FROM stylist_slots WHERE stylist_id = ? ORDER BY slot_date DESC";
                    $stylist_id = $_SESSION['stylist_id']; 
                }

                $stmt = $db->prepare($sql);

                $stmt->bind_param('i', $stylist_id);

                $stmt->execute();

                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['slot_date']); ?></td>
                        <?php if ($_SESSION['r'] == "3") { ?>
                            <td>
                                <a href="edit_stylist_time.php?stylist_id=<?php echo urlencode($stylist_id); ?>&date=<?php echo urlencode($row['slot_date']); ?>">
                                    <button class="btn btn-warning">Edit</button>
                                </a>
                            </td>
                        <?php } else { ?>
                            <td>
                                <a href="edit_stylist_time.php?stylist_id=<?php echo urlencode($stylist_id); ?>&date=<?php echo urlencode($row['slot_date']); ?>">
                                    <button class="btn btn-warning">View</button>
                                </a>
                            </td>
                        <?php } ?>
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
