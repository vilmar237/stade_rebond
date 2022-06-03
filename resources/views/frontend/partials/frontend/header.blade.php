<!-- Header start -->

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<header data-spy="affix" data-offset-top="39" data-offset-bottom="0" class="large affix-top">

  <div class="row container box">
      <div class="col-md-5">
          <!-- Logo start -->
          <div class="brand">
              <h1><a class="scroll-to" href="#top"><img class="img-responsive2" src="{{url('/frontend/img/logo1.png')}}" alt="Rebond"></a></h1>
          </div>
          <!-- Logo end -->
      </div>

      <div class="col-md-7">

    
          {{-- 
            ancienne position 
            <div class="pull-right">
              <div class="header-info pull-right">
                  <div class="contact pull-left">CONTACT: (237) 699999999
                   <p> </p> <a href="locale/en">English</a>
                    <a href="locale/fr">Francais</a>
                  </div>
                  <!-- Language Switch start -->
                 
                  <!-- Language Switch end -->
              </div>
          </div> --}}

          <div class="clearfix">CONTACT: (237) 692 257 2377
            <p> </p> <a href="/locale/en">English</a>
             <a href="/locale/fr">Francais</a></div>

          <!-- start navigation -->
          <nav class="navbar navbar-default" role="navigation">
              <div class="container-fluid">
                  <!-- Toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand scroll-to" href="#top"><img src={{url('/frontend/img/logo1.png')}}  class="img-responsive2" alt="Rebond"></a>
                  </div>
                  <!-- Collect the nav links, for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <!-- Nav-Links start -->
                      <ul class="nav navbar-nav navbar-right">
                          <li class="active"><a href="{{route('welcome')}}" class="scroll-to">{{__('Accueil')}}</a></li>
                          <li><a href="#services" class="scroll-to">{{__('Services')}}</a></li>
                          @if(!Auth::guest() && (Auth::user()->role == "C" || Auth::user()->role == "D"))
                          <li><a href="{{url('forum')}}" class="scroll-to">Forum</a></li>
                          <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{Auth::user()->username}} <span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="{{ route('frontend.booking_history',Auth::user()->id) }}">Historique des réservations</a></li>
                                  <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a></li>
                              </ul>
                          </li>
                          <form id="logout-form" action="{{ url('user-logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            </form>
                            
                          @else
                          <li><a href="{{route('user-login')}}" class="scroll-to">{{__('Connexion')}}</a></li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{ route('userRegister') }}">{{ __('Inscription') }}</a>
                        </li>
                          @endif
                      </ul>
                      <!-- Nav-Links end -->
                  </div>
              </div>
          </nav>
          <!-- end navigation -->
      </div>
  </div>

</header>
<!-- Header end -->