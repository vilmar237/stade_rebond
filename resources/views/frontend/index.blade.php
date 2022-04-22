@extends('frontend.layouts.frontend_layout')

@section('title', "Welcome")

@section('content')


<div>&nbsp;</div>
<div class="container">
  <h1>
  <p class="text-center">
  {{__('Welcome to Rebond Athletics Playground')}}
  </p>
</h1>
</div>

<!-- Teaser start -->
<section id="teaser">
    <div class="container">
      <div class="row">
        <div class="col-md-7 col-xs-12 pull-right">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides start -->
            <div class="carousel-inner">
              <div class="item active">
                <h1 class="title">Basket ball 10.000fr/h
                  <span class="subtitle">bonapriso douala</span></h1>
                  <div class="car-img">
                    <img src="frontend/img/bask.jpg" class="img-responsive" alt="car1">
                  </div>
                </div>
                <div class="item">
                  <h1 class="title">Volley ball 10.000/h
                    <span class="subtitle">bonapriso douala</span></h1>
                    <div class="car-img">
                      <img src="frontend/img/voll.jpg" class="img-responsive" alt="car1">
                    </div>
                  </div>
                  <div class="item">
                    <h1 class="title">Handball 10.000/h
                      <span class="subtitle">bonapriso douala</span></h1>
                      <div class="car-img">
                        <img src="frontend/img/hand.jpg" class="img-responsive" alt="car1">
                      </div>
                    </div>
                    <div class="item">
                      <h1 class="title">soirée
                        <span class="subtitle">bonapriso douala</span></h1>
                        <div class="car-img">
                          <img src="frontend/img/noctune.jpg" class="img-responsive" alt="car1">
                        </div>
                      </div>

                      <div class="item">
                        <h1 class="title">nocturne
                          <span class="subtitle">bonapriso douala</span></h1>
                          <div class="car-img">
                            <img src="frontend/img/noc2.jpg" class="img-responsive" alt="car1">
                          </div>
                        </div>
                        <div class="item">
                          <h1 class="title">disponible
                            <span class="subtitle">bonapriso douala</span></h1>
                            <div class="car-img">
                              <img src="frontend/img/vol1.jpg" class="img-responsive" alt="car1">
                            </div>
                          </div>
                </div>
                <!-- Wrapper for slides end -->

                <!-- Slider Controls start -->
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                <!-- Slider Controls end -->
              </div>
            </div>
            <div class="col-md-5 col-xs-12 pull-left">
              <div class="reservation-form-shadow">

                <form method="post" enctype="multipart/form-data" action="{{ url('book') }}">
                @csrf

                  <div class="alert alert-danger hidden" id="car-select-form-msg">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Note:</strong>{{__('veillez remplir tous les champs')}}  
                  </div>

                  @if($errors->any())
                      @foreach($errors->all() as $error)
                          <p class="text-danger">{{$error}}</p>
                      @endforeach
                  @endif

                  @if(Session::has('success'))
                    <p class="text-success">{{session('success')}}</p>
                  @endif

                  <table class="table table-bordered">
                      <tr>
                          <th>{{__('Jour')}} <span class="text-danger">*</span></th>
                          <td><input id="datefield" name="day" min='1899-01-01' type="date" class="form-control" /></td>
                      </tr>
                      <tr>
                          <th>{{__('Vous commencez à')}} ? <span class="text-danger">*</span></th>
                          <td>
                            <select class="form-control select1" name="debut">
                                  <option>Choisir une heure de début</option>
                                  @foreach ($hours as $key => $hour)
                                        <option value="{{ $hour }}" {{ ( $key == $selectedID) ? 'selected' : '' }}> 
                                            {{ $hour }} 
                                        </option>
                                  @endforeach    
                              </select>
                          </td>
                      </tr>
                      <tr>
                          <th>{{__('Pour terminer à')}} ? <span class="text-danger">*</span></th>
                          <td>
                            <select class="form-control select2" name="fin">
                                  <option>Choisir une heure de fin</option>
                                  @foreach ($hours as $key => $hour)
                                      <option value="{{ $hour }}" {{ ( $key == $selectedID) ? 'selected' : '' }}> 
                                          {{ $hour }} 
                                      </option>
                                  @endforeach    
                              </select>
                          </td>
                      </tr>
                      <tr>
                          <th>{{__('Motif de réservation')}} <span class="text-danger">*</span></th>
                          <td>
                            <select class="form-control" name="type_stade">
                                <option>Choisir l'activité à mener</option>
                                @foreach ($type_terrain as $key => $type)
                                    <option value="{{ $key }}" {{ ( $key == $selectedID) ? 'selected' : '' }}> 
                                        {{ $type }} 
                                    </option>
                                @endforeach   
                            </select>
                              <p>{{__('Prix')}}: <span class="show-room-price">10.000 /h</span></p>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">
                              
                            <input type="hidden" name="customer_id" value="1" />
                            
                              <input type="hidden" name="roomprice" class="room-price" value="" />
                            <input type="hidden" name="ref" value="front" />
                              <input type="submit" class="btn btn-primary" value="{{__('Réserver')}}" />
                          </td> 
                      </tr>
                  </table>

                  
                 
                </form>

              </div>
            </div>

          </div>
        </div>
</section>
<div class="arrow-down"></div>
<!-- Teaser end -->
<section id="services" class="container">
  <div class="row">
    <div class="col-md-12 title">
      <h2> Services</h2>
      <span class="underline">&nbsp;</span>
    </div>

    <!-- Service Box start -->
    <div class="col-md-6">
      <div class="service-box wow fadeInLeft" data-wow-offset="100">
        <div class="service-icon">#</div>
        <h3 class="service-title">{{__('Speed')}}</h3>
        <div class="clearfix"></div>
        <p class="service-content">{{__('Book easily and quickly in less than 01 min on the platform in order to have a time slot at the stadium.')}}</p>
      </div>
    </div>
    <!-- Service Box end -->



    
    <!-- Service Box start -->
    <div class="col-md-6">
      <div class="service-box wow fadeInRight" data-wow-offset="100">
        <div class="service-icon">#</div>
        <h3 class="service-title">{{__('Electronic payment')}}</h3>
        <div class="clearfix"></div>
        <p class="service-content">{{__('Pay your reservation by electronic payment')}}.</p>
        <img src="frontend/img/mtnOrange.jpg" width="70" alt=""/>
      </div>
    </div>
    <!-- Service Box end -->

    <!-- Service Box start -->
    <div class="col-md-6">
      <div class="service-box wow fadeInLeft" data-wow-offset="100">
        <div class="service-icon">#</div>
        <h3 class="service-title">{{__('Forum')}}</h3>
        <div class="clearfix"></div>
        <p class="service-content">{{__('log in and chat on the forum to find players')}}</p>
      </div>
    </div>
    <!-- Service Box end -->

    <!-- Service Box start -->
    <div class="col-md-6">
      <div class="service-box wow fadeInRight" data-wow-offset="100">
        <div class="service-icon">#</div>
        <h3 class="service-title">{{__('Support available')}}</h3>
        <div class="clearfix"></div>
        <div class="contact-box">
      
          <div class="contact-box-name">vilmar237</div>
          <div class="contact-box-phon"><span class="highlight">Phone:</span> 666-999-888</div>
          <div class="contact-box-email"><span class="highlight">Email:</span> vilmar@example.com</div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <!-- Service Box end -->

  </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript">
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
      dd = '0' + dd;
    }

    if (mm < 10) {
      mm = '0' + mm;
    } 
        
    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("datefield").setAttribute("min", today);
    document.getElementById("time1").min = "08:00";
    document.getElementById("time2").max = "21:00";

    t= $( ".select1 option:selected" ).text();
    $( ".select2 option:selected" ).text();

    alert(t);
</script>
@endpush