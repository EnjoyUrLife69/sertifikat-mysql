<!-- Footer Start -->
<a href="#up" class="btn btn-primary btn-lg-square back-to-top "><i class="fa fa-arrow-up"></i></a>
<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4">Subscription</h4>
                    <p class="mb-3">Dapatkan informasi terbaru mengenai pelatihan dan sertifikat langsung di email
                        Anda. Daftarkan diri Anda sekarang!</p>
                    <div class="position-relative mx-auto rounded-pill" style="max-width: 400px;">
                        <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Masukkan email">
                        <button type="button"
                            class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">Daftar</button>
                    </div>
                </div>

            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4">Explore</h4>
                    <a href="#carosel"><i class="fas fa-angle-right me-2"></i> Home</a>
                    <a href="#service"><i class="fas fa-angle-right me-2"></i> Services</a>
                    <a href="#about"><i class="fas fa-angle-right me-2"></i> About Us</a>
                    <a href="#sertifikat"><i class="fas fa-angle-right me-2"></i> Cek Sertifikat</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Contact Us</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4">Contact Info</h4>
                    <a href="https://maps.app.goo.gl/NH3KmfLshZLNM9Cf7"><i class="fa fa-map-marker-alt me-2 "></i> Ruko Holis Regency Blok B No.02, Kec.Babakan Ciparay, Bandung 40222</a>
                    <a href=""><i class="fas fa-envelope me-2"></i> cs@bartechmedia.id</a>
                    {{-- <a href=""><i class="fas fa-envelope me-2"></i> info@example.com</a> --}}
                    <a
                        href="https://api.whatsapp.com/send?phone=6285294427696&text=Halo%20Admin,%20Bisa%20minta%20info%20lebih%20lengkap%20tentang%20Solusi%20yang%20ditawarkan,%20Terima%20Kasih"><i
                            class="fas fa-phone me-2"></i> 022 - 20578810</a>
                    {{-- <a href="" class="mb-3"><i class="fas fa-print me-2"></i> +012 345 67890</a> --}}
                    <div class="d-flex align-items-center mt-2">
                        <a class="btn btn-light btn-md-square me-2" href="https://www.facebook.com/"><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-light btn-md-square me-2" href="https://x.com/home"><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-light btn-md-square me-2" href="https://www.instagram.com/"><i
                                class="fab fa-instagram"></i></a>
                        <a class="btn btn-light btn-md-square me-0" href="https://www.linkedin.com/"><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item-post d-flex flex-column">
                    <h4 class="text-white mb-4">Pelatihan Populer</h4>
                    @foreach ($limitTrainingfooter as $data)
                        <div class="d-flex flex-column mb-3">
                            <p class="text-uppercase text-primary mb-2">{{ $data->nama_training}}</p>
                            <a href="{{ url('pelatihan', $data->id) }}" class="text-body">{!! \Illuminate\Support\Str::limit($data->konten, 40) !!}</a>
                        </div>
                    @endforeach
                    <div class="footer-btn text-start">
                        <a href="{{ route('more') }}" class="btn btn-light rounded-pill px-4">Lihat Semua Pelatihan <i
                                class="fa fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Copyright Start -->
<div class="container-fluid copyright py-4 ">
    <div class="container ">
        <div class="row g-4 align-items-center">
            <div class="col-md-6 text-center text-md-start mb-md-0">
                <span class="text-body"><a href="https://bartechmedia.id/" class="border-bottom text-primary"><i
                            class="fas fa-copyright text-light me-2"></i>Bartech</a>, All right reserved.</span>
            </div>
        </div>
    </div>
</div>


<!-- Copyright End -->
 