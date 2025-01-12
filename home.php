<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "partials/header.php"; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .hero {
            background-color: #e8f5e9;
            padding: 20px;
            text-align: center;
        }

        .carousel-inner img {
            height: 300px;
            object-fit: cover;
        }

        .btn-book {
            background-color: #8bc34a;
            color: white;
            border-radius: 50px;
            font-weight: bold;
        }

        .btn-book:hover {
            background-color: #7cb342;
            color: white;
        }

        .fs-16 {
            font-size: 16px;
        }

        .fs-14 {
            font-size: 14px;
        }

        .fs-36 {
            font-size: 36px;
        }

        .about-section, .diagnostics-section {
            padding: 40px 20px;
            background-color: #f9f9f9;
        }

        .about-section img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .about-content {
            margin-top: 20px;
        }

        .about-content ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .lh-2 {
            line-height: 2;
        }

        .services-section, #home {
            padding: 40px 20px;
        }

        .services .card {
            border: 2px solid #8bc34a;
            border-radius: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: transform 0.3s;
            cursor: pointer;
            min-height: 200px;
        }

        .services .card:hover {
            transform: scale(1.05);
        }


        .bg-light-green {
            background-color: #cbdfc6;
            border: 2px solid #8bc34a;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        /* .bg-light-green:hover {
            transform: scale(1.05);
        } */

        .diagnostics-section ul {
            padding-left: 20px;
            margin: 0;
            list-style-type: disc;
        }

        .diagnostics-section .card {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include "partials/landing-nav.php"; ?>
    <!-- Hero Section -->
    <section id="home">
        <div class="container">
            <header class="hero">
                <h1 class="fs-36 mb-2"><strong>Accuracy Laboratory Clinic</strong></h1>
                <p style="font-size: 16px;">"Precision. Care. Results - Your Trusted Partner in Health Diagnostics."</p>
                <a href="/login" class="btn btn-book px-4 py-2 mt-3">BOOK YOUR APPOINTMENT NOW!</a>
            </header>

            <div id="clinicCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/img/hero-1.jpg" class="d-block w-100" alt="Slide 1">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/hero-2.jpg" class="d-block w-100" alt="Slide 2">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/hero-3.jpg" class="d-block w-100" alt="Slide 3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#clinicCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#clinicCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="text-center mt-4">
                <p class="fs-16">Scheduling your laboratory tests and procedures has never been easier. Enjoy hassle-free convenience with our intuitive booking platform. Your health is our top priority, and we are dedicated to ensure a smooth and effortless experience for you.</p>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="about-section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="assets/img/about-image.jpg" alt="Laboratory Staff" class="mb-2">
                    <ul>
                        <li class="fs-16">Staffed with licensed and accredited laboratory professionals</li>
                        <li class="fs-16">Trusted by thousands of satisfied patients for reliable laboratory services</li>
                    </ul>
                </div>
                <div class="col-md-7">
                    <h2 class="text-center mb-3"><strong>ABOUT US</strong></h2>
                    <h3 class="mb-3">Accuracy Laboratory Corporation</h3>
                    <p class="fs-16 lh-2">
                        Laboratory Clinic San Jose, Batangas, where we strive to exceed your expectations with comfort and top-notch services. Our clinic is dedicated to supporting healthcare professionals while ensuring your privacy and confidentiality.
                    </p>
                    <p class="fs-16 lh-2">
                        Our innovative system enhances the clinic's daily operations ranging from patient appointments to inventory management and equipment monitoring, all through an intuitive, integrated dashboard. This system is crafted with efficiency and quality care at its core.
                    </p>
                    <p class="fs-16 lh-2">
                        Patients benefit from the convenience of scheduling or canceling appointments effortlessly, which reduces wait times and enhances their overall experience. Our automated inventory management feature provides real-time tracking of medical supplies, ensuring that the clinic is always equipped with the necessary resources.
                    </p>
                    <p class="fs-16 lh-2">
                        Furthermore, our equipment monitoring tools offer live updates on equipment status, usage, and maintenance needs, which help prevent downtime and guarantee optimal performance. With these advanced features, our system supports the clinic in providing timely, high-quality healthcare services while maximizing operational efficiency.
                    </p>
                </div>
            </div>
        </div>
    </section>

     <!-- Services Section -->
     <section class="services services-section" id="service">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="text-uppercase"><strong>About Our Services</strong></h2>
                <p class="fs-16">Our Laboratory Clinic offers a variety of tests that evaluate the metabolic functions of the body and monitor organ health.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card p-4" data-bs-toggle="modal" data-bs-target="#serviceModal1">
                        <h5><strong>PURPOSE OF CHEM 6</strong></h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4" data-bs-toggle="modal" data-bs-target="#serviceModal2">
                        <h5><strong>PURPOSE OF CHEM 7</strong></h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4" data-bs-toggle="modal" data-bs-target="#serviceModal3">
                        <h5><strong>PURPOSE OF CHEM 8</strong></h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4" data-bs-toggle="modal" data-bs-target="#serviceModal4">
                        <h5><strong>PURPOSE OF CHEM 9</strong></h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4" data-bs-toggle="modal" data-bs-target="#serviceModal5">
                        <h5><strong>PURPOSE OF CHEM 10</strong></h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4" data-bs-toggle="modal" data-bs-target="#serviceModal6">
                        <h5><strong>PURPOSE OF CHEM 13</strong></h5>
                    </div>
                </div>
            </div>
        </div>

         <!-- Modals for Services -->
         <div class="modal fade" id="serviceModal1" tabindex="-1" aria-labelledby="serviceModal1Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header py-3">
                        <h5 class="modal-title text-uppercase" id="serviceModal1Label">Purpose of Chem 6</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        <p class="fs-16"><strong>Diagnosis:</strong> Detects metabolic imbalances, kidney dysfunction, or electrolyte disturbances.</p>
                        <p class="fs-16"><strong>Monitoring:</strong> Tracks the progression of chronic conditions like kidney disease or diabetes.</p>
                        <p class="fs-16"><strong>Pre-Surgery Screening:</strong> Ensures the body’s metabolic status is stable before surgical procedures.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="serviceModal2" tabindex="-1" aria-labelledby="serviceModal2Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header py-3">
                        <h5 class="modal-title text-uppercase" id="serviceModal2Label">Purpose of Chem 7</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="fs-16"><strong>Diagnosis:</strong> Identifies electrolyte imbalances, kidney dysfunction, acid-base disturbances, and blood sugar abnormalities.</p>
                        <p class="fs-16"><strong>Monitoring:</strong> Tracks ongoing medical conditions like kidney disease, diabetes, or hypertension.</p>
                        <p class="fs-16"><strong>Pre-Surgery Evaluation:</strong> Ensures the patient's body is metabolically stable before surgery.</p>
                        <p class="fs-16"><strong>Acute Illness:</strong> Used in emergencies to assess hydration status, organ function, or the cause of symptoms like confusion, vomiting, or abnormal heart rhythms.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="serviceModal3" tabindex="-1" aria-labelledby="serviceModal3Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header py-3">
                        <h5 class="modal-title text-uppercase" id="serviceModal3Label">Purpose of Chem 8</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="fs-16"><strong>Diagnosis:</strong> Identifies kidney dysfunction, electrolyte imbalances, acid-base disturbances, and calcium-related conditions like hypocalcemia or hypercalcemia.</p>
                        <p class="fs-16"><strong>Monitoring:</strong> Tracks ongoing health issues like chronic kidney disease, diabetes, or electrolyte imbalances.</p>
                        <p class="fs-16"><strong>Pre-Surgery or Hospital Admission:</strong> Ensures stability in metabolic and organ function before interventions.</p>
                        <p class="fs-16"><strong>Acute Symptoms:</strong> Used in emergencies for issues like muscle spasms, seizures, confusion, or irregular heart rhythms, which may involve calcium or other imbalances.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="serviceModal4" tabindex="-1" aria-labelledby="serviceModal4Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header py-3">
                        <h5 class="modal-title text-uppercase" id="serviceModal4Label">Purpose of Chem 9</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        <p class="fs-16"><strong>Diagnosis:</strong> Helps identify kidney issues, electrolyte imbalances, acid-base disturbances, and metabolic abnormalities.</p>
                        <p class="fs-16"><strong>Monitoring:</strong> Tracks chronic conditions such as kidney disease, diabetes, or parathyroid disorders.</p>
                        <p class="fs-16"><strong>Bone and Muscle Health:</strong> Useful for assessing bone metabolism and muscular symptoms.</p>
                        <p class="fs-16"><strong>Pre-Surgery Assessment:</strong> Ensures comprehensive metabolic stability before operations.</p>
                        <p class="fs-16"><strong>Critical Illness:</strong> Provides a detailed evaluation for patients with acute symptoms such as muscle cramps, irregular heartbeats, or respiratory distress.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="serviceModal5" tabindex="-1" aria-labelledby="serviceModal5Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header py-3">
                        <h5 class="modal-title text-uppercase" id="serviceModal5Label">Purpose of Chem 10</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        <p class="fs-16"><strong>Diagnosis:</strong> Offers a comprehensive evaluation to detect kidney disease, metabolic imbalances, liver dysfunction, and nutritional deficiencies.</p>
                        <p class="fs-16"><strong>Monitoring:</strong> Tracks chronic conditions like kidney disease, liver disease, diabetes, and electrolyte disorders.</p>
                        <p class="fs-16"><strong>Bone and Muscle Health:</strong> Used for assessing bone strength, muscle function, and energy metabolism.</p>
                        <p class="fs-16"><strong>Pre-Surgical Evaluation:</strong> Ensures metabolic stability and proper organ function before surgery.</p>
                        <p class="fs-16"><strong>Critical Conditions:</strong> Used for patients with acute symptoms like confusion, muscle cramps, abnormal heart rhythms, or suspected malnutrition.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="serviceModal6" tabindex="-1" aria-labelledby="serviceModal6Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header py-3">
                        <h5 class="modal-title text-uppercase" id="serviceModal6Label">Purpose of Chem 13</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        <p class="fs-16"><strong>Diagnosis:</strong> Provides detailed insights into conditions affecting the kidneys, liver, bones, and metabolic health. Helps detect diseases like kidney failure, liver disorders, bone diseases, and electrolyte imbalances.</p>
                        <p class="fs-16"><strong>Monitoring:</strong> Tracks the progression or treatment of chronic conditions like kidney disease, liver disease, diabetes, or malnutrition.</p>
                        <p class="fs-16"><strong>Bone and Liver Health:</strong> Useful for evaluating liver dysfunction and bone-related issues like osteoporosis or Paget's disease.</p>
                        <p class="fs-16"><strong>Pre-Surgical or Critical Care:</strong> Ensures that a patient's organ and metabolic functions are stable before surgery or during intensive care.</p>
                        <p class="fs-16"><strong>Nutritional Status:</strong> Used for indicating malnutrition or immune system issues.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="diagnostics-section">
        <div class="container text-center">
            <h2 class="mb-3"><strong>WE’VE GOT YOU COVERED!</strong></h2>
            <p class="fs-16 mb-5">Explore our comprehensive range of diagnostic tests tailored to meet your healthcare needs.</p>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card p-4 bg-light-green h-100">
                        <img src="assets/img/test-icon.png" alt="Test Icon" class="mb-3 mx-auto" style="width: 50px;">
                        <h4><strong>CHEM 6</strong></h4>
                        <p class="fs-16">Price: Php 800.00</p>
                        <p class="fs-16">Includes:</p>
                        <ul class="text-start fs-16">
                            <li>FBS</li>
                            <li>Cholesterol</li>
                            <li>Triglycerides</li>
                            <li>Uric Acid</li>
                            <li>Creatinine</li>
                            <li>SGPT/ALT</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card p-4 bg-light-green h-100">
                        <img src="assets/img/test-icon.png" alt="Test Icon" class="mb-3 mx-auto" style="width: 50px;">
                        <h4><strong>CHEM 7</strong></h4>
                        <p class="fs-16">Price: Php 1100.00</p>
                        <p class="fs-16">Includes:</p>
                        <ul class="text-start fs-16">
                            <li>FBS</li>
                            <li>Cholesterol</li>
                            <li>Triglycerides</li>
                            <li>HDL</li>
                            <li>LDL</li>
                            <li>Uric Acid</li>
                            <li>Creatinine</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card p-4 bg-light-green h-100">
                        <img src="assets/img/test-icon.png" alt="Test Icon" class="mb-3 mx-auto" style="width: 50px;">
                        <h4><strong>CHEM 8</strong></h4>
                        <p class="fs-16">Price: Php 1200.00</p>
                        <p class="fs-16">Includes:</p>
                        <ul class="text-start fs-16">
                            <li>FBS</li>
                            <li>Cholesterol</li>
                            <li>Triglycerides</li>
                            <li>HDL</li>
                            <li>LDL</li>
                            <li>Uric Acid</li>
                            <li>Creatinine</li>
                            <li>SGPT/ALT</li>
                        </ul>
                    </div>
                </div>

                <!-- CHEM 9 -->
                <div class="col-md-4 mb-4">
                    <div class="card p-4 bg-light-green h-100">
                        <img src="assets/img/test-icon.png" alt="Test Icon" class="mb-3 mx-auto" style="width: 50px;">
                        <h4><strong>CHEM 9</strong></h4>
                        <p class="fs-16">Price: Php 1350.00</p>
                        <p class="fs-16">Includes:</p>
                        <ul class="text-start fs-16">
                            <li>FBS</li>
                            <li>Cholesterol</li>
                            <li>Triglycerides</li>
                            <li>HDL</li>
                            <li>LDL</li>
                            <li>Uric Acid</li>
                            <li>Creatinine</li>
                            <li>SGPT/ALT</li>
                            <li>SGOT/AST</li>
                        </ul>
                    </div>
                </div>

                <!-- CHEM 10 -->
                <div class="col-md-4 mb-4">
                    <div class="card p-4 bg-light-green h-100">
                        <img src="assets/img/test-icon.png" alt="Test Icon" class="mb-3 mx-auto" style="width: 50px;">
                        <h4><strong>CHEM 10</strong></h4>
                        <p class="fs-16">Price: Php 1500.00</p>
                        <p class="fs-16">Includes:</p>
                        <ul class="text-start fs-16">
                            <li>FBS</li>
                            <li>Cholesterol</li>
                            <li>Triglycerides</li>
                            <li>HDL</li>
                            <li>LDL</li>
                            <li>Uric Acid</li>
                            <li>Creatinine</li>
                            <li>SGPT/ALT</li>
                            <li>SGOT/AST</li>
                            <li>BUN</li>
                        </ul>
                    </div>
                </div>

                <!-- CHEM 13 -->
                <div class="col-md-4 mb-4">
                    <div class="card p-4 bg-light-green h-100">
                        <img src="assets/img/test-icon.png" alt="Test Icon" class="mb-3 mx-auto" style="width: 50px;">
                        <h4><strong>CHEM 13</strong></h4>
                        <p class="fs-16">Price: Php 2400.00</p>
                        <p class="fs-16">Includes:</p>
                        <ul class="text-start fs-16">
                            <li>FBS</li>
                            <li>Cholesterol</li>
                            <li>Triglycerides</li>
                            <li>HDL</li>
                            <li>LDL</li>
                            <li>Uric Acid</li>
                            <li>Creatinine</li>
                            <li>SGPT/ALT</li>
                            <li>SGOT/AST</li>
                            <li>BUN</li>
                            <li>NA (Sodium)</li>
                            <li>K (Potassium)</li>
                            <li>CL (Chloride)</li>
                        </ul>
                    </div>
                </div>

                <!-- Urinalysis -->
                <div class="col-md-4 mb-4">
                    <div class="card p-4 bg-light-green h-100">
                        <img src="assets/img/test-icon.png" alt="Test Icon" class="mb-3 mx-auto" style="width: 50px;">
                        <h4><strong>Urinalysis</strong></h4>
                        <p class="fs-16">Price: Php 100.00</p>
                    </div>
                </div>

                <!-- Complete Blood Count -->
                <div class="col-md-4 mb-4">
                    <div class="card p-4 bg-light-green h-100">
                        <img src="assets/img/test-icon.png" alt="Test Icon" class="mb-3 mx-auto" style="width: 50px;">
                        <h4><strong>Complete Blood Count</strong></h4>
                        <p class="fs-16">Price: Php 350.00</p>
                    </div>
                </div>

                <!-- Fecalysis -->
                <div class="col-md-4 mb-4">
                    <div class="card p-4 bg-light-green h-100">
                        <img src="assets/img/test-icon.png" alt="Test Icon" class="mb-3 mx-auto" style="width: 50px;">
                        <h4><strong>Fecalysis</strong></h4>
                        <p class="fs-16">Price: Php 80.00</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contacts" style="padding: 40px 20px; background: url('assets/img/contact-bg.jpg') center/cover no-repeat; color: white;">
        <div class="container" style="background-color: rgba(0, 0, 0, 0.6); padding: 20px; border-radius: 10px;">
            <header class="text-center">
                <h2 class="mb-3"><strong>CONTACTS</strong></h2>
                <p style="font-size: 16px;">Have questions or need assistance? Reach out to us through the provided contact details, and we’ll be happy to help you!</p>
            </header>

            <div class="row">
                <div class="col-lg-6">
                    <div class="row mt-4">
                        <div class="col-md-12 mb-3">
                            <h4 class="fs-16 text-uppercase"><strong>Address</strong></h4>
                            <p class="fs-16">Lot 1667A, Sevillano-Harina Bldg.,</p>
                            <p class="fs-16">Poblacion III, San Jose, Batangas, San Jose, Philippines</p>
                        </div>
                        <div class="col-md-12">
                            <h4 class="fs-16 text-uppercase"><strong>Contact Details</strong></h4>
                            <p class="fs-16"><strong>Phone:</strong> 0908 675 6960</p>
                            <p class="fs-16"><strong>Email:</strong> <a href="mailto:alc_2018@yahoo.com">alc_2018@yahoo.com</a></p>
                            <p class="fs-16"><strong>Facebook:</strong> <a href="https://web.facebook.com/profile.php?id=100076471623164" target="_blank">Visit Our Facebook Page</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row mt-4">
                        <div class="col">
                            <h4 class="text-uppercase"><strong>Clinic Hours</strong></h4>
                            <ul class="fs-16">
                                <li class="mb-1"><strong>MON:</strong> 9:00 AM - 4:00 PM</li>
                                <li class="mb-1"><strong>TUE:</strong> 9:00 AM - 4:00 PM</li>
                                <li class="mb-1"><strong>WED:</strong> 9:00 AM - 4:00 PM</li>
                                <li class="mb-1"><strong>THU:</strong> 9:00 AM - 4:00 PM</li>
                                <li class="mb-1"><strong>FRI:</strong> 9:00 AM - 4:00 PM</li>
                                <li><strong>SAT:</strong> 9:00 AM - 3:00 PM</li>
                            </ul>
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