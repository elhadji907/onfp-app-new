<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ config('app.name', 'ONFP') }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/siglelogo.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Medicio - v4.9.1
  * Template URL: https://bootstrapmade.com/medicio-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Top Bar ======= -->
    <div id="topbar" class="d-flex align-items-center fixed-top">
        <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
            <div class="align-items-center d-none d-md-flex">
                <i class="bi bi-clock"></i> {{ \Carbon\Carbon::now()->format('d F Y') }}
            </div>
            <div class="d-flex align-items-center">
                <i class="bi bi-phone"></i> Appelez-nous au +221 33 827 92 51
            </div>
        </div>
    </div>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <a href="#" class="logo me-auto"><img src="assets/img/logo_onfp.png" alt="" width="auto"
                    height="auto"></a>
            <!-- Uncomment below if you prefer to use an image logo -->
            <h1 class="logo me-auto"><a href="#">ONFP</a></h1>

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    @if (Route::has('login'))
                    <li class="nav-item">
                      @auth
          
                      <a class="navbar-brand pl-3" href="{{ url('/home') }}">
                         {{--  <img src="{{ asset(Auth::user()->profile->getImage()) }}" class="rounded-circle" width="30px" height="auto"/> --}}
                      </a>
                      
                      @else
                    </li>
                    <li class="nav-item">
                      <a class="nav-link js-scroll-trigger" href="{{ route('login') }}">CONNEXION</a>
                    </li>
                    <li class="nav-item">
                      @if (Route::has('register'))
                      <a class="nav-link js-scroll-trigger" href="{{ route('register') }}">INSCRIPTION</a>
                      @endif
                      @endauth
                    </li>
                    @endif
                    <li><a class="nav-link scrollto " href="#hero">Accueil</a></li>
                    <li><a class="nav-link scrollto" href="#about">A propos</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                    <li><a class="nav-link scrollto" href="#departments">Directions</a></li>
                    <li><a class="nav-link scrollto" href="#doctors">Cibles</a></li>
                    <li class="dropdown"><a href="#"><span>Demandes</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="#">Individuelle</a></li>
                            <li><a href="#">Collective</a></li>
                            <li><a href="#">Prise en charge</a></li>
                            <li class="dropdown"><a href="#"><span>Opérateur</span> <i
                                        class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <li><a href="#">Devenir opérateur</a></li>
                                    <li><a href="#">Renouvellement</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            {{--  <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Make an</span>
                Appointment</a>  --}}

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

            <div class="carousel-inner" role="listbox">

                <!-- Slide 1 -->
                <div class="carousel-item active" style="background-image: url(assets/img/slide/slide-1.jpg)">
                    <div class="container">
                        <h2>Bienvenue à <span>{{ __("l'ONFP") }}</span></h2>
                        <p> {{ __("L'Office national de Formation professionnelle (ONFP) est un établissement public à caractère
                                                                                                                                                                                                                                                                                                                          industriel et commercial (EPIC) créé par la loi n°86-44 du 11 Août 1986,") }}
                        </p>
                        <a href="#about" class="btn-get-started scrollto">Voir plus</a>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item" style="background-image: url(assets/img/slide/slide-2.jpg)">
                    <div class="container">
                        <h2>Bienvenue à <span>{{ __("l'ONFP") }}</span></h2>
                        <p> {{ __("L'Office national de Formation professionnelle (ONFP) est un établissement public à caractère
                                                                                                                                                                                                                                                                                                                        industriel et commercial (EPIC) créé par la loi n°86-44 du 11 Août 1986,") }}
                        </p>
                        <a href="#about" class="btn-get-started scrollto">Voir plus</a>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item" style="background-image: url(assets/img/slide/slide-3.jpg)">
                    <div class="container">
                        <h2>Bienvenue à <span>{{ __("l'ONFP") }}</span></h2>
                        <p> {{ __("L'Office national de Formation professionnelle (ONFP) est un établissement public à caractère
                                                                                                                                                                                                                                                                                                                        industriel et commercial (EPIC) créé par la loi n°86-44 du 11 Août 1986,") }}
                        </p>
                        <a href="#about" class="btn-get-started scrollto">Voir plus</a>
                    </div>
                </div>

            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Featured Services Section ======= -->
        <section id="featured-services" class="featured-services">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                            <div class="icon"><i class="fas fa-heartbeat"></i></div>
                            <h4 class="title"><a href="">Lorem Ipsum</a></h4>
                            <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias
                                excepturi</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                            <div class="icon"><i class="fas fa-pills"></i></div>
                            <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
                            <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon"><i class="fas fa-thermometer"></i></div>
                            <h4 class="title"><a href="">Magni Dolores</a></h4>
                            <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                officia</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon"><i class="fas fa-dna"></i></div>
                            <h4 class="title"><a href="">Nemo Enim</a></h4>
                            <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui
                                blanditiis</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Featured Services Section -->

        <!-- ======= Cta Section ======= -->
        <section id="cta" class="cta">
            <div class="container" data-aos="zoom-in">

                <div class="text-center">
                    <h3>{{ __("Ministère de la formation professionnelle de l'apprentissage et de l'insertion (MFPAI)") }}
                    </h3>
                    <p>
                        {{--  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                        mollit anim id est laborum.  --}}
                    </p>
                    <a class="cta-btn scrollto" href="https://formation.gouv.sn/" target="_blank">Visiter le site du
                        ministère</a>
                </div>

            </div>
        </section><!-- End Cta Section -->

        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>A propos</h2>
                    <p>{{ __("L'Office national de Formation professionnelle (ONFP) est un établissement public à caractère
                                                                                                                                                                                                                                                  industriel et commercial (EPIC) créé par la loi n°86-44 du 11 Août 1986,") }}
                    </p>
                </div>

                <div class="row">
                    <div class="col-lg-4" data-aos="fade-right">
                        <img src="assets/img/ONFP.JPG" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
                        <p class="fst-italic">
                            {{ __('Ainsi, l’ONFP a pour mission dans le cadre des objectifs généraux du plan arrêté par le Gouvernement en matière de formation professionnelle de : ') }}
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle"></i>
                                {{ __('Aider à mettre en œuvre les objectifs sectoriels du gouvernement et d’assister les organismes publics et privés dans la réalisation de leur action;') }}
                            </li>
                            <li><i class="bi bi-check-circle"></i>
                                {{ __('Réaliser des études sur l’emploi, la qualification professionnelle, les moyens quantitatifs et qualitatifs de la formation professionnelle initiale et continue;') }}
                            </li>
                            <li><i class="bi bi-check-circle"></i>
                                {{ __('Coordonner les interventions par branche professionnelle par action prioritaire en s’appuyant sur des structures existantes ou à créer;') }}
                            </li>
                            <li><i class="bi bi-check-circle"></i>
                                {{ __('Coordonner l’action de formation professionnelle des organismes d’aides bilatérales ou multilatérales;') }}
                            </li>

                        </ul>
                    </div>
                    <div class="col-lg-12 pt-4 pt-lg-0 content" data-aos="fade-left">
                        <p class="pt-4">
                            {{ __('Les modalités d’organisation et de fonctionnement de l’ONFP sont fixées par le décret n°87-955 du 21 juillet 1987.') }}
                        </p>
                        <ol type="a">
                            <li>
                                <b>{{ __('Vision') }}</b>
                                <p class="fst-italic">
                                    {{ __('La qualification professionnelle est le levier le plus important pour l’amélioration de la productivité du travail, la réduction de la précarité de l’emploi et le positionnement fort de la formation professionnelle dans les enjeux nationaux.') }}
                                </p>
                            </li>
                            <li class="pt-4">
                                <b>{{ __('Valeurs') }}</b>
                                <p class="fst-italic">
                                    {{ __('Nous portons en nous l’exigence scientifique et technique de la référence nationale en matière de formation professionnelle.') }}
                                </p>
                            </li>
                            <li class="pt-4">
                                <b>{{ __('Mandat') }}</b>
                                <p class="fst-italic">
                                    {{ __('Doter le travailleur ou le demandeur d’emploi, notamment dans une optique d’auto emploi, où qu’il se trouve sur le territoire national, d’une qualification ou d’un titre professionnel qui lui permet, à la fois, d’occuper un emploi ou d’exercer une activité professionnelle selon les normes requises et de se promouvoir.') }}
                                </p>
                            </li>
                        </ol>
                        {{--  <ul>
                            <i class="bi bi-check-circle"></i>
                            {{ __('Recherche et programmation : l’Office est chargé notamment :') }}
                            <li><i
                                    class="bi bi-caret-right"></i>{{ __('d’étudier les problèmes posés par l’adéquation de la formation à l’emploi ;') }}
                            </li>
                            <li><i
                                    class="bi bi-caret-right"></i>{{ __('d’étudier la finalité et le contenu des formations ;') }}
                            </li>
                            <li><i
                                    class="bi bi-caret-right"></i>{{ __('de faire des propositions pour l’élaboration de plans quadriennaux.') }}
                            </li>

                        </ul>  --}}
                        <p>
                        </p>
                    </div>
                </div>

            </div>
        </section><!-- End About Us Section -->

        <!-- ======= Counts Section ======= -->
        {{--  <section id="counts" class="counts">
            <div class="container" data-aos="fade-up">

                <div class="row no-gutters">

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <i class="fas fa-user-md"></i>
                            <span data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="1"
                                class="purecounter"></span>

                            <p><strong>Doctors</strong> consequuntur quae qui deca rode</p>
                            <a href="#">Find out more &raquo;</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <i class="far fa-hospital"></i>
                            <span data-purecounter-start="0" data-purecounter-end="26" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p><strong>Departments</strong> adipisci atque cum quia aut numquam delectus</p>
                            <a href="#">Find out more &raquo;</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <i class="fas fa-flask"></i>
                            <span data-purecounter-start="0" data-purecounter-end="14" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p><strong>Research Lab</strong> aut commodi quaerat. Aliquam ratione</p>
                            <a href="#">Find out more &raquo;</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <i class="fas fa-award"></i>
                            <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p><strong>Awards</strong> rerum asperiores dolor molestiae doloribu</p>
                            <a href="#">Find out more &raquo;</a>
                        </div>
                    </div>

                </div>

            </div>
        </section>  --}}
        <!-- End Counts Section -->

        <!-- ======= Features Section ======= -->
        {{--  <section id="features" class="features">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right">
                        <div class="icon-box mt-5 mt-lg-0">
                            <i class="bx bx-receipt"></i>
                            <h4>Est labore ad</h4>
                            <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                        </div>
                        <div class="icon-box mt-5">
                            <i class="bx bx-cube-alt"></i>
                            <h4>Harum esse qui</h4>
                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                        </div>
                        <div class="icon-box mt-5">
                            <i class="bx bx-images"></i>
                            <h4>Aut occaecati</h4>
                            <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
                        </div>
                        <div class="icon-box mt-5">
                            <i class="bx bx-shield"></i>
                            <h4>Beatae veritatis</h4>
                            <p>Expedita veritatis consequuntur nihil tempore laudantium vitae denat pacta</p>
                        </div>
                    </div>
                    <div class="image col-lg-6 order-1 order-lg-2"
                        style='background-image: url("assets/img/features.jpg");' data-aos="zoom-in"></div>
                </div>

            </div>
        </section>  --}}
        <!-- End Features Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services services">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Services</h2>
                    {{--  <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                        sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                        ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>  --}}
                </div>

                <div class="col-lg-12 pt-4 pt-lg-0 content" data-aos="fade-left">
                    <b>{{ __('Formation') }}</b>
                    <p class="fst-italic">
                        {{ __('C’est l’organisation d’actions et d’opérations de formation au bénéfice de cibles diversifiées pouvant être les branches professionnelles, les demandeurs d’emploi, les travailleurs, les entreprises, les collectivités, les organismes de l’état, etc. Ces formations s’inscrivent dans une perspective d’obtention d’une qualification professionnelle au regard des catégories professionnelles des conventions collectives de branches professionnelles. Ces formations de type modulaire sont sanctionnées par des attestations, des titres de qualification ou des titres professionnels. L’obtention de ces titres peut se faire par la voie de la Validation des Acquis de l’Expérience (VAE).') }}
                    </p>
                    <b>{{ __('Documentation / Edition') }}</b>
                    <p class="fst-italic">
                        {{ __('L’ONFP produit et diffuse de la documentation et des supports techniques et pédagogiques sur la formation professionnelle. Il s’agit de la mise à la disposition du public de la documentation avec accès libre ou conditionné sous format physique ou électronique. Il s’agit également de l’édition et de la distribution de manuels et supports pédagogiques destinés aux apprenants ou hommes de métier en exercice.
                                                L’ONFP offre la possibilité à des auteurs de faire éditer leur ouvrage dès lors que ceux-ci traitent des questions liées à la formation professionnelle.
                                                ') }}
                    </p>
                    <p class="fst-italic">
                        {{ __('A ce jour, 28 titres ont été édités dans les filières suivantes :') }}
                    </p>
                    <ol>
                        <li>Agroalimentaire</li>
                        <li>Cuisine </li>
                        <li>Horticulture </li>
                        <li>Teinture </li>
                        <li>Plomberie</li>
                        <li>Menuiserie bois</li>
                        <li>Menuiserie métallique</li>
                        <li>Maçonnerie </li>
                        <li>Couture</li>
                        <li>Mécanique auto</li>
                        <li>Génie civil</li>
                        <li>Froid et climatisation</li>
                        <li>Maintenance industrielle</li>
                        <li>Coiffure </li>
                    </ol>

                    <b>{{ __('Construction') }}</b>
                    <p class="fst-italic">
                        {{ __('Ce service consiste à la maitrise d’ouvrage de construction de centres de formation professionnelle ou la maitrise d’ouvrage déléguée à la demande de ministères, d’organismes, de projets nationaux, de coopération ou à la demande d’organismes privés telles que les branches, les ONG, les associations et les entreprises.') }}
                    </p>

                    <ol>
                        <li>
                            <p class="fst-italic">
                                {{ __('Chantiers déjà réalisés') }}
                            </p>
                        </li>
                        <ol type="a">
                            <li>Fonds propres :</li>
                            <ul>
                                <li>Réhabilitation du CRF de Sédhiou;</li>
                                <li>Construction de l’antenne régionale de l’ONFP de Saint-Louis;</li>
                            </ul>
                            <li>Projet FPEC :</li>
                            <ul>
                                <li>Réhabilitation des lycées LTID, LTAP et de Kédougou;</li>
                            </ul>
                            <li>BCI MOD MEFPA :</li>
                            <ul>
                                <li>Construction des centres de formation de Sokone, Porokhane et koungheul</li>
                            </ul>
                        </ol>
                        <li>
                            <p class="fst-italic">
                                {{ __('Chantiers en cours de réalisation') }}
                            </p>
                        </li>
                        <ol type="a">
                            <li>Projet FPEC :</li>
                            <ul>
                                <li>Construction des centres de formation en tourisme de Diamniadio, Saint-Louis et
                                    Ziguinchor ;</li>
                                <li>Construction du centre en aviculture de Diamniadio ;</li>
                                <li>Construction des centres horticoles de Thieppe et Nétéboulou</li>
                            </ul>
                            <li>BCI MOD MEFPA :</li>
                            <ul>
                                <li>Construction des centres de formation de Goudomp, Foundiougne, Ndangalma, Aéré Lao
                                    et Ndouloumadji</li>
                            </ul>
                        </ol>
                    </ol>

                    <b>{{ __('Recherche') }}</b>
                    <p class="fst-italic">
                        {{ __('Il s’agit de la production ou de la diffusion de connaissances et de savoirs sur la formation professionnelle. Ceci se traduit par l’appui à des thèses ou des mémoires portant sur des sujets en lien avec les problématiques de la formation professionnelle. La recherche est également la mise en œuvre d’études, de mise au point de méthodes et d’expérimentation de moyens et équipements pédagogiques. Les résultats de recherche sont destinés notamment à alimenter les politiques publiques et les programmes des branches professionnelles.') }}
                    </p>
                </div>



                <div class="row">
                    {{--  <div class="col-lg-12 col-md-12 icon-box" data-aos="zoom-in" data-aos-delay="100">
                        <h4 class="title"><a href="">Formation</a></h4>
                        <p class="description">
                            {{ "C’est l’organisation d’actions et d’opérations de formation au bénéfice de cibles diversifiées pouvant être les branches professionnelles,les demandeurs d’emploi, les travailleurs, les entreprises, les collectivités, les organismes de l’état, etc.
                                                                                                                                                                                                                                                                                                                                              Ces formations s’inscrivent dans une perspective d’obtention d’une qualification professionnelle au regard des catégories professionnelles 
                                                                                                                                                                                                                                                                                                                                              des conventions collectives de branches professionnelles. Ces formations de type modulaire sont sanctionnées par des attestations,
                                                                                                                                                                                                                                                                                                                                               des titres de qualification ou des titres professionnels. L’obtention de ces titres peut se faire par la voie de la Validation des Acquis de l’Expérience (VAE)." }}
                        </p>
                    </div>
                    <div class="col-lg-12 col-md-12 icon-box" data-aos="zoom-in" data-aos-delay="200">
                        <h4 class="title"><a href="">Documentation / Edition</a></h4>
                        <p class="description">
                            {{ "L’ONFP produit et diffuse de la documentation et des supports techniques et pédagogiques sur la formation professionnelle.
                                                                                                                                                                                                                                                                                                                                              Il s’agit de la mise à la disposition du public de la documentation avec accès libre ou conditionné sous format physique ou électronique. 
                                                                                                                                                                                                                                                                                                                                              Il s’agit également de l’édition et de la distribution de manuels et supports pédagogiques destinés aux apprenants ou hommes de métier en exercice.
                                                                                                                                                                                                                                                                                                                                                L’ONFP offre la possibilité à des auteurs de faire éditer leur ouvrage dès lors que ceux ci traitent des questions liées à la formation professionnelle." }}
                        </p>
                        <p class="pt-2">
                            A ce jour, 28 titres ont été édités dans les filières suivantes :
                        <ul>
                            <li type="circle">
                                Agroalimentaire
                            </li>
                        </ul>
                        </p>

                    </div>
                    <div class="col-lg-12 col-md-12 icon-box" data-aos="zoom-in" data-aos-delay="300">
                        <h4 class="title"><a href="">Construction</a></h4>
                        <p class="description">
                            {{ "Ce service consiste à la maitrise d’ouvrage de construction de centres de formation professionnelle ou la maitrise d’ouvrage déléguée
                                                                                                                                                                                                                                                                                                                                              à la demande de ministères, d’organismes, de projets nationaux, de coopération ou à la demande d’organismes privés tels que les branches, les ONG, 
                                                                                                                                                                                                                                                                                                                                              les associations et les entreprises." }}
                        </p>
                    </div>
                    <div class="col-lg-12 col-md-12 icon-box" data-aos="zoom-in" data-aos-delay="100">
                        <h4 class="title"><a href="">Recherche</a></h4>
                        <p class="description">
                            {{ "Il s’agit de la production ou de la diffusion de connaissances et de savoirs sur la formation professionnelle.
                                                                                                                                                                                                                                                                                                                                              Ceci se traduit par l’appui à des thèses ou des mémoires portant sur des sujets en lien avec les problématiques de la formation professionnelle. 
                                                                                                                                                                                                                                                                                                                                              Il s’agit également de mise en oeuvre d’études, de mise au point de méthodes et d’expérimentation de moyens et équipements pédagogiques. 
                                                                                                                                                                                                                                                                                                                                              Les résultats de recherche sont destinés notamment à alimenter les politiques publiques et les programmes des branches professionnelles." }}
                        </p>
                    </div>  --}}
                    {{--    <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon"><i class="fas fa-wheelchair"></i></div>
                        <h4 class="title"><a href="">Nemo Enim</a></h4>
                        <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui
                            blanditiis praesentium voluptatum deleniti atque</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="300">
                        <div class="icon"><i class="fas fa-notes-medical"></i></div>
                        <h4 class="title"><a href="">Eiusmod Tempor</a></h4>
                        <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero
                            tempore, cum soluta nobis est eligendi</p>
                    </div>  --}}
                </div>

            </div>
        </section><!-- End Cibles Section -->
        <!-- ======= Cibless Section ======= -->
        <section id="doctors" class="doctors doctors">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Cibles</h2>
                    {{--  <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                        sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                        ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>  --}}
                </div>

                <div class="col-lg-12 pt-4 pt-lg-0 content" data-aos="fade-left">
                    <ul>
                        <li> {{ __("Les travailleurs de tous secteurs (public, privé, moderne, informel, monde rural, artisanat, etc.) ;")}}</li>
                        <li> {{ __("Les individus ou groupe d’individus (en particulier les jeunes et les femmes) à la recherche d’un emploi ou porteurs de projets d’insertion ;")}}</li>
                        <li> {{ __("Les entreprises de tous secteurs ;")}}</li>
                        <li> {{ __("Les formateurs ;")}}</li>
                        <li> {{ __("Les groupements féminins ;")}}</li>
                        <li> {{ __("Les Groupements d’intérêt Economique (GIE) ;")}}</li>
                        <li> {{ __("Les associations et ONG ;")}}</li>
                        <li> {{ __("Les organisations professionnelles ;")}}</li>
                        <li> {{ __("L’Etat et les collectivités locales ;")}}</li>
                        <li> {{ __("Les chambres consulaires ;")}}</li>
                        <li> {{ __("Les organisations de travailleurs ;")}}</li>
                        <li> {{ __("Les partenaires internationaux intervenant dans le secteur de la formation professionnelle ou qualifiante dans le cadre de l’exécution de leurs programmes spécifiques ;")}}</li>
                        <li> {{ __("Les chercheurs dans le domaine de la formation et de l’insertion professionnelle ;")}}</li>
                        <li> {{ __("Les programmes d’investissements économiques et de promotion de l’emploi.")}}</li>
                        
                    </ul>
                </div>



                <div class="row">
                    {{--  <div class="col-lg-12 col-md-12 icon-box" data-aos="zoom-in" data-aos-delay="100">
                        <h4 class="title"><a href="">Formation</a></h4>
                        <p class="description">
                            {{ "C’est l’organisation d’actions et d’opérations de formation au bénéfice de cibles diversifiées pouvant être les branches professionnelles,les demandeurs d’emploi, les travailleurs, les entreprises, les collectivités, les organismes de l’état, etc.
                                                                                                                                                                                                                                                                                                                                              Ces formations s’inscrivent dans une perspective d’obtention d’une qualification professionnelle au regard des catégories professionnelles 
                                                                                                                                                                                                                                                                                                                                              des conventions collectives de branches professionnelles. Ces formations de type modulaire sont sanctionnées par des attestations,
                                                                                                                                                                                                                                                                                                                                               des titres de qualification ou des titres professionnels. L’obtention de ces titres peut se faire par la voie de la Validation des Acquis de l’Expérience (VAE)." }}
                        </p>
                    </div>
                    <div class="col-lg-12 col-md-12 icon-box" data-aos="zoom-in" data-aos-delay="200">
                        <h4 class="title"><a href="">Documentation / Edition</a></h4>
                        <p class="description">
                            {{ "L’ONFP produit et diffuse de la documentation et des supports techniques et pédagogiques sur la formation professionnelle.
                                                                                                                                                                                                                                                                                                                                              Il s’agit de la mise à la disposition du public de la documentation avec accès libre ou conditionné sous format physique ou électronique. 
                                                                                                                                                                                                                                                                                                                                              Il s’agit également de l’édition et de la distribution de manuels et supports pédagogiques destinés aux apprenants ou hommes de métier en exercice.
                                                                                                                                                                                                                                                                                                                                                L’ONFP offre la possibilité à des auteurs de faire éditer leur ouvrage dès lors que ceux ci traitent des questions liées à la formation professionnelle." }}
                        </p>
                        <p class="pt-2">
                            A ce jour, 28 titres ont été édités dans les filières suivantes :
                        <ul>
                            <li type="circle">
                                Agroalimentaire
                            </li>
                        </ul>
                        </p>

                    </div>
                    <div class="col-lg-12 col-md-12 icon-box" data-aos="zoom-in" data-aos-delay="300">
                        <h4 class="title"><a href="">Construction</a></h4>
                        <p class="description">
                            {{ "Ce service consiste à la maitrise d’ouvrage de construction de centres de formation professionnelle ou la maitrise d’ouvrage déléguée
                                                                                                                                                                                                                                                                                                                                              à la demande de ministères, d’organismes, de projets nationaux, de coopération ou à la demande d’organismes privés tels que les branches, les ONG, 
                                                                                                                                                                                                                                                                                                                                              les associations et les entreprises." }}
                        </p>
                    </div>
                    <div class="col-lg-12 col-md-12 icon-box" data-aos="zoom-in" data-aos-delay="100">
                        <h4 class="title"><a href="">Recherche</a></h4>
                        <p class="description">
                            {{ "Il s’agit de la production ou de la diffusion de connaissances et de savoirs sur la formation professionnelle.
                                                                                                                                                                                                                                                                                                                                              Ceci se traduit par l’appui à des thèses ou des mémoires portant sur des sujets en lien avec les problématiques de la formation professionnelle. 
                                                                                                                                                                                                                                                                                                                                              Il s’agit également de mise en oeuvre d’études, de mise au point de méthodes et d’expérimentation de moyens et équipements pédagogiques. 
                                                                                                                                                                                                                                                                                                                                              Les résultats de recherche sont destinés notamment à alimenter les politiques publiques et les programmes des branches professionnelles." }}
                        </p>
                    </div>  --}}
                    {{--    <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon"><i class="fas fa-wheelchair"></i></div>
                        <h4 class="title"><a href="">Nemo Enim</a></h4>
                        <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui
                            blanditiis praesentium voluptatum deleniti atque</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="300">
                        <div class="icon"><i class="fas fa-notes-medical"></i></div>
                        <h4 class="title"><a href="">Eiusmod Tempor</a></h4>
                        <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero
                            tempore, cum soluta nobis est eligendi</p>
                    </div>  --}}
                </div>

            </div>
        </section><!-- End Services Section -->

        <!-- ======= Appointment Section ======= -->
        {{--  <section id="appointment" class="appointment section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Make an Appointment</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                        sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                        ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <form action="forms/appointment.php" method="post" role="form" class="php-email-form"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Your Name" required>
                        </div>
                        <div class="col-md-4 form-group mt-3 mt-md-0">
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Your Email" required>
                        </div>
                        <div class="col-md-4 form-group mt-3 mt-md-0">
                            <input type="tel" class="form-control" name="phone" id="phone"
                                placeholder="Your Phone" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group mt-3">
                            <input type="datetime" name="date" class="form-control datepicker" id="date"
                                placeholder="Appointment Date" required>
                        </div>
                        <div class="col-md-4 form-group mt-3">
                            <select name="department" id="department" class="form-select">
                                <option value="">Select Department</option>
                                <option value="Department 1">Department 1</option>
                                <option value="Department 2">Department 2</option>
                                <option value="Department 3">Department 3</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group mt-3">
                            <select name="doctor" id="doctor" class="form-select">
                                <option value="">Select Doctor</option>
                                <option value="Doctor 1">Doctor 1</option>
                                <option value="Doctor 2">Doctor 2</option>
                                <option value="Doctor 3">Doctor 3</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
                    </div>
                    <div class="my-3">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
                    </div>
                    <div class="text-center"><button type="submit">Make an Appointment</button></div>
                </form>

            </div>
        </section>  --}}
        <!-- End Appointment Section -->

        <!-- ======= Departments Section ======= -->
        {{--  <section id="departments" class="departments">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Departments</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                        sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                        ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <ul class="nav nav-tabs flex-column">
                            <li class="nav-item">
                                <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-1">
                                    <h4>Cardiology</h4>
                                    <p>Quis excepturi porro totam sint earum quo nulla perspiciatis eius.</p>
                                </a>
                            </li>
                            <li class="nav-item mt-2">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-2">
                                    <h4>Neurology</h4>
                                    <p>Voluptas vel esse repudiandae quo excepturi.</p>
                                </a>
                            </li>
                            <li class="nav-item mt-2">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-3">
                                    <h4>Hepatology</h4>
                                    <p>Velit veniam ipsa sit nihil blanditiis mollitia natus.</p>
                                </a>
                            </li>
                            <li class="nav-item mt-2">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-4">
                                    <h4>Pediatrics</h4>
                                    <p>Ratione hic sapiente nostrum doloremque illum nulla praesentium id</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-8">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tab-1">
                                <h3>Cardiology</h3>
                                <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde
                                    sonata raqer a videna mareta paulona marka</p>
                                <img src="assets/img/departments-1.jpg" alt="" class="img-fluid">
                                <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos
                                    ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima
                                    eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique
                                    accusamus nostrum rem vero</p>
                            </div>
                            <div class="tab-pane" id="tab-2">
                                <h3>Neurology</h3>
                                <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde
                                    sonata raqer a videna mareta paulona marka</p>
                                <img src="assets/img/departments-2.jpg" alt="" class="img-fluid">
                                <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos
                                    ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima
                                    eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique
                                    accusamus nostrum rem vero</p>
                            </div>
                            <div class="tab-pane" id="tab-3">
                                <h3>Hepatology</h3>
                                <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde
                                    sonata raqer a videna mareta paulona marka</p>
                                <img src="assets/img/departments-3.jpg" alt="" class="img-fluid">
                                <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos
                                    ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima
                                    eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique
                                    accusamus nostrum rem vero</p>
                            </div>
                            <div class="tab-pane" id="tab-4">
                                <h3>Pediatrics</h3>
                                <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde
                                    sonata raqer a videna mareta paulona marka</p>
                                <img src="assets/img/departments-4.jpg" alt="" class="img-fluid">
                                <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos
                                    ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima
                                    eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique
                                    accusamus nostrum rem vero</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>  --}}
        <!-- End Departments Section -->

        <!-- ======= Testimonials Section ======= -->
        {{--  <section id="testimonials" class="testimonials">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Testimonials</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                        sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                        ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit
                                    rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam,
                                    risus at semper.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                                <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img"
                                    alt="">
                                <h3>Saul Goodman</h3>
                                <h4>Ceo &amp; Founder</h4>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid
                                    cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet
                                    legam anim culpa.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                                <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img"
                                    alt="">
                                <h3>Sara Wilsson</h3>
                                <h4>Designer</h4>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem
                                    veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint
                                    minim.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                                <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img"
                                    alt="">
                                <h3>Jena Karlis</h3>
                                <h4>Store Owner</h4>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim
                                    fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem
                                    dolore labore illum veniam.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                                <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img"
                                    alt="">
                                <h3>Matt Brandon</h3>
                                <h4>Freelancer</h4>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster
                                    veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam
                                    culpa fore nisi cillum quid.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                                <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img"
                                    alt="">
                                <h3>John Larson</h3>
                                <h4>Entrepreneur</h4>
                            </div>
                        </div><!-- End testimonial item -->

                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section>  --}}
        <!-- End Testimonials Section -->

        <!-- ======= Doctors Section ======= -->
        {{--  <section id="doctors" class="doctors section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Doctors</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                        sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                        ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="row">

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="member" data-aos="fade-up" data-aos-delay="100">
                            <div class="member-img">
                                <img src="assets/img/doctors/doctors-1.jpg" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Walter White</h4>
                                <span>Chief Medical Officer</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="member" data-aos="fade-up" data-aos-delay="200">
                            <div class="member-img">
                                <img src="assets/img/doctors/doctors-2.jpg" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Sarah Jhonson</h4>
                                <span>Anesthesiologist</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="member" data-aos="fade-up" data-aos-delay="300">
                            <div class="member-img">
                                <img src="assets/img/doctors/doctors-3.jpg" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>William Anderson</h4>
                                <span>Cardiology</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="member" data-aos="fade-up" data-aos-delay="400">
                            <div class="member-img">
                                <img src="assets/img/doctors/doctors-4.jpg" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Amanda Jepson</h4>
                                <span>Neurosurgeon</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>  --}}
        <!-- End Doctors Section -->

        <!-- ======= Gallery Section ======= -->
        {{--  <section id="gallery" class="gallery">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Gallery</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                        sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                        ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="gallery-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><a class="gallery-lightbox"
                                href="assets/img/gallery/gallery-1.jpg"><img src="assets/img/gallery/gallery-1.jpg"
                                    class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="gallery-lightbox"
                                href="assets/img/gallery/gallery-2.jpg"><img src="assets/img/gallery/gallery-2.jpg"
                                    class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="gallery-lightbox"
                                href="assets/img/gallery/gallery-3.jpg"><img src="assets/img/gallery/gallery-3.jpg"
                                    class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="gallery-lightbox"
                                href="assets/img/gallery/gallery-4.jpg"><img src="assets/img/gallery/gallery-4.jpg"
                                    class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="gallery-lightbox"
                                href="assets/img/gallery/gallery-5.jpg"><img src="assets/img/gallery/gallery-5.jpg"
                                    class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="gallery-lightbox"
                                href="assets/img/gallery/gallery-6.jpg"><img src="assets/img/gallery/gallery-6.jpg"
                                    class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="gallery-lightbox"
                                href="assets/img/gallery/gallery-7.jpg"><img src="assets/img/gallery/gallery-7.jpg"
                                    class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="gallery-lightbox"
                                href="assets/img/gallery/gallery-8.jpg"><img src="assets/img/gallery/gallery-8.jpg"
                                    class="img-fluid" alt=""></a></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section>  --}}
        <!-- End Gallery Section -->

        <!-- ======= Pricing Section ======= -->
        {{--  <section id="pricing" class="pricing">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Pricing</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                        sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                        ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="row">

                    <div class="col-lg-3 col-md-6">
                        <div class="box" data-aos="fade-up" data-aos-delay="100">
                            <h3>Free</h3>
                            <h4><sup>$</sup>0<span> / month</span></h4>
                            <ul>
                                <li>Aida dere</li>
                                <li>Nec feugiat nisl</li>
                                <li>Nulla at volutpat dola</li>
                                <li class="na">Pharetra massa</li>
                                <li class="na">Massa ultricies mi</li>
                            </ul>
                            <div class="btn-wrap">
                                <a href="#" class="btn-buy">Buy Now</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-4 mt-md-0">
                        <div class="box featured" data-aos="fade-up" data-aos-delay="200">
                            <h3>Business</h3>
                            <h4><sup>$</sup>19<span> / month</span></h4>
                            <ul>
                                <li>Aida dere</li>
                                <li>Nec feugiat nisl</li>
                                <li>Nulla at volutpat dola</li>
                                <li>Pharetra massa</li>
                                <li class="na">Massa ultricies mi</li>
                            </ul>
                            <div class="btn-wrap">
                                <a href="#" class="btn-buy">Buy Now</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                        <div class="box" data-aos="fade-up" data-aos-delay="300">
                            <h3>Developer</h3>
                            <h4><sup>$</sup>29<span> / month</span></h4>
                            <ul>
                                <li>Aida dere</li>
                                <li>Nec feugiat nisl</li>
                                <li>Nulla at volutpat dola</li>
                                <li>Pharetra massa</li>
                                <li>Massa ultricies mi</li>
                            </ul>
                            <div class="btn-wrap">
                                <a href="#" class="btn-buy">Buy Now</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                        <div class="box" data-aos="fade-up" data-aos-delay="400">
                            <span class="advanced">Advanced</span>
                            <h3>Ultimate</h3>
                            <h4><sup>$</sup>49<span> / month</span></h4>
                            <ul>
                                <li>Aida dere</li>
                                <li>Nec feugiat nisl</li>
                                <li>Nulla at volutpat dola</li>
                                <li>Pharetra massa</li>
                                <li>Massa ultricies mi</li>
                            </ul>
                            <div class="btn-wrap">
                                <a href="#" class="btn-buy">Buy Now</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>  --}}
        <!-- End Pricing Section -->

        <!-- ======= Frequently Asked Questioins Section ======= -->
        {{--  <section id="faq" class="faq section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Frequently Asked Questioins</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                        sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                        ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <ul class="faq-list">

                    <li>
                        <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">Non consectetur a
                            erat nam at lectus urna duis? <i class="bi bi-chevron-down icon-show"></i><i
                                class="bi bi-chevron-up icon-close"></i></div>
                        <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non
                                curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus
                                non.
                            </p>
                        </div>
                    </li>

                    <li>
                        <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">Feugiat scelerisque
                            varius morbi enim nunc faucibus a pellentesque? <i
                                class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i>
                        </div>
                        <div id="faq2" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum
                                velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec
                                pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus
                                turpis massa tincidunt dui.
                            </p>
                        </div>
                    </li>

                    <li>
                        <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">Dolor sit amet
                            consectetur adipiscing elit pellentesque habitant morbi? <i
                                class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i>
                        </div>
                        <div id="faq3" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus
                                pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum
                                tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna
                                molestie at elementum eu facilisis sed odio morbi quis
                            </p>
                        </div>
                    </li>

                    <li>
                        <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">Ac odio tempor orci
                            dapibus. Aliquam eleifend mi in nulla? <i class="bi bi-chevron-down icon-show"></i><i
                                class="bi bi-chevron-up icon-close"></i></div>
                        <div id="faq4" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum
                                velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec
                                pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus
                                turpis massa tincidunt dui.
                            </p>
                        </div>
                    </li>

                    <li>
                        <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">Tempus quam
                            pellentesque nec nam aliquam sem et tortor consequat? <i
                                class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i>
                        </div>
                        <div id="faq5" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est
                                ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit
                                adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
                            </p>
                        </div>
                    </li>

                    <li>
                        <div data-bs-toggle="collapse" href="#faq6" class="collapsed question">Tortor vitae purus
                            faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i
                                class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i>
                        </div>
                        <div id="faq6" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo
                                integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc
                                eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque.
                                Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus.
                                Nibh tellus molestie nunc non blandit massa enim nec.
                            </p>
                        </div>
                    </li>

                </ul>

            </div>
        </section>  --}}
        <!-- End Frequently Asked Questioins Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">

                <div class="section-title">
                    <h2>Contact</h2>
                    <p></p>
                </div>

            </div>

            <div>
                <iframe style="border:0; width: 100%; height: 350px;"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3858.517956635953!2d-17.47048068522404!3d14.739823989713924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xec10d5aafda1357%3A0xe11853e0c04fd69c!2sOffice%20National%20de%20Formation%20Professionnelle%20(ONFP%20S%C3%A9n%C3%A9gal)!5e0!3m2!1sfr!2ssn!4v1672740576674!5m2!1sfr!2ssn"
                    frameborder="0" allowfullscreen></iframe>
            </div>

            <div class="container">

                <div class="row mt-5">

                    <div class="col-lg-6">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="info-box">
                                    <i class="bx bx-map"></i>
                                    <h3>Notre adresse</h3>
                                    <p>SIPRES 1, lot 2 – 2 Voies Liberté 6 extension VDN</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box mt-4">
                                    <i class="bx bx-envelope"></i>
                                    <h3>Envoyez-nous un e-mail</h3>
                                    <p>onfp@onfp.sn<br>onfp@onfp.sn</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box mt-4">
                                    <i class="bx bx-phone-call"></i>
                                    <h3>Appelez-nous</h3>
                                    <p>+221 33 827 92 51<br>+ 221 77 291 18 38</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Votre nom" required="">
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Votre adresse e-mail" required="">
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="subject" id="subject"
                                    placeholder="Objet" required="">
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="message" rows="7" placeholder="Message" required=""></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Chargement</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Votre message a été envoyé. Merci !</div>
                            </div>
                            <div class="text-center"><button type="submit">Envoyer un message</button></div>
                        </form>
                    </div>

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-2 col-md-6">
                        <div class="footer-info">
                            <h3>Antenne de Kolda</h3>
                            <p>
                                SIKILO, lot n° 349<br><br>
                                <strong>Phone:</strong> +221 33 996 22 60<br>
                                <strong>Email:</strong> onfp@onfp.sn<br>
                            </p>
                            {{--  <div class="social-links mt-3">
                                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                            </div>  --}}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-info">
                            <h3>Antenne de Saint Louis</h3>
                            <p>
                                Avenue des Grands Hommes, Djoloffène villa n° 860<br><br>
                                <strong>Phone:</strong> +221 33 961 62 29<br>
                                <strong>Email:</strong> onfp@onfp.sn<br>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-info">
                            <h3>Antenne de Matam</h3>
                            <p>
                                Villa n° 553 Bis Quartier Alwar (Gourel Serigne)<br><br>
                                <strong>Phone:</strong> +221 33 523 94 93<br>
                                <strong>Email:</strong> onfp@onfp.sn<br>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-info">
                            <h3>Antenne de Kédougou</h3>
                            <p>
                                Villa n°689 Quartier Dande-Mayo<br><br>
                                <strong>Phone:</strong> +221 33 897 75 86<br>
                                <strong>Email:</strong> onfp@onfp.sn<br>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-info">
                            <h3>Antenne de Kaolack</h3>
                            <p>
                                KASNACK, lot n° 409/B<br><br>
                                <strong>Phone:</strong> +221 33 941 65 05<br>
                                <strong>Email:</strong> onfp@onfp.sn<br>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-info">
                            <h3>Antenne de Diourbel</h3>
                            <p>
                                KASNACK, lot n° 409/B<br><br>
                                <strong>Phone:</strong> +221 33 941 65 05<br>
                                <strong>Email:</strong> onfp@onfp.sn<br>
                            </p>
                        </div>
                    </div>

                    {{--  <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                        </ul>
                    </div>  --}}

                    {{--  <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Our Newsletter</h4>
                        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Subscribe">
                        </form>

                    </div>  --}}

                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Service informatique</span></strong>{{--  . All Rights Reserved  --}}
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medicio-free-bootstrap-theme/ -->
                {{--  Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>  --}}
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
