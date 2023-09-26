<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ env('APP_NAME'), 'Mi App' }} :. Ahorra Dinero</title>
  <meta content="App de inversiones" name="description">
  <meta content="inversiones" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('img/favicon.ico') }}" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700&display=swap"
      rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="assets/lib/animate/animate.min.css" rel="stylesheet">
  <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
  <!-- Spinner Start -->
  <div id="spinner"
      class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
      <div class="spinner-grow text-primary" role="status"></div>
  </div>
  <!-- Spinner End -->


  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 px-4 px-lg-5">
      <a href="/" class="navbar-brand d-flex align-items-center">
          <h2 class="m-0 text-primary">
          {{-- <img class="img-fluid me-2" src="assets/img/icon-1.png" alt="" style="width: 45px;"> --}}
          Ahorra en tu Crédito</h2>
      </a>
      <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
          <div class="navbar-nav ms-auto py-4 py-lg-0">
              <a href="index.html" class="nav-item nav-link active">Inicio</a>
              <a href="{{ route('login') }}" class="nav-item nav-link">Iniciar Sesión</a>
              <a href="{{ route('register') }}" class="nav-item nav-link">Registrarme</a>
          </div>
      </div>
  </nav>
  <!-- Navbar End -->


  <!-- Header Start -->
  <div class="container-fluid hero-header bg-light py-5 mb-5">
      <div class="container py-5">
          <div class="row g-5 align-items-center">
              <div class="col-lg-6">
                  <h1 class="display-4 mb-3 animated slideInDown">Simulador de creditos para ahorrar tiempo y dinero.
                    </h1>
                  <p class="animated slideindown">Ahorra hasta el 50% de tu credito</p>
                  <a href="{{ route('register') }}" class="btn btn-primary py-3 px-4 animated slideInDown">Credito Hipotecario</a>
                  <a href="{{ route('register') }}" class="btn btn-primary py-3 px-4 animated slideInDown">Credito Automovil</a>
              </div>
              <div class="col-lg-6 animated fadeIn">
                  <img class="img-fluid animated pulse infinite" style="border-radius:25px; animation-duration: 3s;" src="assets/img/ahorra.jpg" alt="Ahorra">
              </div>
          </div>
      </div>
  </div>
  <!-- Header End -->


  <!-- About Start -->
  <div class="container-xxl py-5">
      <div class="container" >
          <div class="row g-5 align-items-center">

        <section class="bg-light py-3 py-md-5 py-xl-8">
        <div class="container">
            <div class="row justify-content-md-center">
            <div class="col-12 col-md-10 col-lg-8">
                <h2 class="mb-4 display-5 text-center">¿Porque ahorratucredito.com debe ser tu mejor aliado?</h2>
                <p class="text-secondary mb-5 text-center lead fs-4">Conoce a nuestro equipo de profesionales.</p>
                <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
            </div>
            </div>
        </div>

        <div class="container overflow-hidden">
            <div class="row gy-4 gy-lg-0 gx-xxl-5">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card border-0 border-bottom border-primary shadow-sm overflow-hidden">
                <div class="card-body p-0">
                    <figure class="m-0 p-0">
                    <img class="img-fluid" loading="lazy" src="./assets/img/team-img-1.jpg" alt="">
                        <figcaption class="m-0 p-4">
                            <blockquote class="blockquote mb-4">
                                <p>
                                    <i class="fas fa-quote-left fa-lg text-warning me-2"></i>
                                    <span class="font-italic">Es una herramienta súper útil para simular
                                    tus abonos a capital y darte cuenta del
                                    tiempo que puedes ahorrar y los intereses
                                    que dejas de pagar. ¡Es genial!.</span>
                                </p>
                                </blockquote>
                                <figcaption class="blockquote-footer">
                                <h4 class="mb-1">Alexander Ramos.</h4>
                                </figcaption>
                        </figcaption>
                    </figure>
                </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card border-0 border-bottom border-primary shadow-sm overflow-hidden">
                <div class="card-body p-0">
                    <figure class="m-0 p-0">
                    <img class="img-fluid" loading="lazy" src="./assets/img/team-img-2.jpg" alt="">
                        <figcaption class="m-0 p-4">
                            <blockquote class="blockquote mb-4">
                                <p>
                                    <i class="fas fa-quote-left fa-lg text-info me-2"></i>
                                    <span class="font-italic">Lo mejor de todo es que esta herramienta
                                    es perfecta para cualquier persona, sin importar
                                    su edad o experiencia financiera.</span>
                                </p>
                                </blockquote>
                                <figcaption class="blockquote-footer">
                                <h4 class="mb-1">Claudia Ramirez.</h4>
                                </figcaption>
                        </figcaption>
                    </figure>
                </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card border-0 border-bottom border-primary shadow-sm overflow-hidden">
                <div class="card-body p-0">
                    <figure class="m-0 p-0">
                    <img class="img-fluid" loading="lazy" src="./assets/img/team-img-3.jpg" alt="">
                        <figcaption class="m-0 p-4">
                            <blockquote class="blockquote mb-4">
                                <p>
                                    <i class="fas fa-quote-left fa-lg text-danger me-2"></i>
                                    <span class="font-italic">La uso desde hace 2 meses y puedo decirles que ha sido una
                                        herramienta invaluable en mi vida financiera.
                                        Me ha permitido visualizar mis metas, ahorrar tiempo y
                                        dinero, y sentirme más seguro en mis decisiones económicas.</span>
                                </p>
                                </blockquote>
                                <figcaption class="blockquote-footer">
                                <h4 class="mb-1">Conica Fonseca.</h4>
                                </figcaption>
                        </figcaption>
                    </figure>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
          </div>
      </div>
  </div>
  <!-- About End -->



  <!-- Footer Start -->
  <div class="container-fluid bg-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
      <div class="container-fluid copyright">
          <div class="container">
              <div class="row">
                  <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                      &copy; <a href="#">Ahorraentucredito.com</a>, All Right Reserved.
                  </div>
                  <div class="col-md-6 text-center text-md-end">
                      <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                      Designed By Sphera</a> Distributed By <a
                          href="https://gutyecuador.github.io/vidiasoftWeb/">Vidiasoft Dev</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Footer End -->


    <div id="whatspopover" style="
        position: fixed;
        width: 60px;
        {{-- height: 60px; --}}
        bottom: 2%;
        right: 10px;
        background-color: #25d366;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        font-size: 30px;
        z-index: 100;


        "
    data-container="body" data-toggle="popover" data-placement="left" data-content="CENTRO DE CONTACTO.">
        <a style="color: white;" href="https://api.whatsapp.com/send?phone=+573203192388&amp;text=Hola! Quisiera más información."  target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </div>

  <!-- Back to Top -->
  {{-- <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top">
  <i class="bi bi-arrow-up"></i></a> --}}


  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/lib/wow/wow.min.js"></script>
  <script src="assets/lib/easing/easing.min.js"></script>
  <script src="assets/lib/waypoints/waypoints.min.js"></script>
  <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="assets/lib/counterup/counterup.min.js"></script>

  <!-- Template Javascript -->
  <script src="assets/js/main.js"></script>
</body>

</html>
