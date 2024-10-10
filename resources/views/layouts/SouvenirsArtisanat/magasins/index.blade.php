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
<section class="store-section section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div style="text-align=center" class=" col-lg-6 col-12 mb-4">
                <h2>Nos Magasins</h2>
                <p><strong>Découvrez nos différents magasins</strong> Explorez nos emplacements et trouvez les meilleures offres et produits locaux dans chaque magasin.</p>
            </div>

            <div class="clearfix"></div>

            @foreach($magasins as $magasin)
            @if($magasin->promotions->isNotEmpty()) <!-- Vérification si le magasin a des promotions -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="job-thumb job-thumb-box">
                    <div class="job-image-box-wrap">
                        <a href="{{ route('layouts.SouvenirsArtisanat.magasins.show', $magasin->id) }}">
                            @if($magasin->image)
                                <img src="{{ asset('storage/' . $magasin->image) }}" class="store-image img-fluid" alt="{{ $magasin->nomMagasin }}">
                            @else
                                <img src="{{ asset('images/placeholder-store.jpg') }}" class="store-image img-fluid" alt="Image placeholder">
                            @endif
                        </a>

                        <div class="job-image-box-wrap-info d-flex align-items-center">
                            <p class="mb-0">
                                <span class="badge badge-level">{{ $magasin->type }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="job-body">
                        <h4 class="job-title">
                            <a href="{{ route('layouts.SouvenirsArtisanat.magasins.show', $magasin->id) }}" class="store-title-link">{{ $magasin->nomMagasin }}</a>
                        </h4>

                        <div class="job-description mb-3">
                            {{ Str::limit($magasin->description, 100) }}
                        </div>

                        <div class="d-flex align-items-center">
                            <p class="job-location">
                                <i class="custom-icon bi-geo-alt me-1"></i>
                                {{ $magasin->adresse }}
                            </p>
                        </div>

                        <div class="job-promotions mb-3">
                            <p class="mb-1"><strong>Promotions en cours :</strong></p>
                            <ul class="list-unstyled">
                                @foreach($magasin->promotions as $promotion)
                                <li><i class="bi bi-tag-fill me-2"></i>{{ $promotion->nom }}</li>
                                @endforeach
                            </ul>
                        </div>

                        @if($magasin->souvenirs->isNotEmpty())
                            <div class="job-souvenirs mb-3">
                                <p class="mb-1"><strong>Nombre de souvenirs disponibles :</strong> {{ $magasin->souvenirs->count() }}</p>
                            </div>
                        @else
                            <div class="job-souvenirs mb-3">
                                <p class="mb-1"><strong>Souvenirs :</strong> Bientôt disponibles</p>
                            </div>
                        @endif

                        <div class="d-flex align-items-center border-top pt-3">
                            <a href="{{ route('layouts.SouvenirsArtisanat.magasins.show', $magasin->id) }}" class="custom-btn btn ms-auto">Voir plus</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif <!-- Fin de la vérification pour les magasins avec promotions -->
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