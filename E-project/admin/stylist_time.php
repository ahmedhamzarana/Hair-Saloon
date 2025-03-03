<?php

include 'header.php';
require '../users/config.php';

?>


<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
                <div>
                    <h6 class="mb-4">Registration Form</h6>
                    <a href="stylist_show_times.php">
                
                    </a>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Stylists</label>
                        <select name="stylist" class="form-control bg-dark"><?php
                                                        $stylist = "SELECT stylists.id,users.name FROM stylists join users on stylists.user_id=users.id";
                                                        $exes = mysqli_query($db, $stylist);
                                                        while ($row = mysqli_fetch_assoc($exes)) { ?>
                                <option value="<?php echo $row['id']?>"><?php echo $row['name']?>
                                </option>
                            <?php
                                                        }
                            ?>

                        </select>

                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Start Date</label>
                        <input type="date" class="form-control" name="start_date" id="exampleInputEmail1"
                            aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">End Date</label>
                        <input type="date" class="form-control" name="end_date" id="exampleInputPassword1">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Start Time</label>
                        <input type="time" class="form-control" name="start_time" id="exampleInputEmail1"
                            aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">End Time</label>
                        <input type="time" class="form-control" name="end_time" id="exampleInputPassword1">
                    </div>


                    <button type="submit" class="btn btn-primary" name="btnsubmit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    // Fetch data from the form
    $start_date = $_POST['start_date'];
    $stylist = $_POST['stylist'];
    $end_date = $_POST['end_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Define salon opening and closing times
    $salon_open_time = "09:00:00"; // 9 AM
    $salon_close_time = "23:00:00"; // 11 PM

    // Validate time range
    if ($start_time < $salon_open_time || $end_time > $salon_close_time) {
        echo "Error: Time must be between 9:00 AM and 11:00 PM.";
    } elseif ($start_time >= $end_time) {
        echo "Error: Start time must be earlier than end time.";
    } else {
        // Check for overlapping dates
        $sql = "SELECT * FROM stylist_slots 
                WHERE stylist_id = '$stylist' 
                AND slot_date BETWEEN '$start_date' AND '$end_date'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            echo "Error: Selected dates overlap with existing availability. Please choose a different range.";
        } else {
            // Convert dates to DateTime objects for iteration
            $current_date = new DateTime($start_date);
            $end_date = new DateTime($end_date);

            // Iterate through each date
            while ($current_date <= $end_date) {
                $day_of_week = $current_date->format('N'); // 'N' gives day of week (1 = Monday, 7 = Sunday)

                // Skip Saturday (6) and Sunday (7)
                if ($day_of_week == 6 || $day_of_week == 7) {
                    $current_date->modify('+1 day');
                    continue;
                }

                $date = $current_date->format('Y-m-d'); // Format date as 'YYYY-MM-DD'

                // Convert times to DateTime objects for iteration
                $start = new DateTime($start_time);
                $end = new DateTime($end_time);

                // Generate hourly slots for the current date
                while ($start < $end) {
                    $slot_start = $start->format('H:i:s'); // Format time as 'HH:MM:SS'
                    $start->modify('+1 hour'); // Increment by 1 hour
                    $slot_end = $start->format('H:i:s'); // Format time as 'HH:MM:SS'

                    // Insert into the database
                    $sql = "INSERT INTO stylist_slots (stylist_id, slot_date, start_time, end_time, status) 
                            VALUES ('$stylist', '$date', '$slot_start', '$slot_end', 0)";

                    if (!$db->query($sql)) {
                        echo "Error: " . $sql . "<br>" . $db->error;
                    }
                }

                // Move to the next date
                $current_date->modify('+1 day');
            }

            echo "<script>alert('Availability slots have been set successfully, excluding weekends!')</script>";
            echo "<script>window.location.href='stylist_show_times.php?id=$stylist'</script>";
        }
    }

    $db->close();
}
?>


<?php

include 'footer.php';

?>