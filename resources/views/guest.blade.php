<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/assets/logo-ith.bee906d9.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/styles/main.741d8512.css" />
    <title>Home - Digilib ITH</title>
</head>

<body class="min-vh-100 d-flex flex-column">
    @if (Request::is('/'))
        @include('partials.navbar-hero')
    @else
        @include('partials.navbar')
    @endif


    @yield('content')
    <footer class="bg-dark text-bg-dark pt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4 col-sm-6">
                    <h6 class="mb-3">Link Lainnya</h6>
                    <div class="d-flex flex-column gap-2">
                        <a class="link-light link-opacity-75 fw-light" href="https://ith.ac.id/" target="_blank"
                            rel="noopener noreferrer">Institut Teknologo B.J. Habibie</a><a
                            class="link-light link-opacity-75 fw-light" href="/"
                            target="_blank" rel="noopener noreferrer">Perpustakaan ITH</a><a
                            class="link-light link-opacity-75 fw-light" href="https://www.lipsum.com" target="_blank"
                            rel="noopener noreferrer">Link Lainnya</a><a class="link-light link-opacity-75 fw-light"
                            href="https://www.lipsum.com" target="_blank" rel="noopener noreferrer">Link Lainnya
                            Kedua</a><a class="link-light link-opacity-75 fw-light" href="https://www.lipsum.com"
                            target="_blank" rel="noopener noreferrer">Link Lainnya Terakhir</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6 class="mb-3">Kontak</h6>
                    <div class="d-flex flex-column gap-2 text-light text-opacity-75 fw-light">
                        <p class="mb-0">
                            Phone:
                            <a class="link-light link-opacity-75" href="tel:0411092842" target="_blank"
                                rel="noopener noreferrer">0411 092842</a>
                        </p>
                        <p class="mb-0">
                            Whatsapp:
                            <a class="link-light link-opacity-75" href="https://wa.me/6282139292912" target="_blank"
                                rel="noopener noreferrer">+(62) 821 39292912</a>
                        </p>
                        <p class="mb-0">
                            Email:
                            <a class="link-light link-opacity-75" href="mailto:email@ith.ac.id" target="_blank"
                                rel="noopener noreferrer">email@ith.ac.id</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <h6 class="mb-3">Kontak</h6>
                    <div class="d-flex flex-column gap-2 text-light text-opacity-75 fw-light">
                        <p class="mb-0">
                            Jl. Balaikota No.1, Bumi Harapan, Kec. Bacukiki Bar., Kota Parepare, Sulawesi Selatan 91122
                        </p>
                        <iframe class="rounded-2"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1646.731769851677!2d119.63252653922547!3d-4.028660989379977!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d95bbb762bcd13d%3A0x95845218a1ae2419!2sInstitut%20Teknologi%20Bacharuddin%20Jusuf%20Habibie%20(%20ITH%20)%20Kampus%201%20Rektorat!5e0!3m2!1sen!2sid!4v1713331168258!5m2!1sen!2sid"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <hr class="my-4" />
            <div
                class="pb-4 d-flex flex-column flex-sm-row justify-content-sm-between align-items-center gap-2 text-sm-start text-center">
                <p class="mb-0 fw-light">
                    &copy; 2024, Institut Teknologi Bacharuddin Jusuf Habibie
                </p>
                <div class="d-flex gap-1 flex-sm-nowrap flex-wrap justify-content-sm-end justify-content-center">
                    <a class="btn btn-icon link-light" href="https://facebook.com" target="_blank"
                        rel="noopener noreferrer"><i class="bi-facebook"></i></a><a class="btn btn-icon link-light"
                        href="https://instagram.com" target="_blank" rel="noopener noreferrer"><i
                            class="bi-instagram"></i></a><a class="btn btn-icon link-light" href="https://linkedin.com"
                        target="_blank" rel="noopener noreferrer"><i class="bi-linkedin"></i></a><a
                        class="btn btn-icon link-light" href="https://youtube.com" target="_blank"
                        rel="noopener noreferrer"><i class="bi-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <script src="/scripts/main.9c8d564c.js"></script>
</body>

</html>
