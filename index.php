<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    <!-- swiper-code -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">



    <title>RepairShop</title>

</head>

<body>
    <!-- NAV BAR SECTION SATRT FROM HERE -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand fs-4 font-weight-normal" href="#">OnlineRepairShop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link fs-5" aria-current="page" href="#index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" aria-current="page" href="#Registration">Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" aria-current="page" href="#Contact">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" aria-current="page" href="#Services">Service</a>
                    </li>

                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link fs-5" aria-current="page"
                            href="technician/technician_login.php">Technician</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fs-5" aria-current="page" href="Requester/RequesterLogin.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" aria-current="page" href="admin/adminlogin.php">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- SWIPPER SECTION AREA FOR THE SWIPPER -->
    <div class="container mt-5">
        <!-- swiper-content starts from here -->
        <div class="swiper-container mySwiper mb-3">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="images/civil.avif" class="img-fluid w-100" alt="Image 1" />
                </div>
                <div class="swiper-slide">
                    <img src="images/digital.jpeg" class="img-fluid w-100" alt="Image 2" />
                </div>
                <div class="swiper-slide">
                    <img src="images/namw.jpeg" class="img-fluid w-100" alt="Image 3" />
                </div>
                <div class="swiper-slide">
                    <img src="images/repair.jpeg" class="img-fluid w-100" alt="Image 4" />
                </div>
            </div>
        </div>
        <!-- swiper-content ends here -->
    </div>


    <!-- OUR SERVICES SECTION OF MY WEBSITE -->
    <div class="container mt-3 text-center border-bottom" id="Services">
        <h2 class="mb-5 text-center">OUR SERVICES</h2>
        <div class="row">
            <div class="col-sm-4 mb-3 mb-sm-0">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CREATE AN ACCOUNT SECTION -->
    <?php include ('UserRegistration.php') ?>
    <!--Create a technician account   -->
    <?php include ('technician_registration.php') ?>

    <!-- HAPPY CUSTOMER SECTION -->
    <div class="container mt-3">
        <div class="jumbotron bg-primary text-white">
            <div class="container">
                <h2 class="text-center text-white">OUR HAPPY CUSTOMER</h2>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card shadow-lg mb-2">
                            <div class="card-body text-center">
                                <img src="images/thank.webp" class="img-fluid" style="border: radius 100px;" alt="">
                                <h4 class="card-title">Manish kumar</h4>
                                <p class="card-text">i love this website as it is very useful to our home services</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card shadow-lg mb-2">
                            <div class="card-body text-center">
                                <img src="images/thank.webp" class="img-fluid" style="border: radius 100px;" alt="">
                                <h4 class="card-title">Manish kumar</h4>
                                <p class="card-text">i love this website as it is very useful to our home services</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card shadow-lg mb-2">
                            <div class="card-body text-center">
                                <img src="images/thank.webp" class="img-fluid" style="border: radius 100px;" alt="">
                                <h4 class="card-title">Manish kumar</h4>
                                <p class="card-text">i love this website as it is very useful to our home services</p>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card shadow-lg mb-2">
                            <div class="card-body text-center">
                                <img src="images/thank.webp" class="img-fluid" style="border: radius 100px;" alt="">
                                <h4 class="card-title">Manish kumar</h4>
                                <p class="card-text">i love this website as it is very useful to our home services</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- CONTACT US SECTION FOR THE APPROACHING TO US -->
    <?php include ('ContactForm.php') ?>

    <!-- START OF THE FOOTER FROM HERE FOR MY WEBSITE -->
    <div class="mt-5"></div>
    <!-- Footer -->
    <footer class="text-center text-lg-start text-dark" style="background-color: #ECEFF1">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-between p-4 text-white" style="background-color: #21D192">
            <!-- Left -->
            <div class="me-5">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Right -->
            <div>
                <a href="" class="text-white me-4">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-github"></i>
                </a>
            </div>
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold">Company name</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px">
                        <p>
                            Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit
                            amet, consectetur adipisicing elit.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Products</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px">
                        <p>
                            <a href="#!" class="text-dark">MDBootstrap</a>
                        </p>
                        <p>
                            <a href="#!" class="text-dark">MDWordPress</a>
                        </p>
                        <p>
                            <a href="#!" class="text-dark">BrandFlow</a>
                        </p>
                        <p>
                            <a href="#!" class="text-dark">Bootstrap Angular</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Useful links</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px">
                        <p>
                            <a href="#!" class="text-dark">Your Account</a>
                        </p>
                        <p>
                            <a href="#!" class="text-dark">Become an Affiliate</a>
                        </p>
                        <p>
                            <a href="#!" class="text-dark">Shipping Rates</a>
                        </p>
                        <p>
                            <a href="#!" class="text-dark">Help</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Contact</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px">
                        <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
                        <p><i class="fas fa-envelope mr-3"></i> info@example.com</p>
                        <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
                        <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2020 Copyright:
            <a class="text-dark" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->



    <!-- javascript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/all.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Swiper Initialization -->
    <script>
        var mySwiper = new Swiper('.mySwiper', {
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            spaceBetween: 30,
            effect: 'fade',
            loop: true, // Set loop to true for an infinite loop
        });

        // Automatic image refresh every 2 seconds
        setInterval(function () {
            mySwiper.slideNext();
        }, 2000);
    </script>

</body>

</html>