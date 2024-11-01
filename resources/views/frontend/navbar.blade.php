<!-- Topbar Start -->
<div id="up"></div>
<div class="container-fluid topbar px-0 d-none d-lg-block">
    <div class="container px-0">
        <div class="row gx-0 align-items-center" style="height: 45px;">
            <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                <div class="d-flex flex-wrap">
                    <a href="https://maps.app.goo.gl/NH3KmfLshZLNM9Cf7" class="text-muted me-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Kunjungi Kami</a>
                    <a href="#" class="text-muted me-4"><i
                            class="fas fa-phone-alt text-primary me-2"></i>022 – 20578810</a>
                    <a href="#" class="text-muted me-0"><i
                            class="fas fa-envelope text-primary me-2"></i>cs@bartechmedia.id</a>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-flex align-items-center justify-content-end">
                    <a href="https://facebook.com/" class="btn btn-primary btn-square rounded-circle nav-fill me-3"><i
                            class="fab fa-facebook-f text-white"></i></a>
                    <a href="https://x.com/home" class="btn btn-primary btn-square rounded-circle nav-fill me-3"><i
                            class="fab fa-twitter text-white"></i></a>
                    <a href="https://instagram.com" class="btn btn-primary btn-square rounded-circle nav-fill me-3"><i
                            class="fab fa-instagram text-white"></i></a>
                    <a href="https://linkedin.com" class="btn btn-primary btn-square rounded-circle nav-fill me-0"><i
                            class="fab fa-linkedin-in text-white"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar & Hero Start -->
<div class="container-fluid sticky-top px-0">
    <div class="position-absolute bg-dark" style="left: 0; top: 0; width: 100%; height: 100%;">
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-white py-3 px-4">
            <a href="{{ url('/') }}#up" class="navbar-brand p-0">
                <img src="{{ asset('assets/img/skill-academy.png') }}"
                    style="display: block; max-width: 100%; margin: auto; z-index: 10; height: 45px" alt="">
                <!-- <img src="img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0" style="font-weight: bold">
                    <a href="{{ url('/') }}#up" class="nav-item nav-link active">Home</a>
                    <a href="{{ url('/') }}#sertifikat" class="nav-item nav-link">Cek Sertifikat</a>
                    <a href="{{ url('/') }}#service" class="nav-item nav-link">Training Program</a>
                    <a href="{{ url('/') }}#about" class="nav-item nav-link">About Us</a>
                </div>

            </div>
        </nav>
    </div>
</div>
<!-- Navbar & Hero End -->
