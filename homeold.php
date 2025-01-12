<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "partials/header.php"; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .hero-section {
            background: linear-gradient(to bottom, #a4c14b, #fff);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .hero-content h1 {
            font-size: 3rem;
            font-weight: bold;
            color: #333;
        }

        .hero-content p {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 1.5rem;
        }

        .hero-content .btn-primary {
            background-color: #4caf50;
            border: none;
        }

        .hero-content .btn-primary:hover {
            background-color: #45a049;
        }

        .navbar-nav .nav-link {
            color: #333;
            font-weight: bold;
        }

        .navbar-nav .nav-link:hover {
            color: #4caf50;
        }

        .hero-image img {
            max-width: 100%;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?php include "partials/landing-nav.php"; ?>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Content -->
                <div class="col-md-6 hero-content">
                    <h1 class="text-white" style="line-height: 1.3">Accuracy Laboratory Corporation</h1>
                    <p class="text-white mb-2">Medical Laboratory</p>
                    <p class="text-white mb-5">
                        "Precision. Care. Results - Your Trusted Partner in Health Diagnostics."
                    </p>
                    <a href="login" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn mb-4" style="font-size: 15px;">SIGN IN</a>
                </div>
                <!-- Right Image -->
                <div class="col-md-6 hero-image text-end">
                    <img src="assets/img/cover.png" style="border: 1px solid #dfeac0; border-radius: 20px;" alt="Medical Laboratory">
                </div>
            </div>
        </div>
    </section>

    <section class="mt-3 mb-3" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <h2 class="fw-bold text-uppercase text-center">About Us</h2>
                </div>
                <div class="col-lg-12">
                    <h3 class="fw-semibold mb-3 text-center">Accuracy Laboratory Corporation</h3>
                    <p class="text-center" style="font-size: 16px; margin-bottom: 20px;">
                        <strong>Laboratory Clinic San Jose, Batangas</strong>, where we strive to exceed your expectations with comfort and top-notch services. Our clinic is dedicated to supporting healthcare professionals while ensuring your privacy and confidentiality.
                    </p>
                    <p class="text-center" style="font-size: 16px; margin-bottom: 20px;">
                        Our innovative system enhances the clinic's daily operations, ranging from patient appointments to inventory management and equipment monitoring, all through an intuitive, integrated dashboard. This system is crafted with efficiency and quality care at its core.
                    </p>
                    <p class="text-center" style="font-size: 16px; margin-bottom: 20px;">
                        Patients benefit from the convenience of scheduling or canceling appointments effortlessly, which reduces wait times and enhances their overall experience. Our automated inventory management feature provides real-time tracking of medical supplies, ensuring that the clinic is always equipped with the necessary resources.
                    </p>
                    <p class="text-center" style="font-size: 16px; margin-bottom: 20px;">
                        Furthermore, our equipment monitoring tools offer live updates on equipment status, usage, and maintenance needs, which help prevent downtime and guarantee optimal performance. With these advanced features, our system supports the clinic in providing timely, high-quality healthcare services while maximizing operational efficiency.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <hr>

    <section class="mt-5 mb-3" id="service">
    <div class="container">
        <div class="row">
            <!-- Section Title -->
            <div class="col-lg-12 mb-3">
                <h2 class="fw-bold text-uppercase text-center">Services</h2>
                <p class="text-center text-muted" style="font-size: 16px;">Explore our comprehensive range of diagnostic services designed to meet your healthcare needs.</p>
            </div>
            
            <!-- Service List -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Service Card -->
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Chem6</h5>
                                <p class="card-text">Price: 800</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Chem7</h5>
                                <p class="card-text">Price: 1100</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Chem8</h5>
                                <p class="card-text">Price: 1200</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Chem9</h5>
                                <p class="card-text">Price: 1350</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Chem10</h5>
                                <p class="card-text">Price: 1500</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Chem13</h5>
                                <p class="card-text">Price: 2400</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Urinalysis</h5>
                                <p class="card-text">Price: 100</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Complete Blood Count</h5>
                                <p class="card-text">Price: 350</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Fecalysis</h5>
                                <p class="card-text">Price: 80</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <hr>

    <section class="mt-5 mb-3" id="contacts">
        <div class="container">
            <div class="row">
                <!-- Contacts Title -->
                <div class="col-lg-12 mb-3">
                    <h2 class="fw-bold text-uppercase text-center">Contacts</h2>
                    <p class="text-center text-muted" style="font-size: 16px;">Have questions or need assistance? Reach out to us through the provided contact details, and we’ll be happy to help you!</p>
                </div>
            </div>
            
            <div class="row">
                <!-- Address Card -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Address</h5>
                            <p class="card-text" style="font-size: 16px;">
                                Lot 1667A, Sevillano-Harina Bldg.,<br>
                                Poblacion III, San Jose, Batangas, San Jose, Philippines
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contact Details Card -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Contact Details</h5>
                            <p class="card-text" style="font-size: 16px;">
                                <strong>Phone:</strong> 
                                <a href="tel:09086756960" class="text-decoration-none text-dark">0908 675 6960</a>
                            </p>
                            <p class="card-text" style="font-size: 16px;">
                                <strong>Email:</strong> 
                                <a href="mailto:alc_2018@yahoo.com" class="text-decoration-none text-dark">alc_2018@yahoo.com</a>
                            </p>
                            <p class="card-text" style="font-size: 16px;">
                                <strong>Facebook:</strong> 
                                <a href="https://web.facebook.com/profile.php?id=100076471623164" 
                                target="_blank" 
                                class="text-decoration-none text-primary">
                                Visit Our Facebook Page
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
