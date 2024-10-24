@extends('layouts.app')

@section('content')


<section class="hero-section d-flex justify-content-center align-items-center">
            <div class="section-overlay"></div>

            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                        <div class="hero-section-text mt-5">
                            <h6 class="text-white">Is it possible to enjoy nature and preserve it?</h6>

                            <h1 class="hero-title text-white mt-4 mb-4">Absolutely! <br>We can makes it happen</h1>

                            <a href="#categories-section" class="custom-btn custom-border-btn btn">Browse Categories</a>
                        </div>
                    </div>



                </div>
            </div>
        </section>



<section class="job-section recent-jobs-section section-padding">
    <div class="container">
        <div class="row align-items-center">


        <!-- Section de filtre par magasin -->
<!-- Section de filtre par magasin -->
<form  action="{{ route('layouts.SouvenirsArtisanat.souvenirs.index') }}" method="GET">
    <div class="form-group">
    <div class="col-lg-6 col-12 mb-4">
                <p><strong>Filtrer par magasin</strong></p>
            </div>


        <div class="row">
            @foreach($magasins as $magasin)
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="categories-block">
                        <label class="d-flex flex-column justify-content-center align-items-center h-100">
                            <input type="checkbox" name="magasins[]" value="{{ $magasin->id }}" class="selectgroup-input" />
                            <i class="categories-icon bi-window"></i>
                            <small class="categories-block-title">{{ $magasin->nomMagasin }}</small>
                            <div class="categories-block-number d-flex flex-column justify-content-center align-items-center">
                            <span class="categories-block-number-text">{{ $magasin->souvenirs_count }}</span>
                            </div>
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="d-flex">


        <button type="submit" class="badge badge-level">
            Submit
        </button>

        <p class="mb-0">
                <!-- Bouton pour afficher tous les souvenirs -->
            <a href="{{ route('layouts.SouvenirsArtisanat.souvenirs.index') }}" class="badge">
                <span class="btn-label">
                    <i class="fa fa-archive"></i>
                Default
                </span>
            </a>
        </p>
    </div>

</form>





            <div class="col-lg-6 col-12 mb-4">

            <br/>
            <hr/>
                <h2>All Souvenirs</h2>
                <p><strong>Explorez les souvenirs de tous les magasins</strong></p>
            </div>

            <div class="clearfix"></div>

            @foreach($souvenirs as $souvenir)
            <div class="col-lg-4 col-md-6 col-12">
                <div class="job-thumb job-thumb-box">
                    <div class="job-image-box-wrap">
                        <a href="{{ route('layouts.SouvenirsArtisanat.souvenirs.show', $souvenir->id) }}">
                        <img src="{{ asset('storage/' . $souvenir->image) }}" alt="{{ $souvenir->nom }}">

                        </a>
                        <div class="job-image-box-wrap-info d-flex align-items-center">
                            <p class="mb-0">
                                <span class="badge">{{ $souvenir->magasin->nom }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="job-body">
                        <h4 class="job-title">
                            <a href="{{ route('layouts.SouvenirsArtisanat.souvenirs.show', $souvenir->id) }}" class="job-title-link">{{ $souvenir->nom }}</a>
                        </h4>
                        <p class="job-location mb-0">{{ $souvenir->description }}</p>

                        <div class="d-flex align-items-center border-top pt-3">
                            <p class="job-price mb-0">
                                <i class="custom-icon bi-cash me-1"></i>
                                {{ $souvenir->prix }}€
                            </p>
                            <a href="{{ route('layouts.SouvenirsArtisanat.souvenirs.show', $souvenir->id) }}" class="custom-btn btn ms-auto">Voir Détails</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div> 
    </div> 
</section>

<footer class="site-footer">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="d-flex align-items-center mb-4">
                        <img src="images/logo.png" class="img-fluid logo-image">

                        <div class="d-flex flex-column">
                            <strong class="logo-text">Gotto</strong>
                            <small class="logo-slogan">Online Job Portal</small>
                        </div>
                    </div>

                    <p class="mb-2">
                        <i class="custom-icon bi-globe me-1"></i>

                        <a href="#" class="site-footer-link">
                            www.jobbportal.com
                        </a>
                    </p>

                    <p class="mb-2">
                        <i class="custom-icon bi-telephone me-1"></i>

                        <a href="tel: 305-240-9671" class="site-footer-link">
                            305-240-9671
                        </a>
                    </p>

                    <p>
                        <i class="custom-icon bi-envelope me-1"></i>

                        <a href="mailto:info@yourgmail.com" class="site-footer-link">
                            info@jobportal.co
                        </a>
                    </p>

                </div>

                <div class="col-lg-2 col-md-3 col-6 ms-lg-auto">
                    <h6 class="site-footer-title">Company</h6>

                    <ul class="footer-menu">
                        <li class="footer-menu-item"><a href="#" class="footer-menu-link">About</a></li>

                        <li class="footer-menu-item"><a href="#" class="footer-menu-link">Blog</a></li>

                        <li class="footer-menu-item"><a href="#" class="footer-menu-link">Jobs</a></li>

                        <li class="footer-menu-item"><a href="#" class="footer-menu-link">Contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 col-6">
                    <h6 class="site-footer-title">Resources</h6>

                    <ul class="footer-menu">
                        <li class="footer-menu-item"><a href="#" class="footer-menu-link">Guide</a></li>

                        <li class="footer-menu-item"><a href="#" class="footer-menu-link">How it works</a></li>

                        <li class="footer-menu-item"><a href="#" class="footer-menu-link">Salary Tool</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-8 col-12 mt-3 mt-lg-0">
                    <h6 class="site-footer-title">Newsletter</h6>

                    <form class="custom-form newsletter-form" action="#" method="post" role="form">
                        <h6 class="site-footer-title">Get notified jobs news</h6>

                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="bi-person"></i></span>

                            <input type="text" name="newsletter-name" id="newsletter-name" class="form-control" placeholder="yourname@gmail.com" required>

                            <button type="submit" class="form-control">
                                <i class="bi-send"></i>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <div class="site-footer-bottom">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-12 d-flex align-items-center">
                        <p class="copyright-text">Copyright © Gotto Job 2048</p>

                        <ul class="footer-menu d-flex">
                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Privacy Policy</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Terms</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-5 col-12 mt-2 mt-lg-0">
                        <ul class="social-icon">
                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-twitter"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-facebook"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-linkedin"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-instagram"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-youtube"></a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-12 mt-2 d-flex align-items-center mt-lg-0">
                        <p>Design: <a class="sponsored-link" rel="sponsored" href="https://www.tooplate.com" target="_blank">Tooplate</a></p>
                    </div>

                    <a class="back-top-icon bi-arrow-up smoothscroll d-flex justify-content-center align-items-center" href="#top"></a>

                </div>
            </div>
        </div>
</footer>


@endsection

