<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>
     @yield('title')
  </title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
    crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/homepage2/src/Style.css" />
  <link rel="stylesheet" href="../assets/homepage2/src/mobile-style.css">
  <link href="../assets/css/imagehidder.css" rel="stylesheet" />
  
</head>

<body>
  <header>
    <div class="container-fluid p-0">
      <nav class="navbar navbar-expand-lg sticky"><!--sticky-->
        <a class="navbar-brand" href="/">
         <!--  <i class="fas fa-book-reader fa-2x mx-3"></i> --> <img src="../assets/homepage2/assets/logotype.png" height="20%" width="20%"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
          aria-label="Toggle navigation">
          <i class="fas fa-align-right text-light"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="mr-auto"></div>
          <ul class="navbar-nav">
            <li class="nav-item ">
              <a class="nav-link {{ request()->is('/') ? 'currentitem' : '' }}" href="/" >ACCUEIL
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <div class="dropdown">
                <a href="#" class="nav-link {{ request()->is('liste-demandes') ? 'currentitem' : '' }} {{ request()->is('demande-aide') ? 'currentitem' : '' }}">DEMANDE</a>
                <div class="dropdown-content">
                  <a href="/liste-demandes" class="nav-link">LISTE DES DEMANDES</a>
                  <a href="/demande-aide" class="nav-link">FAIRE UNE DEMANDE</a>
                </div>
              </div>
            </li>
            <li class="nav-item active">
              <a class="nav-link {{ request()->is('liste-articles') ? 'currentitem' : '' }}" href="/liste-articles">ARTICLES</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('a-propos') ? 'currentitem' : '' }}" href="/a-propos" style="white-space: nowrap;"> A-PROPOS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('contact') ? 'currentitem' : '' }}" href="/contact">CONTACT</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
   
    <!-- <div class="container text-center">
      <div class="row">
        <div class="col-md-7 col-sm-12  text-white">
          <h6>AUTHOR: DAILY TUITION</h6>
          <h1>EXCITING ADVENTURE</h1>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere accusamus eum dignissimos ipsa sequi expedita.
          </p>
          <button class="btn btn-light px-5 py-2 primary-btn">
            By now for $5.99
          </button>
        </div>
        <div class="col-md-5 col-sm-12  h-25">
          <img src="../assets/homepage2/assets/africa.png" alt="Book" />
        </div>
      </div>
    </div> -->
  </header>
  <main>
    @yield('content')
  </main>
  <footer>
    <div class="container-fluid p-0">
      <div class="row text-left">
        <div class="col-md-5 col-sm-5">
          <h4 class="text-light">A propos</h4>
          <p class="text-muted">Need-help est asssociation créée par des jeune dynamiques dont les seuls objectifs sont de venir en aide à ceux dans le besoin et de participer au développement de leur pays.Pour plus de détails , consultez notre pages <a style="color: #ff432f" href="/a-propos"> A-propos</a></p>
          <p class="pt-4 text-muted">Copyright ©Need-help 2020  tous droits réservés | ce site a été créé par 
            <span> Ousseynou DJITE (membre de need help)</span>
          </p>
        </div>
        <div class="col-md-5 col-sm-12">
          <h4 class="text-light">Newsletter</h4>
          <p class="text-muted">Abonnez vous à notre newsletter</p>
          <form class="form-inline">
            <div class="col pl-0">
              <div class="input-group pr-5">
                <input type="text" class="form-control bg-dark text-white" id="inlineFormInputGroupUsername2" placeholder="Email">

                <button id="newsletterbtn" style=" border-style: none; background: linear-gradient(to bottom, #dd2476, #ff512f);">s'inscrire</button>
                <div class="input-group-prepend">
                 
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-2 col-sm-12">
          <h4 class="text-light">Suivez nous !</h4>
          <p class="text-muted">Réseaux sociaux</p>
          <div class="column text-light">
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-instagram"></i>
            <i class="fab fa-twitter"></i>
            <i class="fab fa-youtube"></i>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="../assets/homepage2/src/main.js"></script>
   <!-- image hidder js -->
    
    <script type="text/javascript">
      $('#newsletterbtn').click(function(){
       alert('Merci d\'avoir souscrit à notre newsletter');
      });
    </script>
</body>

</html>