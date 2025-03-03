<?php

include 'header.php';
require '../users/config.php';
$stylist_date = $_GET['date'];
$stylist_id = $_GET['stylist_id'];
if ($_SESSION['r'] == "3") {

    $select = "SELECT * FROM stylist_slots WHERE stylist_id = $stylist_id AND slot_date = '$stylist_date'";
} else {
    $select = "SELECT * FROM stylist_slots WHERE stylist_id = $stylist_id AND slot_date = '$stylist_date'";
}
$exe = mysqli_query($db, $select);

?>


<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
                <div>
                    <h6 class="mb-4">Time Edit</h6>
                    <a href="stylist_show_times.php"><button class="btn btn-success btn-sm" style="float: right;">Back</button></a>
                    <h3>Edit Time Slots for <?php echo date('d M Y', strtotime($stylist_date)); ?></h3>
                </div>
                <form method="post" action="update_stylist_slots.php" enctype="multipart/form-data">
                    <input type="hidden" name="slot_date" value="<?php echo $stylist_date; ?>">
                    <input type="hidden" name="stylist_id" value="<?php echo $stylist_id ?>">



                    <div id="time-slots">
                        <?php
                        if (mysqli_num_rows($exe) > 0) {
                            while ($row = mysqli_fetch_assoc($exe)) {
                        ?>
                                <div class="time-slot">
                                    <input type="hidden" name="slot_ids[]" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="stylist_id" id="stylist_id" value="<?php echo $stylist_id ?>">

                                    <div class="mb-3 mt-3">
                                        <label for="exampleInputEmail1" class="form-label">Start Time</label>
                                        <input type="time" class="form-control" value="<?php echo $row['start_time'] ?>" <?php if ($row['status'] == 1) {
                                                                                                                                echo "readonly";
                                                                                                                            } else {
                                                                                                                                echo "";
                                                                                                                            } ?> name="start_times[]" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">

                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">End Time</label>
                                        <input type="time" <?php if ($row['status'] == 1) {
                                                                echo "readonly";
                                                            } else {
                                                                echo "";
                                                            } ?> class="form-control" value="<?php echo $row['end_time'] ?>" name="end_times[]" id="exampleInputPassword1">
                                        <hr>
                                    </div>
                                    <?php if ($row['status'] == 0) {
                                        if ($_SESSION['r'] == "3") {

                                    ?>

                                            <button type="button" class="delete-slot btn btn-primary btn-sm" data-slot-id="<?php echo $row['id']; ?>">Delete</button>
                                        <?php


                                        }
                                    } else {
                                        ?>
                                        <p class="text-primary">Its Booked First You Have To Cancel The Appointment</p>
                                    <?php
                                    }
                                    ?>
                                </div>
                        <?php
                            }
                        } else {
                            echo "No slots found for this date.";
                        }
                        ?>
                    </div>
                    <!-- Add New Time Slots -->
                    <div id="new-time-slots">
                    </div>

                    <?php
                    if ($_SESSION['r'] == "3") {

                    ?>
                        <button type="submit" class="btn btn-success mt-4" style="float: right;" name="btnsubmit">Update Slots</button>
                    <?php
                    } ?>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Delete slot functionality
        $('.delete-slot').click(function() {
            const slotId = $(this).data('slot-id');
            const stylist_id = $('#stylist_id').val(); // Get stylist_id

            $.ajax({
                type: 'POST',
                url: 'delete_stylist_slot.php',
                data: {
                    slot_id: slotId,
                    stylist_id: stylist_id
                },
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        alert('Slot deleted successfully!');
                        $(this).closest('.time-slot').remove(); // Remove the slot
                    } else {
                        alert('Error deleting slot: ' + (data.error || 'Unknown error'));
                    }
                }.bind(this), // Bind this to retain context
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error: ' + textStatus);
                }
            });
        });

        // Add new time slot functionality
        $('#add-slot').click(function() {
            const newSlotContainer = $('#new-time-slots');
            const newSlotHTML = `
                <div class="new-time-slot mt-3">
                    <div class="mb-3">
                        <label for="newStartTime" class="form-label">Start Time</label>
                        <input type="time" class="form-control" required name="new_start_times[]" id="newStartTime" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="newEndTime" class="form-label">End Time</label>
                        <input type="time" class="form-control" required name="new_end_times[]" id="newEndTime">
                    </div>
                    <button type="button" class="remove-slot btn btn-warning btn-sm">Remove</button>
                </div>
            `;
            newSlotContainer.append(newSlotHTML);
        });

        // Remove new slot functionality
        $(document).on('click', '.remove-slot', function() {
            $(this).closest('.new-time-slot').remove();
        });
    });
</script>

<?php

include 'footer.php';

?>