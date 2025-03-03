<?php

include('../users/config.php');
session_start();

if (!isset($_SESSION['i']) || $_SESSION['r'] == "0") {
    echo "<script>window.location.href='../users/index.php'</script>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
      -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div> -->
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"></i>Elegance Saloon</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../users/userimage/<?php echo $_SESSION['img'] ?>" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $_SESSION['n'] ?></h6>
                        <span><?php echo $_SESSION['r'] ?></span>
                    </div>
                </div>
                <?php if ($_SESSION['r'] == '3') {


                ?>
                    <input type="hidden" id="admin_role" value="<?php echo $_SESSION['r'] ?>">
                    <div class="navbar-nav w-100">
                        <a href="index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>Clients</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="viewusers.php" class="dropdown-item">View Clients</a>
                                <a href="addclient.php" class="dropdown-item">Add Clients</a>

                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-book me-2"></i>Appointment</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="viewappoint.php" class="dropdown-item">View Appointment</a>
                            </div>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-book me-2"></i>Stylist Appoint</a>
                                <div class="dropdown-menu bg-transparent border-0">
                                    <a href="checkappoint.php" class="dropdown-item">View Appointment</a>


                                </div>
                            </div>
                            <a href="show_stylists.php" class="nav-item nav-link"><i class="fa-solid fa-scissors"></i> Stylists</a>
                            <a href="stylisttimes.php" class="nav-item nav-link"><i class="fa fa-clock me-2"></i>Stylist Slots</a>

                            <a href="services.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Services</a>
                            <a href="showinventory.php" class="nav-item nav-link"><i class="fa fa-warehouse me-2"></i>Inventory</a>
                            <a href="stylistsreviews.php" class="nav-item nav-link"><i class="fa fa-thumbs-up me-2"></i>Reviews</a>
                            <a href="contactview.php" class="nav-item nav-link"><i class="fa fa-phone me-2"></i>Contact</a>
                            <div class="nav-item dropdown">


                            </div>
                        </div> <?php
                            } else if ($_SESSION['r'] == '1') {
                                $query = "SELECT * FROM stylists where user_id={$_SESSION['i']}";
                                $exe = mysqli_query($db, $query);
                                if (mysqli_num_rows($exe) > 0) {
                                    $stylist_record = mysqli_fetch_assoc($exe);
                                    $_SESSION['stylist_id'] = $stylist_record['id'];
                                ?>

                            <div class="navbar-nav w-100">
                                <a href="index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                                <a href="showprofilestylist.php" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Show Profile</a>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-book me-2"></i>Appointment</a>
                                    <div class="dropdown-menu bg-transparent border-0">
                                        <a href="todayappoint.php" class="dropdown-item">Today's Appointment</a>
                                        <a href="checkappoint.php" class="dropdown-item">View Appointment</a>


                                    </div>
                                </div>
                                <a href="stylist_show_times.php?id=<?php echo $_SESSION['stylist_id'] ?>" class="nav-item nav-link"><i class="fa fa-clock me-2"></i>My Schedule</a>
                                <a href="stylistsreviews.php" class="nav-item nav-link"><i class="fa fa-message me-2"></i>Feedback</a>

                            </div> <?php

                                } else {
                                    ?>
                            <div class="navbar-nav w-100">

                                <a href="stylistregistration.php" class="nav-item nav-link"><i class="fa fa-book me-2"></i>Registration Form</a>

                            </div>
                        <?php
                                }
                            } else {

                        ?>

                        <div class="navbar-nav w-100">
                            <a href="index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-book me-2"></i>Appointment</a>
                                <div class="dropdown-menu bg-transparent border-0">
                                    <a href="viewappoint.php" class="dropdown-item">View Appointment</a>
                                </div>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>Clients</a>
                                    <div class="dropdown-menu bg-transparent border-0">
                                        <a href="viewusers.php" class="dropdown-item">View Clients</a>
                                    </div>
                                </div>
                                <a href="taskcheck.php" class="nav-item nav-link"><i class="fa-solid fa-list-check"></i> Stylists Task</a>
                                <a href="receptionistinventory.php" class="nav-item nav-link"><i class="fa-solid fa-truck-fast"></i> Inventory</a>
                                <a href="stylistsreviews.php" class="nav-item nav-link"><i class="fa-solid fa-comment"></i> Feedback</a>
                            </div>
                        </div>
                    </div>

                <?php
                            }

                ?>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="text" id="search" placeholder="Search">
                </div>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">

                    </div>
                    <div class="nav-item dropdown">


                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="../users/userimage/<?php echo $_SESSION['img'] ?>" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['n'] ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
       
                            <a href="../users/logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script>
                $(document).ready(function() {
                    $("#search").on('keypress', function(e) {
                        var search = $("#search").val();
                        var url = window.location.pathname;
                        // alert(url)

                        $.ajax({
                            url: 'admin_search.php',
                            type: 'GET',
                            data: {
                                search: search,
                                url: url
                            },
                            dataType: 'json',
                            // contentType:'application/json',
                            success: function(response) {
                                console.log(response);
                                if (url == "/hair_saloon/admin/viewusers.php") {

                                    $("#users_table").empty();
                                    $.each(response, function(key, value) {
                                        var output =
                                            `
                                        <tr>
                                            <th scope="row">${value.id}</th>
                                            <td>${value.name}</td>
                                            <td>${value.email}</td>
                                            <td>${value.role}</td>
                                        </tr> 
                                        `

                                        $("#users_table").append(output);
                                    })
                                } else if (url == "/hair_saloon/admin/viewappoint.php") {
                                    $("#viewappoint").empty();
                                    $.each(response, function(key, value) {
                                        var output = `
                                                    <tr>
                                                        <th scope="row">${value.id}</th>
                                                        <td>${value.client_name}</td>
                                                        <td>${value.stylist_name}</td>
                                                        <td>${value.servicesname}</td>
                                                        <td>${value.price}</td>
                                                        <td>${value.slot_date}</td>
                                                        <td>${value.start_time + ' - ' + value.end_time}</td>
                                                        <td>
                                                            <a href="cancelappoint.php?time_id=${value.time_id}&client_id=${value.client_id}&service_id=${value.service_id}&stylist_id=${value.stylist_id}&id=${value.id}">
                                                                <button class="bg-danger btn-lg text-white"><i class="fa-solid fa-trash"></i></button>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="confirmappoint.php?time_id=${value.time_id}&client_id=${value.client_id}&service_id=${value.service_id}&stylist_id=${value.stylist_id}&id=${value.id}">
                                                                <button class="bg-success btn-lg text-white"><i class="fa-solid fa-check"></i></button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                `;
                                        $("#viewappoint").append(output);
                                    });
                                } else if (url == "/hair_saloon/admin/checkappoint.php") {

                                    $("#checkappoint").empty();

                                    $.each(response, function(key, value) {
                                        var output = `
                                                    <tr>
                                                        <th scope="row">${value.id}</th>
                                                        <td>${value.client_name}</td>
                                                        <td>${value.stylist_name}</td>
                                                        <td>${value.servicesname}</td>
                                                        <td>${value.slot_date}</td>
                                                        <td>${value.start_time + ' ' + value.end_time}</td>

                                                        <td><a href="stylisttask.php"><button class="btn btn-warning">View</button></a>
                                                    <button class="btn btn-success"  style="cursor: not-allowed;">Booked</button></td>

                                                    </tr>
                                                `;
                                        $("#checkappoint").append(output);
                                    });
                                } else if (url == "/hair_saloon/admin/stylisttask.php") {
                                    $("#stylisttask").empty();

                                    $.each(response, function(key, value) {
                                        var output = `
            <tr>
                <th scope="row">${value.id}</th>
                <td>${value.client_name}</td>
                <td>${value.stylist_name}</td>
                <td>${value.servicesname}</td>
                <td>${(value.price * 30 / 100).toFixed(2)}</td>
                <td>${value.slot_date}</td>
                <td>${value.start_time + ' - ' + value.end_time}</td>`;

                                        if ($("#admin_role") === "3") {
                                            if (value.status == 0) {
                                                if (value.slot_date > new Date().toISOString().split('T')[0]) {
                                                    output += `
                        <td>
                            <p>Waiting for the time</p>
                        </td>`;
                                                } else {
                                                    output += `
                        <td>
                            <button type="button" class="btn btn-primary">Pending</button>
                        </td>`;
                                                }
                                            } else {
                                                output += `
                    <td>
                        <button class="btn btn-success" style="cursor: not-allowed;">Completed</button>
                    </td>`;
                                            }
                                        } else {
                                            if (value.status == 0) {
                                                if (value.slot_date > new Date().toISOString().split('T')[0]) {
                                                    output += `
                        <td>
                            <p>Waiting for the time</p>
                        </td>`;
                                                } else {
                                                    output += `
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal${value.id}">
                                Pending
                            </button>
                            <div class="modal fade" id="exampleModal${value.id}" tabindex="-1" aria-labelledby="exampleModalLabel${value.id}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel${value.id}">Assign Task</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="post">
                                            <div class="modal-body">
                                                <input type="hidden" value="${value.id}" name="appoint">
                                                <input type="hidden" value="${(value.price * 30 / 100).toFixed(2)}" name="price">
                                                <input type="hidden" value="${value.price}" name="totalprice">

                                                <select name="item_name" class="form-control">
                                                    
                                                </select>
                                                <input type="number" name="quantity" class="form-control mt-3" min="1" max="1">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="btnsubmit">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>`;
                                                }
                                            } else {
                                                output += `
                    <td>
                        <button class="btn btn-success" style="cursor: not-allowed;">Completed</button>
                    </td>`;
                                            }
                                        }

                                        output += `</tr>`;
                                        $("#stylisttask").append(output);
                                    });
                                } else if (url == "/hair_saloon/admin/show_stylists.php") {

                                    $("#show_stylists").empty();

                                    $.each(response, function(key, value) {
                                        var output = `
                                                    <tr>
                                                        <th scope="row">${value.id}</th>
                                                        <td>${value.client_name}</td>
                                                        <td>${value.stylist_name}</td>
                                                        <td>${value.servicesname}</td>
                                                        <td>${value.slot_date}</td>
                                                        <td>${value.start_time + ' ' + value.end_time}</td>

                                                        <td><a href="stylisttask.php"><button class="btn btn-warning">View</button></a>
                                                    <button class="btn btn-success"  style="cursor: not-allowed;">Booked</button></td>

                                                    </tr>
                                                `;
                                        $("#show_stylists").append(output);
                                    });
                                } else if (url == "/hair_saloon/admin/show_stylists.php") {
                                    console.log(response);
                                    
                                    $("#show_stylists").empty();

                                    $.each(response, function(key, value) {
                                        var output = `
            <tr>
                <th scope="row">${value.id}</th>
                <td>${value.name}</td>
                <td>${value.email}</td>
                <td>${value.qualification}</td>
                <td>${value.experience}</td>
                <td>${value.services}</td>
                <td>${value.completed_appointments}</td>
                <td>${determinePerformance(value.completed_appointments)}</td>
            </tr>
        `;
                                        $("#show_stylists").append(output);
                                    });
                                }

                                function determinePerformance(completedAppointments) {
                                    if (completedAppointments >= 10) return "Excellent";
                                    else if (completedAppointments >= 5) return "Great";
                                    else if (completedAppointments >= 3) return "Good";
                                    else if (completedAppointments >= 1) return "Fair";
                                    else return "Work Hard";
                                }

                            }
                        })
                    })
                })
            </script>