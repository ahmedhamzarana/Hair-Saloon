<?php 

include('../users/config.php');
include('header.php')

?>

<div class="container-fluid">
    <div class="row">
    <div class="col-sm-12 col-xl-12 mt-5">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Time Slots</h6>
                            <form method="post">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Start Time</label>
                                    <input type="time" class="form-control" name="start" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                   
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">End Time</label>
                                    <input type="time" class="form-control" name="end" id="exampleInputPassword1">
                                </div>
                              
                                <button type="submit" class="btn btn-primary" name="addtime">Add Time</button>
                            </form>
                        </div>
                    </div>
    </div>
</div>

<?php 
if(isset($_POST['addtime'])){

$start=$_POST['start'];
$end=$_POST['end'];

$query="INSERT INTO timeslot (start,end) values ('$start','$end')";
$exe=mysqli_query($db,$query);

    if($exe){


                    echo "<script>alert('Time Slot added successfully')</script>";
                    echo "<script>window.location.href='timeslot.php'</script>";
    }

}
?>

    


<?php 

include('footer.php')
?>