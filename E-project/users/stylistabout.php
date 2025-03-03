<style>
    .cartdiv {
        margin-top: 50px !important;
    }

    .reviewcontainer {
        margin-top: 50px !important;

    }

    .review {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        background-color: #f9f9f9;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .rating .fa-star {
        color: #FFD700;
    }

    .checked {
        color: #FFD700;
    }

    .review-body {
        margin-top: 10px;
        font-style: italic;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .average-rating {
        margin-top: 50px;
        font-size: 20px;
        font-weight: 600;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    .average-rating .fa-star {
        font-size: 24px;
        color: #FFD700;
    }

    textarea.form-control {
        resize: none;
    }

    .submit-review {
        margin-top: 20px;
    }

    .delete-btn {
        background: none;
        border: none;
        color: #ff5c5c;
        font-size: 16px;
        cursor: pointer;
        margin-left: 10px;
        transition: color 0.3s ease;
    }

    .delete-btn:hover {
        color: #ff1a1a;
    }

    .delete-review-form {
        display: inline;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .rating {
        display: flex;
        align-items: center;
    }

    .rating .fa-star {
        color: #FFD700;
        /* Gold color for stars */
        margin-right: 2px;
        /* Space between stars */
    }

    .delete-btn {
        background: none;
        border: none;
        color: #ff5c5c;
        font-size: 16px;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .delete-btn:hover {
        color: #ff1a1a;
    }
</style>


<?php
include('header.php');
include('config.php');
$id = $_GET['id'];

$query = "SELECT stylists.*, users.name FROM stylists join users on stylists.user_id=users.id where stylists.id=$id";
$exe = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($exe);

$query2 = "SELECT services.servicesname FROM stylist_services INNER JOIN stylists ON stylist_services.stylist_id = stylists.id INNER JOIN services ON stylist_services.service_id = services.id WHERE stylist_services.stylist_id = $id";
$exe2 = mysqli_query($db, $query2);

$services = [];
while ($row2 = mysqli_fetch_assoc($exe2)) {
    $services[] = $row2['servicesname'];
}

$servies_list = implode(', ', $services);

?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-3 text-white text-uppercase mb-3 animated slideInDown">Portfolio</h1>
        <nav aria-label="breadcrumb animated slideInDown">

        </nav>
    </div>
</div>
<!-- Page Header End -->


<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="d-flex flex-column">
                    <img class="img-fluid w-75 align-self-end" src="../admin/stylist/<?php echo $row['image'] ?>" alt="">
                    <div class="w-50 bg-secondary p-5" style="margin-top: -25%;">
                        <h1 class="text-uppercase text-primary mb-3"><?php echo $row['experience'] ?></h1>
                        <h2 class="text-uppercase mb-0">Experience</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">

                <h1 class="text-uppercase mb-4"><?php echo $row['name'] ?></h1>
                <p>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                <p class="mb-4">Stet no et lorem dolor et diam, amet duo ut dolore vero eos. No stet est diam rebum amet diam ipsum. Clita clita labore, dolor duo nonumy clita sit at, sed sit sanctus dolor eos.</p>
                <div class="row g-4">
                    <div class="col-md-6">
                        <h3 class="text-uppercase mb-3">Qualification</h3>
                        <p class="mb-0"><?php echo $row['qualification'] ?></p>

                        <a href="booking.php?id=<?php echo $row['id'] ?>" class="btn btn-primary rounded-0 px-lg-4 mt-3">Appointment<i class="fa fa-arrow-right ms-3"></i></a>
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-uppercase mb-3">Services</h3>
                        <p class="mb-0"><?php echo $servies_list ?></p>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid reviewcontainer">
    <div class="row">
        <div class="col-md-6 text-center">
            <h4 class="text-center">Customer Reviews</h4>
            <hr>
            <div class="reviews">
                <?php
                $reviews_query = "SELECT reviews.*,users.name FROM reviews join users on reviews.user_id = users.id WHERE stylist_id = $id ORDER BY created_at DESC";
                $reviews_result = mysqli_query($db, $reviews_query);


                if (mysqli_num_rows($reviews_result) > 0): ?>
                    <?php while ($review = mysqli_fetch_assoc($reviews_result)): ?>
                        <div class="review">
                            <div class="review-header">
                                <strong><?php echo $review['name']; ?></strong>
                                <div class="rating">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <span class="fa fa-star <?php echo $i <= $review['rating'] ? 'checked' : ''; ?>"></span>
                                    <?php endfor; ?>
                                </div>
                                <form action="delete_review.php" method="POST" class="delete-review-form" >
                                    <input type="hidden" value="<?php echo $_GET['id'] ?>" name="stylistid">
                                    <input type="hidden" name="review_id" value="<?php echo $review['id']; ?>">
                                    <button type="submit" onclick="return confirm('Delete this review?')" class="delete-btn">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="review-body">
                                <p><?php echo $review['comment']; ?></p>
                                <small><?php echo date('d M Y, H:i', strtotime($review['created_at'])); ?></small>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center">No reviews yet. Be the first to review!</p>
                <?php endif; ?>
            </div>

            <hr>
            <?php
            if (isset($_SESSION['i'])) {


                $check = "SELECT * FROM reviews WHERE user_id = {$_SESSION['i']}";


                $checkexe = mysqli_query($db, $check);
                $checkappoint = "SELECT * FROM confirmappoint where stylist_id=$id and client_id={$_SESSION['i']}";
                $checkappointexe = mysqli_query($db, $checkappoint);
                $row=mysqli_fetch_assoc($checkappointexe);




                if (isset($_SESSION['i']) && mysqli_num_rows($checkexe) == 0 && mysqli_num_rows($checkappointexe) > 0 && $row['status']==1) {
            ?>

                    <h5>Submit Your Review</h5>
                    <form action="" method="POST">

                        <div class="form-group">
                            <label for="rating">Rating:</label>
                            <div class="rating-stars" style="cursor: pointer; color: gray;">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span class="fa fa-star" data-value="<?php echo $i; ?>"></span>
                                <?php endfor; ?>
                            </div>
                            <input type="hidden" name="rating" id="rating" required>
                        </div>
                        <div class="form-group">
                            <label for="comment">Your Review:</label>
                            <textarea class="form-control" name="comment" id="comment" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary submit-review">Submit Review</button>
                    </form>
                <?php

                } elseif (mysqli_num_rows($checkappointexe) == 0) {
                ?>
                    <p>No appointmend found for this stylist</p>
                <?php
                } elseif (mysqli_num_rows($checkexe) > 0) {
                ?>
                    <p>You have already submitted the review.</p>
                <?php
                } else{
                    ?>
                    <p>Your appointment is on pending once approve you can review the stylists</p>
                <?php


                }
            }
            else {
                ?>
                    <p>You need to <a href="signin.php"><b>login first</b></a></p>
            <?php
                }
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const stars = document.querySelectorAll('.rating-stars .fa-star');
                    const ratingInput = document.getElementById('rating');

                    stars.forEach(star => {
                        star.addEventListener('click', function() {
                            const rating = this.getAttribute('data-value');
                            ratingInput.value = rating; // Set the rating in the hidden input

                            // Remove 'checked' class from all stars and set the checked class for selected stars
                            stars.forEach(s => s.classList.remove('checked'));
                            for (let i = 0; i < rating; i++) {
                                stars[i].classList.add('checked');
                            }
                        });
                    });
                });

                // Add CSS for the 'checked' class
                const style = document.createElement('style');
                style.innerHTML = `
                                    .rating-stars .fa-star.checked {
                                        color: #FFD700; /* Gold color for stars */
                                    }
                                `;
                document.head.appendChild(style);
            </script>


        </div>

    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stylist_id = $id; // Current stylist ID
    $customer_name = mysqli_real_escape_string($db, $_POST['customer_name']);
    $rating = (int)$_POST['rating'];
    $comment = mysqli_real_escape_string($db, $_POST['comment']);

    $insert_query = "INSERT INTO reviews (stylist_id, user_id, rating, comment) VALUES ($stylist_id, '{$_SESSION['i']}', $rating, '$comment')";
    if (mysqli_query($db, $insert_query)) {
        echo "<script>alert('Review submitted successfully');</script>";
        echo "<script>window.location.href='stylistabout.php?id=$id';</script>";
    } else {
        echo "<script>alert('Failed to submit review. Please try again.');</script>";
    }
}
?>
<!-- About End -->


<!-- Team Start -->


<?php
include('footer.php');
?>