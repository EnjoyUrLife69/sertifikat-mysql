    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Certificate Check System</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <link rel="icon" href="{{asset ('assets/img/logo-bartech-no-text.png')}}" type="image/png">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap"
            rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <link href="{{ asset('User/lib/animate/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('User/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('User/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('User/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('User/css/style.css') }}" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <style>
            .service-img {
                height: 200px;
                overflow: hidden;
                position: relative;
            }

            .service-img img.fixed-img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center;
            }

            #read_more {
                position: relative;
                z-index: 10;
            }
        </style>

    </head>

    <body>
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        @include('frontend/navbar')

        <!-- Project Start -->
        {{-- <div class="container-fluid project">
                <div class="container">
                    <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                        <h4 class="text-primary">Our Projects</h4>
                        <h1 class="display-4">Explore Our Latest Projects</h1>
                    </div>
                    <div class="project-carousel owl-carousel wow fadeInUp" data-wow-delay="0.1s">
                        <div class="project-item h-100 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="project-img">
                                <img src="{{asset ('User/img/projects-1.jpg')}}" class="img-fluid w-100 rounded" alt="Image">
                            </div>
                            <div class="project-content bg-light rounded p-4">
                                <div class="project-content-inner">
                                    <div class="project-icon mb-3"><i class="fas fa-chart-line fa-4x text-primary"></i></div>
                                    <p class="text-dark fs-5 mb-3">Business Growth</p>
                                    <a href="#" class="h4">Business Strategy And Investment Planning Growth Consulting</a>
                                    <div class="pt-4">
                                        <a class="btn btn-light rounded-pill py-3 px-5" href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="project-item h-100 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="project-img">
                                <img src="{{asset ('User/img/projects-1.jpg')}}" class="img-fluid w-100 rounded" alt="Image">
                            </div>
                            <div class="project-content bg-light rounded p-4">
                                <div class="project-content-inner">
                                    <div class="project-icon mb-3"><i class="fas fa-signal fa-4x text-primary"></i></div>
                                    <p class="text-dark fs-5 mb-3">Marketing Strategy</p>
                                    <a href="#" class="h4">Product Sailing Marketing Strategy For Improve Business</a>
                                    <div class="pt-4">
                                        <a class="btn btn-light rounded-pill py-3 px-5" href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="project-item h-100">
                            <div class="project-img">
                                <img src="{{asset ('User/img/projects-1.jpg')}}" class="img-fluid w-100 rounded" alt="Image">
                            </div>
                            <div class="project-content bg-light rounded p-4">
                                <div class="project-content-inner">
                                    <div class="project-icon mb-3"><i class="fas fa-signal fa-4x text-primary"></i></div>
                                    <p class="text-dark fs-5 mb-3">Marketing Strategy</p>
                                    <a href="#" class="h4">Product Sailing Marketing Strategy For Improve Business</a>
                                    <div class="pt-4">
                                        <a class="btn btn-light rounded-pill py-3 px-5" href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        <!-- Project End -->


        <!-- Blog Start -->
        {{-- <div class="container-fluid blog pb-5">
                <div class="container pb-5">
                    <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                        <h4 class="text-primary">Our Blogs</h4>
                        <h1 class="display-4">Latest Articles & News from the Blogs</h1>
                    </div>
                    <div class="row g-4 justify-content-center">
                        <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="blog-item bg-light rounded p-4" style="background-image: url(img/bg.png);">
                                <div class="mb-4">
                                    <h4 class="text-primary mb-2">Investment</h4>
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-0"><span class="text-dark fw-bold">On</span> Mar 14, 2024</p>
                                        <p class="mb-0"><span class="text-dark fw-bold">By</span> Mark D. Brock</p>
                                    </div>
                                </div>
                                <div class="project-img">
                                    <img src="{{asset ('User/img/blog-1.jpg')}}" class="img-fluid w-100 rounded" alt="Image">
                                    <div class="blog-plus-icon">
                                        <a href="img/blog-1.jpg" data-lightbox="blog-1" class="btn btn-primary btn-md-square rounded-pill"><i class="fas fa-plus fa-1x"></i></a>
                                    </div>
                                </div>
                                <div class="my-4">
                                    <a href="#" class="h4">Revisiting Your Investment & Distribution Goals</a>
                                </div>
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Explore More</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="blog-item bg-light rounded p-4" style="background-image: url(img/bg.png);">
                                <div class="mb-4">
                                    <h4 class="text-primary mb-2">Business</h4>
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-0"><span class="text-dark fw-bold">On</span> Mar 14, 2024</p>
                                        <p class="mb-0"><span class="text-dark fw-bold">By</span> Mark D. Brock</p>
                                    </div>
                                </div>
                                <div class="project-img">
                                    <img src="{{asset ('User/img/blog-2.jpg')}}" class="img-fluid w-100 rounded" alt="Image">
                                    <div class="blog-plus-icon">
                                        <a href="img/blog-2.jpg" data-lightbox="blog-2" class="btn btn-primary btn-md-square rounded-pill"><i class="fas fa-plus fa-1x"></i></a>
                                    </div>
                                </div>
                                <div class="my-4">
                                    <a href="#" class="h4">Dimensional Fund Advisors Interview with Director</a>
                                </div>
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Explore More</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.5s">
                            <div class="blog-item bg-light rounded p-4" style="background-image: url(img/bg.png);">
                                <div class="mb-4">
                                    <h4 class="text-primary mb-2">Consulting</h4>
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-0"><span class="text-dark fw-bold">On</span> Mar 14, 2024</p>
                                        <p class="mb-0"><span class="text-dark fw-bold">By</span> Mark D. Brock</p>
                                    </div>
                                </div>
                                <div class="project-img">
                                    <img src="{{asset ('User/img/blog-3.jpg')}}" class="img-fluid w-100 rounded" alt="Image">
                                    <div class="blog-plus-icon">
                                        <a href="img/blog-3.jpg" data-lightbox="blog-3" class="btn btn-primary btn-md-square rounded-pill"><i class="fas fa-plus fa-1x"></i></a>
                                    </div>
                                </div>
                                <div class="my-4">
                                    <a href="#" class="h4">Interested in Giving Back this year? Here are some tips</a>
                                </div>
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Explore More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        <!-- Blog End -->


        <!-- Team Start -->
        {{-- <div class="container-fluid team pb-5">
                <div class="container pb-5">
                    <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                        <h4 class="text-primary">Our Team</h4>
                        <h1 class="display-4">Our Investa Company Dedicated Team Member</h1>
                    </div>
                    <div class="row g-4 justify-content-center">
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="team-item rounded">
                                <div class="team-img">
                                    <img src="{{asset ('User/img/team-1.jpg')}}" class="img-fluid w-100 rounded-top" alt="Image">
                                    <div class="team-icon">
                                        <a class="btn btn-primary btn-sm-square text-white rounded-circle mb-3" href=""><i class="fas fa-share-alt"></i></a>
                                        <div class="team-icon-share">
                                            <a class="btn btn-primary btn-sm-square text-white rounded-circle mb-3" href=""><i class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-primary btn-sm-square text-white rounded-circle mb-3" href=""><i class="fab fa-twitter"></i></a>
                                            <a class="btn btn-primary btn-sm-square text-white rounded-circle mb-0" href=""><i class="fab fa-instagram"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="team-content bg-dark text-center rounded-bottom p-4">
                                    <div class="team-content-inner rounded-bottom">
                                        <h4 class="text-white">Mark D. Brock</h4>
                                        <p class="text-muted mb-0">CEO & Founder</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="team-item rounded">
                                <div class="team-img">
                                    <img src="{{asset ('User/img/team-2.jpg')}}" class="img-fluid w-100 rounded-top" alt="Image">
                                    <div class="team-icon">
                                        <a class="btn btn-primary btn-sm-square text-white rounded-circle mb-3" href=""><i class="fas fa-share-alt"></i></a>
                                        <div class="team-icon-share">
                                            <a class="btn btn-primary btn-sm-square text-white rounded-circle mb-3" href=""><i class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-primary btn-sm-square text-white rounded-circle mb-3" href=""><i class="fab fa-twitter"></i></a>
                                            <a class="btn btn-primary btn-sm-square text-white rounded-circle mb-0" href=""><i class="fab fa-instagram"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="team-content bg-dark text-center rounded-bottom p-4">
                                    <div class="team-content-inner rounded-bottom">
                                        <h4 class="text-white">Mark D. Brock</h4>
                                        <p class="text-muted mb-0">CEO & Founder</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                            <div class="team-item rounded">
                                <div class="team-img">
                                    <img src="{{asset ('User/img/team-3.jpg')}}" class="img-fluid w-100 rounded-top" alt="Image">
                                    <div class="team-icon">
                                        <a class="btn btn-primary btn-sm-square text-white rounded-circle mb-3" href=""><i class="fas fa-share-alt"></i></a>
                                        <div class="team-icon-share">
                                            <a class="btn btn-primary btn-sm-square text-white rounded-circle mb-3" href=""><i class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-primary btn-sm-square text-white rounded-circle mb-3" href=""><i class="fab fa-twitter"></i></a>
                                            <a class="btn btn-primary btn-sm-square text-white rounded-circle mb-0" href=""><i class="fab fa-instagram"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="team-content bg-dark text-center rounded-bottom p-4">
                                    <div class="team-content-inner rounded-bottom">
                                        <h4 class="text-white">Mark D. Brock</h4>
                                        <p class="text-muted mb-0">CEO & Founder</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                            <div class="team-item rounded">
                                <div class="team-img">
                                    <img src="{{asset ('User/img/team-4.jpg')}}" class="img-fluid w-100 rounded-top" alt="Image">
                                    <div class="team-icon">
                                        <a class="btn btn-primary btn-sm-square text-white rounded-circle mb-3" href=""><i class="fas fa-share-alt"></i></a>
                                        <div class="team-icon-share">
                                            <a class="btn btn-primary btn-sm-square text-white rounded-circle mb-3" href=""><i class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-primary btn-sm-square text-white rounded-circle mb-3" href=""><i class="fab fa-twitter"></i></a>
                                            <a class="btn btn-primary btn-sm-square text-white rounded-circle mb-0" href=""><i class="fab fa-instagram"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="team-content bg-dark text-center rounded-bottom p-4">
                                    <div class="team-content-inner rounded-bottom">
                                        <h4 class="text-white">Mark D. Brock</h4>
                                        <p class="text-muted mb-0">CEO & Founder</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        <!-- Team End -->


        <!-- Testimonial Start -->
        {{-- <div class="container-fluid testimonial bg-light py-5">
                <div class="container py-5">
                    <div class="row g-4 align-items-center">
                        <div class="col-xl-4 wow fadeInLeft" data-wow-delay="0.1s">
                            <div class="h-100 rounded">
                                <h4 class="text-primary">Our Feedbacks </h4>
                                <h1 class="display-4 mb-4">Clients are Talking</h1>
                                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum atque soluta unde itaque. Consequatur quam odit blanditiis harum veritatis porro.</p>
                                <a class="btn btn-primary rounded-pill text-white py-3 px-5" href="#">Read All Reviews <i class="fas fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="testimonial-carousel owl-carousel wow fadeInUp" data-wow-delay="0.1s">
                                <div class="testimonial-item bg-white rounded p-4 wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="d-flex">
                                        <div><i class="fas fa-quote-left fa-3x text-dark me-3"></i></div>
                                        <p class="mt-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magnam eos impedit eveniet dolorem culpa ullam incidunt vero quo recusandae nemo? Molestiae doloribus iure,
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <div class="my-auto text-end">
                                            <h5>Person Name</h5>
                                            <p class="mb-0">Profession</p>
                                        </div>
                                        <div class="bg-white rounded-circle ms-3">
                                            <img src="{{asset ('User/img/testimonial-1.jpg')}}" class="rounded-circle p-2" style="width: 80px; height: 80px; border: 1px solid; border-color: var(--bs-primary);" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="testimonial-item bg-white rounded p-4 wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="d-flex">
                                        <div><i class="fas fa-quote-left fa-3x text-dark me-3"></i></div>
                                        <p class="mt-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magnam eos impedit eveniet dolorem culpa ullam incidunt vero quo recusandae nemo? Molestiae doloribus iure,
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <div class="my-auto text-end">
                                            <h5>Person Name</h5>
                                            <p class="mb-0">Profession</p>
                                        </div>
                                        <div class="bg-white rounded-circle ms-3">
                                            <img src="{{asset ('User/img/testimonial-2.jpg')}}" class="rounded-circle p-2" style="width: 80px; height: 80px; border: 1px solid; border-color: var(--bs-primary);" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="testimonial-item bg-white rounded p-4 wow fadeInUp" data-wow-delay="0.7s">
                                    <div class="d-flex">
                                        <div><i class="fas fa-quote-left fa-3x text-dark me-3"></i></div>
                                        <p class="mt-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magnam eos impedit eveniet dolorem culpa ullam incidunt vero quo recusandae nemo? Molestiae doloribus iure,
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <div class="my-auto text-end">
                                            <h5>Person Name</h5>
                                            <p class="mb-0">Profession</p>
                                        </div>
                                        <div class="bg-white rounded-circle ms-3">
                                            <img src="{{asset ('User/img/testimonial-3.jpg')}}" class="rounded-circle p-2" style="width: 80px; height: 80px; border: 1px solid; border-color: var(--bs-primary);" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        <!-- Testimonial End -->


        <!-- FAQ Start -->
        {{-- <div class="container-fluid faq py-5">
                <div class="container py-5">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                            <div class="pb-5">
                                <h4 class="text-primary">FAQs</h4>
                                <h1 class="display-4">Get the Answers to Common Questions</h1>
                            </div>
                        <div class="accordion bg-light rounded p-4" id="accordionExample">
                                <div class="accordion-item border-0 mb-4">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button text-dark fs-5 fw-bold rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseTOne">
                                            What Does a Financial Advisor Do?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body my-2">
                                            <h5>Dolor sit amet consectetur adipisicing elit.</h5>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad nemo impedit, sapiente quis illo quia nulla atque maxime fuga minima ipsa quae cum consequatur, sit, delectus exercitationem odit officiis maiores! Neque, quidem corrupti modi architecto eos saepe incidunt dignissimos rerum.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0 mb-4">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed text-dark fs-5 fw-bold rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            What industries do you specialize in? 
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body my-2">
                                            <h5>Dolor sit amet consectetur adipisicing elit.</h5>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad nemo impedit, sapiente quis illo quia nulla atque maxime fuga minima ipsa quae cum consequatur, sit, delectus exercitationem odit officiis maiores! Neque, quidem corrupti modi architecto eos saepe incidunt dignissimos rerum.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0 mb-4">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed text-dark fs-5 fw-bold rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Can you guarantee for growth?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body my-2">
                                            <h5>Dolor sit amet consectetur adipisicing elit.</h5>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad nemo impedit, sapiente quis illo quia nulla atque maxime fuga minima ipsa quae cum consequatur, sit, delectus exercitationem odit officiis maiores! Neque, quidem corrupti modi architecto eos saepe incidunt dignissimos rerum.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0 mb-0">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed text-dark fs-5 fw-bold rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            What makes your business plans so special?
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="accordion-body my-2">
                                            <h5>Dolor sit amet consectetur adipisicing elit.</h5>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad nemo impedit, sapiente quis illo quia nulla atque maxime fuga minima ipsa quae cum consequatur, sit, delectus exercitationem odit officiis maiores! Neque, quidem corrupti modi architecto eos saepe incidunt dignissimos rerum.</p>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </div>
                        <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                            <div class="faq-img RotateMoveRight rounded">
                                <img src="{{asset('User/img/faq-img.jpg')}}" class="img-fluid rounded w-100" alt="Image">
                                <a class="faq-btn btn btn-primary rounded-pill text-white py-3 px-5" href="#">Read More Q & A <i class="fas fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        @yield('content')
        <!-- FAQ End -->

        @include('frontend/footer')


        <!-- JavaScript Libraries -->
        <script>
            document.getElementById('cek').addEventListener('click', function() {
                var nomorSertifikat = document.getElementById('no_sertifikat').value;

                // Kirim permintaan AJAX
                fetch({{ route('checkCertificate') }} ? nomor_sertifikat = $ {
                        encodeURIComponent(nomorSertifikat)
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Tampilkan hasil di div dengan id 'result'
                        var resultDiv = document.getElementById('result');
                        if (data.status === 'success') {
                            resultDiv.innerHTML = < div class = "alert alert-success" > $ {
                                data.message
                            } < /div>;
                        } else {
                            resultDiv.innerHTML = < div class = "alert alert-danger" > $ {
                                data.message
                            } < /div>;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('result').innerHTML =
                            '<div class="alert alert-danger">Terjadi kesalahan. Silakan coba lagi.</div>';
                    });
            });
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('User/lib/wow/wow.min.js') }}"></script>
        <script src="{{ asset('User/lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('User/lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('User/lib/counterup/counterup.min.js') }}"></script>
        <script src="{{ asset('User/lib/owlcarousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('User/lib/lightbox/js/lightbox.min.js') }}"></script>

        <script src="{{ asset('User/js/main.js') }}"></script>
        <script>
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetElement = document.querySelector(this.getAttribute('href'));

                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                // Fungsi untuk menambahkan atau menghapus class active berdasarkan scroll
                $(window).on('scroll', function() {
                    var scrollPosition = $(this).scrollTop();

                    // Loop melalui setiap bagian untuk menambahkan class active pada nav-link yang sesuai
                    $('.navbar-nav .nav-link').each(function() {
                        var sectionOffset = $($(this).attr('href')).offset().top - 100;

                        if (scrollPosition >= sectionOffset) {
                            // Hapus class active dari semua link
                            $('.navbar-nav .nav-link').removeClass('active');
                            // Tambah class active pada link yang sesuai
                            $(this).addClass('active');
                        }
                    });
                });

                // Mengatur event click untuk semua item navbar
                $('.navbar-nav .nav-link').on('click', function() {
                    // Menghapus class active dari semua nav-link
                    $('.navbar-nav .nav-link').removeClass('active');

                    // Menambahkan class active ke nav-link yang diklik
                    $(this).addClass('active');
                });
            });
        </script>

    </body>

    </html>
