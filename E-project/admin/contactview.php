<?php
include('header.php');
include('../users/config.php');
?>

<div class="col-sm-12 col-xl-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Contact</h6>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select = "SELECT * FROM contact ORDER BY id DESC";
                $stmt = $db->prepare($select);

                $stmt->execute();
                $result = $stmt->get_result(); 

                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <th scope="row"><?php echo htmlspecialchars($row['id']); ?></th>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                        <td><?php echo htmlspecialchars($row['message']); ?></td>
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
