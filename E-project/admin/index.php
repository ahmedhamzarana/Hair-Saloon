<?php

include('header.php');


$query1 = "SELECT * from stylists";
$exe1 = mysqli_query($db, $query1);

$query2 = "SELECT * from users where role='0'";
$exe2 = mysqli_query($db, $query2);

$query3 = "SELECT sum(totalprice) from confirmappoint where status=1";
$exe3 = mysqli_query($db, $query3);
$row = mysqli_fetch_assoc($exe3);

$query4 = "SELECT sum(price + totalprice) from confirmappoint where status=1";
$exe4 = mysqli_query($db, $query4);
$row2 = mysqli_fetch_assoc($exe4);

if ($_SESSION['r'] == '1') {
    if (isset($_SESSION['stylist_id'])) {


        $stylist_id = $_SESSION['stylist_id'];

        $query5 = "SELECT * FROM confirmappoint WHERE status=1 AND stylist_id=$stylist_id";
        $exe5 = mysqli_query($db, $query5);

        $query6 = "SELECT * FROM confirmappoint WHERE status=0 AND stylist_id=$stylist_id";
        $exe6 = mysqli_query($db, $query6);

        $query7 = "SELECT sum(price) AS total_commission FROM confirmappoint WHERE status=1 AND stylist_id=$stylist_id";
        $exe7 = mysqli_query($db, $query7);
        $row7 = mysqli_fetch_assoc($exe7);

        $query9 = "SELECT * FROM confirmappoint WHERE stylist_id=$stylist_id AND status=0 AND DATE(created_at) = CURDATE()";
        $exe9 = mysqli_query($db, $query9);
    } else {

        echo "<script>window.location.href='stylistregistration.php'</script>";
        exit();
    }
}

?>

<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <?php if ($_SESSION['r'] == '3' || $_SESSION['r'] == '2') { ?>
            <!-- Admin Dashboard Cards -->
            <div class="col-sm-6 col-xl-4">
                <div class="bg-secondary rounded shadow-lg d-flex align-items-center justify-content-between p-5">
                    <i class="fa fa-users fa-4x text-primary"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-2 text-white-50">Total Stylists</p>
                        <h6 class="mb-0 text-white"><?php echo mysqli_num_rows($exe1); ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-secondary rounded shadow-lg d-flex align-items-center justify-content-between p-5">
                    <i class="fa fa-user-friends fa-4x text-primary"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-2 text-white-50">Total Clients</p>
                        <h6 class="mb-0 text-white"><?php echo mysqli_num_rows($exe2); ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-secondary rounded shadow-lg d-flex align-items-center justify-content-between p-5">
                    <i class="fa fa-dollar-sign fa-4x text-primary"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-2 text-white-50">Total Revenue</p>
                        <h6 class="mb-0 text-white">Rs <?php echo $row['sum(totalprice)']; ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-secondary rounded shadow-lg d-flex align-items-center justify-content-between p-5">
                    <i class="fa fa-wallet fa-4x text-primary"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-2 text-white-50">Total Amount</p>
                        <h6 class="mb-0 text-white">Rs <?php echo $row2['sum(price + totalprice)']; ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-secondary rounded shadow-lg d-flex align-items-center justify-content-between p-5">
                    <i class="fa fa-users fa-4x text-primary"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-2 text-white-50">Total Vendors</p>

                        <h6 class="mb-0 text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">Show List</h6>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalLabel">Vendors Lists</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      
                                        <?php 
                                        $select = "SELECT DISTINCT supplier FROM inventory";
                                        $result = mysqli_query($db,$select);
                                        while($row = mysqli_fetch_assoc($result)){
                                           ?>
                                           <p><?php echo $row['supplier'] ?></p>
                                           <?php 
                                        }
                                        ?>
                                       
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } elseif ($_SESSION['r'] == '1') { ?>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-secondary rounded shadow-lg d-flex align-items-center justify-content-between p-5">
                    <i class="fa fa-check-circle fa-4x text-primary"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-2 text-white-50">Complete Appointments</p>
                        <h6 class="mb-0 text-white"><?php echo $exe5 ? mysqli_num_rows($exe5) : 0; ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-secondary rounded shadow-lg d-flex align-items-center justify-content-between p-5">
                    <i class="fa fa-clock fa-4x text-primary"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-2 text-white-50">Pending Appointments</p>
                        <h6 class="mb-0 text-white"><?php echo $exe6 ? mysqli_num_rows($exe6) : 0; ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-secondary rounded shadow-lg d-flex align-items-center justify-content-between p-5">
                    <i class="fa fa-hand-holding-usd fa-4x text-primary"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-2 text-white-50">Total Commission</p>
                        <h6 class="mb-0 text-white">Rs <?php echo $row7['total_commission'] ?? 0; ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-secondary rounded shadow-lg d-flex align-items-center justify-content-between p-5">
                    <i class="fa fa-calendar-day fa-4x text-primary"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-2 text-white-50">Today Appointments</p>
                        <h6 class="mb-0 text-white"><?php echo $exe9 ? mysqli_num_rows($exe9) : 0; ?></h6>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!-- Sale & Revenue End -->




<!-- Footer Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded-top p-4">
        <div class="row">
            <div class="col-12 col-sm-6 text-center text-sm-start">
                &copy; <a href="#">Your Site Name</a>, All Right Reserved.
            </div>
            <div class="col-12 col-sm-6 text-center text-sm-end">
                <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
</div>
<!-- Content End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/chart/chart.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>