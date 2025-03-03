<?php

include('header.php')

?>


<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                <div class="carousel-caption d-flex align-items-center justify-content-center text-start">
                    <div class="mx-sm-5 px-5" style="max-width: 900px;">
                        <h1 class="display-2 text-white text-uppercase mb-4 animated slideInDown">We Will Keep You An Awesome Look</h1>
                        <h4 class="text-white text-uppercase mb-4 animated slideInDown"><i class="fa fa-map-marker-alt text-primary me-3"></i>123 Street, New York, USA</h4>
                        <h4 class="text-white text-uppercase mb-4 animated slideInDown"><i class="fa fa-phone-alt text-primary me-3"></i>+012 345 67890</h4>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                <div class="carousel-caption d-flex align-items-center justify-content-center text-start">
                    <div class="mx-sm-5 px-5" style="max-width: 900px;">
                        <h1 class="display-2 text-white text-uppercase mb-4 animated slideInDown">Luxury Haircut at Affordable Price</h1>
                        <h4 class="text-white text-uppercase mb-4 animated slideInDown"><i class="fa fa-map-marker-alt text-primary me-3"></i>123 Street, New York, USA</h4>
                        <h4 class="text-white text-uppercase mb-4 animated slideInDown"><i class="fa fa-phone-alt text-primary me-3"></i>+012 345 67890</h4>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->


<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="d-flex flex-column">
                    <img class="img-fluid w-75 align-self-end" src="img/about.jpg" alt="">
                    <div class="w-50 bg-secondary p-5" style="margin-top: -25%;">
                        <h1 class="text-uppercase text-primary mb-3">25 Years</h1>
                        <h2 class="text-uppercase mb-0">Experience</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <p class="d-inline-block bg-secondary text-primary py-1 px-4">About Us</p>
                <h1 class="text-uppercase mb-4">More Than Just A Haircut. Learn More About Us!</h1>
                <p>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                <p class="mb-4">Stet no et lorem dolor et diam, amet duo ut dolore vero eos. No stet est diam rebum amet diam ipsum. Clita clita labore, dolor duo nonumy clita sit at, sed sit sanctus dolor eos.</p>
                <div class="row g-4">
                    <div class="col-md-6">
                        <h3 class="text-uppercase mb-3">Since 1990</h3>
                        <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos.</p>
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-uppercase mb-3">1000+ clients</h3>
                        <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block bg-secondary text-primary py-1 px-4">Services</p>
            <h1 class="text-uppercase">What We Provide</h1>
        </div>
        <div class="row g-4">
        <?php 
                        $queryprice2="SELECT * from services";
                        $result2=mysqli_query($db,$queryprice2);
                        while($row=mysqli_fetch_assoc($result2)){
                            ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item position-relative overflow-hidden bg-secondary d-flex h-100 p-5 ps-0">
                    <div class="bg-dark d-flex flex-shrink-0 align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <img class="img-fluid" src="../admin/service/<?php echo $row['image']?>" alt="">
                    </div>
                    <div class="ps-4">
                        <h3 class="text-uppercase mb-3"><?php echo $row['servicesname'] ?></h3>
                        <p>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam.</p>
                        <span class="text-uppercase text-primary">From Rs <?php echo $row['price'] ?></span>
                    </div>
                    <a class="btn btn-square" href=""><i class="fa fa-plus text-primary"></i></a>
                </div>
            </div>
            <?php 
                        }
            ?>
          
        </div>
    </div>
</div>
<!-- Service End -->


<!-- Price Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-0">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="bg-secondary h-100 d-flex flex-column justify-content-center p-5">
                    <p class="d-inline-flex bg-dark text-primary py-1 px-4 me-auto">Price & Plan</p>
                    <h1 class="text-uppercase mb-4">Check Out Our Barber Services And Prices</h1>
                    <div>
                        <?php 
                        $queryprice="SELECT * from services";
                        $result=mysqli_query($db,$queryprice);
                        while($row=mysqli_fetch_assoc($result)){
                            ?>
                              <div class="d-flex justify-content-between border-bottom py-2">
                            <h6 class="text-uppercase mb-0"><?php echo $row['servicesname'] ?></h6>
                            <span class="text-uppercase text-primary"><?php echo $row['price'] ?></span>
                        </div>
                            <?php 

                        }
                         ?>
                      
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="h-100">
                    <img class="img-fluid h-100" src="img/price.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Price End -->


<!-- Team Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block bg-secondary text-primary py-1 px-4">Our Barber</p>
            <h1 class="text-uppercase">Meet Our Barber</h1>
        </div>
        <div class="row g-4">
            <?php
            $query = "SELECT stylists.*, users.name, users.email, users.role FROM stylists join users on stylists.user_id=users.id ";
            $exe = mysqli_query($db, $query);

            if (mysqli_num_rows($exe) > 0) {

                while ($row = mysqli_fetch_assoc($exe)) {
                    $stylist_id = $row['id'];
                    $query2 = "SELECT services.servicesname FROM stylist_services INNER JOIN stylists ON stylist_services.stylist_id = stylists.id INNER JOIN services ON stylist_services.service_id = services.id WHERE stylist_services.stylist_id = $stylist_id";
                    $exe2 = mysqli_query($db, $query2);
                    // print_r($exe2);
                    $stylist_services = [];
                    while ($row2 = mysqli_fetch_assoc($exe2)) {
                        $stylist_services[] = $row2['servicesname'];
                    }

                    $service_list = implode(", ", $stylist_services);
            ?> <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item">
                            <div class="team-img position-relative overflow-hidden">
                                <img class="img-fluid" src="../admin/stylist/<?php echo $row['image'] ?>" alt="">
                                <div class="team-social">
                                    <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <a href="stylistabout.php?id=<?php echo $row['id'] ?>">
                                <div class="bg-secondary text-center p-4">
                                    <h5 class="text-uppercase"><?php echo $row['name'] ?></h5>
                                    <span class="text-primary"><?php echo $service_list ?></span>
                                </div>
                            </a>
                        </div>
                    </div>
            <?php

                }
            } else {
            }
            ?>


        </div>
    </div>
</div>
<!-- Team End -->


<!-- Working Hours Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-0">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="h-100">
                    <img class="img-fluid h-100" src="img/open.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="bg-secondary h-100 d-flex flex-column justify-content-center p-5">
                    <p class="d-inline-flex bg-dark text-primary py-1 px-4 me-auto">Working Hours</p>
                    <h1 class="text-uppercase mb-4">Professional Barbers Are Waiting For You</h1>
                    <div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <h6 class="text-uppercase mb-0">Monday</h6>
                            <span class="text-uppercase">09 AM - 09 PM</span>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <h6 class="text-uppercase mb-0">Tuesday</h6>
                            <span class="text-uppercase">09 AM - 09 PM</span>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <h6 class="text-uppercase mb-0">Wednesday</h6>
                            <span class="text-uppercase">09 AM - 09 PM</span>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <h6 class="text-uppercase mb-0">Thursday</h6>
                            <span class="text-uppercase">09 AM - 09 PM</span>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <h6 class="text-uppercase mb-0">Friday</h6>
                            <span class="text-uppercase">09 AM - 09 PM</span>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <h6 class="text-uppercase mb-0">Sat / Sun</h6>
                            <span class="text-uppercase text-primary">Closed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Working Hours End -->


<!-- Testimonial Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block bg-secondary text-primary py-1 px-4">Testimonial</p>
            <h1 class="text-uppercase">What Our Clients Say!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            <div class="testimonial-item text-center" data-dot="<img class='img-fluid' src='img/testimonial-1.jpg' alt=''>">
                <h4 class="text-uppercase">Client Name</h4>
                <p class="text-primary">Profession</p>
                <span class="fs-5">Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea clita.</span>
            </div>
            <div class="testimonial-item text-center" data-dot="<img class='img-fluid' src='img/testimonial-2.jpg' alt=''>">
                <h4 class="text-uppercase">Client Name</h4>
                <p class="text-primary">Profession</p>
                <span class="fs-5">Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea clita.</span>
            </div>
            <div class="testimonial-item text-center" data-dot="<img class='img-fluid' src='img/testimonial-3.jpg' alt=''>">
                <h4 class="text-uppercase">Client Name</h4>
                <p class="text-primary">Profession</p>
                <span class="fs-5">Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea clita.</span>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->

<?php

include('footer.php');

?>