@extends('layouts.main')
@section('title', 'Tutor Profile')
@section('content')
<style>
    .skills-container {
        display: flex;
        flex-wrap: wrap; 
        gap: 1px; 
    }

    .oni{
            left: 4%;
            top:20%;
        }

        .w-70{
            width:70%;
        }

        @media (max-width: 768px) {
            .w-70 {
                width: 100%;
            }
            .oni{
                right: 8%;
            }
            .freelancer-single-style .online {
                top: -98px;
            }
        }

        .online.offline{
            background-color: orange !important;
        }
</style>

<!-- Breadcumb Sections -->
<section class="breadcumb-section wow fadeInUp mt40">
    <div class="cta-commmon-v1 cta-banner bgc-thm2 mx-auto maxw1700 pt120 pb120 bdrs16 position-relative overflow-hidden d-flex align-items-center mx20-lg">
      <img class="left-top-img wow zoomIn" src="/images/vector-img/left-top.png" alt="">
      <img class="right-bottom-img wow zoomIn" src="/images/vector-img/right-bottom.png" alt="">
      <div class="container">
        <div class="row">
          <div class="col-xl-5">
            <div class="position-relative wow fadeInUp" data-wow-delay="300ms">
              <h2 class="text-white">Mentor Profile</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Breadcumb Sections -->



<!-- Service Details -->
<section class="pt10 pb90 pb30-md">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="container">
        <div class="row wow fadeInUp">
            <div class="col-lg-8">
                <div class="service-about">
                    <h4>About</h4>
                    <p class="text mb30">
                        {{ $users->mentor->about ?? 'N/A' }}    
                    </p>
                    <hr class="opacity-100 mb60 mt60">
                    <h4 class="mb30">Education</h4>
                    <div class="educational-quality">
                        @foreach ($educations as $education) 
                        <div class="m-circle text-thm">M</div>
                            <div class="wrapper mb40">
                                <span class="tag">{{  Carbon\Carbon::parse($education->start_date)->format('F j, Y')}} - {{ Carbon\Carbon::parse($education->end_date)->format('F j, Y') }}</span>
                                <h5 class="mt15">{{ $education->degree ?? 'N/A'}}</h5>
                                <h6 class="text-thm">{{ $education->school ?? 'N/A'}}</h6>
                                <p>{{ $education->description ?? 'N/A' }}</p>
                            </div>
                        @endforeach
                    </div>
                    <hr class="opacity-100 mb60">
                    <h4 class="mb30">Work & Experience</h4>
                    @foreach($experiences as $experience)
                     <div class="educational-quality">
                         <div class="m-circle text-thm">M</div>
                         <div class="wrapper mb40">
                             <span class="tag">{{ Carbon\Carbon::parse($experience->start_date)->format('F j, Y') }} - {{ Carbon\Carbon::parse($experience->end_date)->format('F j, Y') }}</span>
                             <h5 class="mt15">{{ $experience->title ?? 'N/A'}}</h5>
                             <h6 class="text-thm">{{ $experience->company ?? 'N/A'}}</h6>
                             <p>{{ $experience->description ?? 'N/A' }}</p>
                         </div>
                     </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog-sidebar ms-lg-auto">
                    <div class="price-widget pt25 widget-mt-minus bdrs8">
                        <div class="category-list mt20">
                           
                            <a class="d-flex align-items-center justify-content-between bdrb1 pb-2" href="#">
                                <span class="text"><i class="flaticon-30-days text-thm2 pe-2 vam"></i>Member since</span> <span class="">{{ $users->created_at->format('F j, Y') }}</span>
                            </a>
                            
                            <a class="d-flex align-items-center justify-content-between bdrb1 pb-2" href="#">
                                <span class="text"><i class="flaticon-translator text-thm2 pe-2 vam"></i>Languages</span> <span class="">English</span>
                            </a>
                            <a class="d-flex align-items-center justify-content-between mb-3" href="#">
                                <span class="text"><i class="flaticon-sliders text-thm2 pe-2 vam"></i>English Level</span> <span class="">{{ $users->language ?? 'N/A' }}</span>
                            </a>
                        </div>
                        <div class="d-grid">
                            {{-- <input type="text" value="{{ $users->email }}" name="mentor_id" > --}}
                            <button onclick="show()" id="show" class="ud-btn btn-thm">Book a Session <i class="fal fa-arrow-down-long"></i></button>
                        </div>
                    </div>
                    <div class="sidebar-widget skills-container book-session mb30 pb20 bdrs8" id="hidden" style="display: none;">
                        <div class="row align-items-center">
                            <h4 class="widget-title">Sessions</h4>
                            @foreach($Usersession as $session)
                                <div class="col-12 mb-3 mt-2">
                                    <label class="custom_checkbox fw500 text-start">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <p class="text-dark fw-500 mb-0 pt-1">{{ $session->session_title ?? 'N/A' }}</p>
                                                <small class="d-block text-muted"> <i class="fa fa-clock"></i> {{ $session->session_time ?? 'N/A' }} minutes</small>
                                            </div>
                                            <div class="col-auto text-sm-right">
                                                <span class="service-price badge badge-secondary-soft badge-pill">
                                                    {{ number_format($session->session_price ?? 'N/A', 2) }}&#x20A6;
                                                </span>
                                            </div>
                                        </div>
                                        <input type="radio" name="book_session" value="{{ json_encode(['id' => $session->id, 'title' => $session->session_title, 'time' => $session->session_time, 'price' => $session->session_price]) }}" hidden>
                                        <span class="checkmark" hidden></span>
                                    </label>
                                </div>
                            @endforeach
                            
                        </div>
                        <form action="{{ route('process.session.store') }}" method="POST">
                            @csrf
                            <input hidden type="text"  id="session_id" placeholder="Session ID" readonly>
                            <input hidden type="text" name="book_session" id="session_title" placeholder="Session Title" readonly>
                            <input hidden type="text" name="minutes" id="session_time" placeholder="Session Time" readonly>
                            <input hidden type="text" name="book_session_price" id="session_price" placeholder="Session Price" readonly>
                            <input type="text" value="{{ $users->id }}" name="mentor_id" hidden>
                            <input type="text" value="{{ Auth::user()->id ?? '' }}" name="user_id" hidden>
                            <div class="mt-3 session_details ">
                                <div class="shedule_area">
                                    <div class="row mb-4">
                                        <div class="col-md-8 col-xs-12 pl-0">
                                            <p class="fs-20 mb-2 fw-500">When should we meet?</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-4 p-0">
                                            <div class="form-group  mb-4">
                                                <label>Time Zone <span class="text-danger">*</span></label>
                                                <select class="form-control  visitor_time_zone" name="book_session_time_zone" required="">
                                                    <option value="">Select</option>
                                                    <option value="Europe/Andorra">Europe/Andorra</option>
                                                    <option value="Asia/Dubai">Asia/Dubai</option>
                                                    <option value="Asia/Kabul">Asia/Kabul</option>
                                                    <option value="America/Antigua">America/Antigua</option>
                                                    <option value="America/Anguilla">America/Anguilla</option>
                                                    <option value="Europe/Tirane">Europe/Tirane</option>
                                                    <option value="Asia/Yerevan">Asia/Yerevan</option>
                                                    <option value="Africa/Luanda">Africa/Luanda</option>
                                                    <option value="Antarctica/McMurdo">Antarctica/McMurdo</option>
                                                    <option value="Antarctica/Casey">Antarctica/Casey</option>
                                                    <option value="Antarctica/Davis">Antarctica/Davis</option>
                                                    <option value="Antarctica/DumontDUrville">Antarctica/DumontDUrville</option>
                                                    <option value="Antarctica/Mawson">Antarctica/Mawson</option>
                                                    <option value="Antarctica/Palmer">Antarctica/Palmer</option>
                                                    <option value="Antarctica/Rothera">Antarctica/Rothera</option>
                                                    <option value="Antarctica/Syowa">Antarctica/Syowa</option>
                                                    <option value="Antarctica/Troll">Antarctica/Troll</option>
                                                    <option value="Antarctica/Vostok">Antarctica/Vostok</option>
                                                    <option value="America/Argentina/Buenos_Aires">America/Argentina/Buenos_Aires</option>
                                                    <option value="America/Argentina/Cordoba">America/Argentina/Cordoba</option>
                                                    <option value="America/Argentina/Salta">America/Argentina/Salta</option>
                                                    <option value="America/Argentina/Jujuy">America/Argentina/Jujuy</option>
                                                    <option value="America/Argentina/Tucuman">America/Argentina/Tucuman</option>
                                                    <option value="America/Argentina/Catamarca">America/Argentina/Catamarca</option>
                                                    <option value="America/Argentina/La_Rioja">America/Argentina/La_Rioja</option>
                                                    <option value="America/Argentina/San_Juan">America/Argentina/San_Juan</option>
                                                    <option value="America/Argentina/Mendoza">America/Argentina/Mendoza</option>
                                                    <option value="America/Argentina/San_Luis">America/Argentina/San_Luis</option>
                                                    <option value="America/Argentina/Rio_Gallegos">America/Argentina/Rio_Gallegos</option>
                                                    <option value="America/Argentina/Ushuaia">America/Argentina/Ushuaia</option>
                                                    <option value="Pacific/Pago_Pago">Pacific/Pago_Pago</option>
                                                    <option value="Europe/Vienna">Europe/Vienna</option>
                                                    <option value="Australia/Lord_Howe">Australia/Lord_Howe</option>
                                                    <option value="Antarctica/Macquarie">Antarctica/Macquarie</option>
                                                    <option value="Australia/Hobart">Australia/Hobart</option>
                                                    <option value="Australia/Currie">Australia/Currie</option>
                                                    <option value="Australia/Melbourne">Australia/Melbourne</option>
                                                    <option value="Australia/Sydney">Australia/Sydney</option>
                                                    <option value="Australia/Broken_Hill">Australia/Broken_Hill</option>
                                                    <option value="Australia/Brisbane">Australia/Brisbane</option>
                                                    <option value="Australia/Lindeman">Australia/Lindeman</option>
                                                    <option value="Australia/Adelaide">Australia/Adelaide</option>
                                                    <option value="Australia/Darwin">Australia/Darwin</option>
                                                    <option value="Australia/Perth">Australia/Perth</option>
                                                    <option value="Australia/Eucla">Australia/Eucla</option>
                                                    <option value="America/Aruba">America/Aruba</option>
                                                    <option value="Europe/Mariehamn">Europe/Mariehamn</option>
                                                    <option value="Asia/Baku">Asia/Baku</option>
                                                    <option value="Europe/Sarajevo">Europe/Sarajevo</option>
                                                    <option value="America/Barbados">America/Barbados</option>
                                                    <option value="Asia/Dhaka">Asia/Dhaka</option>
                                                    <option value="America/Swift_Current">America/Swift_Current</option>
                                                    <option value="America/Edmonton">America/Edmonton</option>
                                                    <option value="America/Cambridge_Bay">America/Cambridge_Bay</option>
                                                    <option value="America/Yellowknife">America/Yellowknife</option>
                                                    <option value="America/Inuvik">America/Inuvik</option>
                                                    <option value="America/Creston">America/Creston</option>
                                                    <option value="America/Dawson_Creek">America/Dawson_Creek</option>
                                                    <option value="America/Fort_Nelson">America/Fort_Nelson</option>
                                                    <option value="America/Vancouver">America/Vancouver</option>
                                                    <option value="America/Whitehorse">America/Whitehorse</option>
                                                    <option value="America/Dawson">America/Dawson</option>
                                                    <option value="Indian/Cocos">Indian/Cocos</option>
                                                    <option value="Africa/Kinshasa">Africa/Kinshasa</option>
                                                    <option value="Africa/Lubumbashi">Africa/Lubumbashi</option>
                                                    <option value="Africa/Bangui">Africa/Bangui</option>
                                                    <option value="Africa/Brazzaville">Africa/Brazzaville</option>
                                                    <option value="Europe/Zurich">Europe/Zurich</option>
                                                    <option value="Africa/Abidjan">Africa/Abidjan</option>
                                                    <option value="Pacific/Rarotonga">Pacific/Rarotonga</option>
                                                    <option value="America/Santiago">America/Santiago</option>
                                                    <option value="America/Punta_Arenas">America/Punta_Arenas</option>
                                                    <option value="Pacific/Easter">Pacific/Easter</option>
                                                    <option value="Africa/Douala">Africa/Douala</option>
                                                    <option value="Asia/Shanghai">Asia/Shanghai</option>
                                                    <option value="Asia/Urumqi">Asia/Urumqi</option>
                                                    <option value="America/Bogota">America/Bogota</option>
                                                    <option value="America/Costa_Rica">America/Costa_Rica</option>
                                                    <option value="America/Havana">America/Havana</option>
                                                    <option value="Atlantic/Cape_Verde">Atlantic/Cape_Verde</option>
                                                    <option value="America/Curacao">America/Curacao</option>
                                                    <option value="Indian/Christmas">Indian/Christmas</option>
                                                    <option value="Asia/Nicosia">Asia/Nicosia</option>
                                                    <option value="Asia/Famagusta">Asia/Famagusta</option>
                                                    <option value="Europe/Prague">Europe/Prague</option>
                                                    <option value="Europe/Berlin">Europe/Berlin</option>
                                                    <option value="Europe/Busingen">Europe/Busingen</option>
                                                    <option value="Africa/Djibouti">Africa/Djibouti</option>
                                                    <option value="Europe/Copenhagen">Europe/Copenhagen</option>
                                                    <option value="America/Dominica">America/Dominica</option>
                                                    <option value="America/Santo_Domingo">America/Santo_Domingo</option>
                                                    <option value="Africa/Algiers">Africa/Algiers</option>
                                                    <option value="America/Guayaquil">America/Guayaquil</option>
                                                    <option value="Pacific/Galapagos">Pacific/Galapagos</option>
                                                    <option value="Europe/Tallinn">Europe/Tallinn</option>
                                                    <option value="Africa/Cairo">Africa/Cairo</option>
                                                    <option value="Africa/El_Aaiun">Africa/El_Aaiun</option>
                                                    <option value="Africa/Asmara">Africa/Asmara</option>
                                                    <option value="Europe/Madrid">Europe/Madrid</option>
                                                    <option value="Africa/Ceuta">Africa/Ceuta</option>
                                                    <option value="Atlantic/Canary">Atlantic/Canary</option>
                                                    <option value="Africa/Addis_Ababa">Africa/Addis_Ababa</option>
                                                    <option value="Europe/Helsinki">Europe/Helsinki</option>
                                                    <option value="Pacific/Fiji">Pacific/Fiji</option>
                                                    <option value="Atlantic/Stanley">Atlantic/Stanley</option>
                                                    <option value="Pacific/Chuuk">Pacific/Chuuk</option>
                                                    <option value="Pacific/Pohnpei">Pacific/Pohnpei</option>
                                                    <option value="Pacific/Kosrae">Pacific/Kosrae</option>
                                                    <option value="Atlantic/Faroe">Atlantic/Faroe</option>
                                                    <option value="Europe/Paris">Europe/Paris</option>
                                                    <option value="Africa/Libreville">Africa/Libreville</option>
                                                    <option value="Europe/London">Europe/London</option>
                                                    <option value="Asia/Tbilisi">Asia/Tbilisi</option>
                                                    <option value="America/Cayenne">America/Cayenne</option>
                                                    <option value="Africa/Accra">Africa/Accra</option>
                                                    <option value="Europe/Gibraltar">Europe/Gibraltar</option>
                                                    <option value="America/Grenada">America/Grenada</option>
                                                    <option value="America/Godthab">America/Godthab</option>
                                                    <option value="America/Danmarkshavn">America/Danmarkshavn</option>
                                                    <option value="America/Scoresbysund">America/Scoresbysund</option>
                                                    <option value="America/Thule">America/Thule</option>
                                                    <option value="Europe/Athens">Europe/Athens</option>
                                                    <option value="Atlantic/South_Georgia">Atlantic/South_Georgia</option>
                                                    <option value="America/Guatemala">America/Guatemala</option>
                                                    <option value="Pacific/Guam">Pacific/Guam</option>
                                                    <option value="Africa/Bissau">Africa/Bissau</option>
                                                    <option value="America/Guyana">America/Guyana</option>
                                                    <option value="Asia/Hong_Kong">Asia/Hong_Kong</option>
                                                    <option value="America/Tegucigalpa">America/Tegucigalpa</option>
                                                    <option value="Europe/Zagreb">Europe/Zagreb</option>
                                                    <option value="America/Port-au-Prince">America/Port-au-Prince</option>
                                                    <option value="Europe/Budapest">Europe/Budapest</option>
                                                    <option value="Asia/Jakarta">Asia/Jakarta</option>
                                                    <option value="Asia/Pontianak">Asia/Pontianak</option>
                                                    <option value="Asia/Makassar">Asia/Makassar</option>
                                                    <option value="Asia/Jayapura">Asia/Jayapura</option>
                                                    <option value="Europe/Dublin">Europe/Dublin</option>
                                                    <option value="Asia/Jerusalem">Asia/Jerusalem</option>
                                                    <option value="Asia/Kolkata">Asia/Kolkata</option>
                                                    <option value="Indian/Chagos">Indian/Chagos</option>
                                                    <option value="Asia/Baghdad">Asia/Baghdad</option>
                                                    <option value="Asia/Tehran">Asia/Tehran</option>
                                                    <option value="Atlantic/Reykjavik">Atlantic/Reykjavik</option>
                                                    <option value="Europe/Rome">Europe/Rome</option>
                                                    <option value="America/Jamaica">America/Jamaica</option>
                                                    <option value="Asia/Amman">Asia/Amman</option>
                                                    <option value="Asia/Tokyo">Asia/Tokyo</option>
                                                    <option value="Africa/Nairobi">Africa/Nairobi</option>
                                                    <option value="Asia/Bishkek">Asia/Bishkek</option>
                                                    <option value="Pacific/Tarawa">Pacific/Tarawa</option>
                                                    <option value="Pacific/Enderbury">Pacific/Enderbury</option>
                                                    <option value="Pacific/Kiritimati">Pacific/Kiritimati</option>
                                                    <option value="Asia/Pyongyang">Asia/Pyongyang</option>
                                                    <option value="Asia/Seoul">Asia/Seoul</option>
                                                    <option value="Asia/Almaty">Asia/Almaty</option>
                                                    <option value="Asia/Qyzylorda">Asia/Qyzylorda</option>
                                                    <option value="Asia/Qostanay">Asia/Qostanay</option>
                                                    <option value="Asia/Aqtobe">Asia/Aqtobe</option>
                                                    <option value="Asia/Aqtau">Asia/Aqtau</option>
                                                    <option value="Asia/Atyrau">Asia/Atyrau</option>
                                                    <option value="Asia/Oral">Asia/Oral</option>
                                                    <option value="Asia/Beirut">Asia/Beirut</option>
                                                    <option value="Asia/Colombo">Asia/Colombo</option>
                                                    <option value="Africa/Tripoli">Africa/Tripoli</option>
                                                    <option value="Africa/Casablanca">Africa/Casablanca</option>
                                                    <option value="Europe/Vilnius">Europe/Vilnius</option>
                                                    <option value="Europe/Luxembourg">Europe/Luxembourg</option>
                                                    <option value="Europe/Riga">Europe/Riga</option>
                                                    <option value="Africa/Monrovia">Africa/Monrovia</option>
                                                    <option value="Europe/Skopje">Europe/Skopje</option>
                                                    <option value="Indian/Antananarivo">Indian/Antananarivo</option>
                                                    <option value="Indian/Maldives">Indian/Maldives</option>
                                                    <option value="America/Mexico_City">America/Mexico_City</option>
                                                    <option value="America/Cancun">America/Cancun</option>
                                                    <option value="America/Merida">America/Merida</option>
                                                    <option value="America/Monterrey">America/Monterrey</option>
                                                    <option value="America/Matamoros">America/Matamoros</option>
                                                    <option value="America/Mazatlan">America/Mazatlan</option>
                                                    <option value="America/Chihuahua">America/Chihuahua</option>
                                                    <option value="America/Ojinaga">America/Ojinaga</option>
                                                    <option value="America/Hermosillo">America/Hermosillo</option>
                                                    <option value="America/Tijuana">America/Tijuana</option>
                                                    <option value="America/Bahia_Banderas">America/Bahia_Banderas</option>
                                                    <option value="Asia/Kuala_Lumpur">Asia/Kuala_Lumpur</option>
                                                    <option value="Asia/Kuching">Asia/Kuching</option>
                                                    <option value="Africa/Maputo">Africa/Maputo</option>
                                                    <option value="Africa/Windhoek">Africa/Windhoek</option>
                                                    <option value="Pacific/Noumea">Pacific/Noumea</option>
                                                    <option value="Pacific/Norfolk">Pacific/Norfolk</option>
                                                    <option value="Africa/Lagos">Africa/Lagos</option>
                                                    <option value="America/Managua">America/Managua</option>
                                                    <option value="Europe/Amsterdam">Europe/Amsterdam</option>
                                                    <option value="Europe/Oslo">Europe/Oslo</option>
                                                    <option value="Asia/Kathmandu">Asia/Kathmandu</option>
                                                    <option value="Pacific/Nauru">Pacific/Nauru</option>
                                                    <option value="Pacific/Niue">Pacific/Niue</option>
                                                    <option value="Pacific/Auckland">Pacific/Auckland</option>
                                                    <option value="Pacific/Chatham">Pacific/Chatham</option>
                                                    <option value="America/Panama">America/Panama</option>
                                                    <option value="America/Lima">America/Lima</option>
                                                    <option value="Pacific/Tahiti">Pacific/Tahiti</option>
                                                    <option value="Pacific/Marquesas">Pacific/Marquesas</option>
                                                    <option value="Pacific/Gambier">Pacific/Gambier</option>
                                                    <option value="Pacific/Port_Moresby">Pacific/Port_Moresby</option>
                                                    <option value="Pacific/Bougainville">Pacific/Bougainville</option>
                                                    <option value="Asia/Manila">Asia/Manila</option>
                                                    <option value="Asia/Karachi">Asia/Karachi</option>
                                                    <option value="Europe/Warsaw">Europe/Warsaw</option>
                                                    <option value="America/Miquelon">America/Miquelon</option>
                                                    <option value="Pacific/Pitcairn">Pacific/Pitcairn</option>
                                                    <option value="America/Puerto_Rico">America/Puerto_Rico</option>
                                                    <option value="Asia/Gaza">Asia/Gaza</option>
                                                    <option value="Asia/Hebron">Asia/Hebron</option>
                                                    <option value="Europe/Lisbon">Europe/Lisbon</option>
                                                    <option value="Atlantic/Madeira">Atlantic/Madeira</option>
                                                    <option value="Atlantic/Azores">Atlantic/Azores</option>
                                                    <option value="Pacific/Palau">Pacific/Palau</option>
                                                    <option value="America/Asuncion">America/Asuncion</option>
                                                    <option value="Asia/Qatar">Asia/Qatar</option>
                                                    <option value="Indian/Reunion">Indian/Reunion</option>
                                                    <option value="Europe/Bucharest">Europe/Bucharest</option>
                                                    <option value="Europe/Belgrade">Europe/Belgrade</option>
                                                    <option value="Europe/Kaliningrad">Europe/Kaliningrad</option>
                                                    <option value="Europe/Moscow">Europe/Moscow</option>
                                                    <option value="Europe/Kirov">Europe/Kirov</option>
                                                    <option value="Europe/Volgograd">Europe/Volgograd</option>
                                                    <option value="Europe/Saratov">Europe/Saratov</option>
                                                    <option value="Europe/Ulyanovsk">Europe/Ulyanovsk</option>
                                                    <option value="Europe/Astrakhan">Europe/Astrakhan</option>
                                                    <option value="Europe/Samara">Europe/Samara</option>
                                                    <option value="Asia/Yekaterinburg">Asia/Yekaterinburg</option>
                                                    <option value="Asia/Omsk">Asia/Omsk</option>
                                                    <option value="Asia/Novosibirsk">Asia/Novosibirsk</option>
                                                    <option value="Asia/Barnaul">Asia/Barnaul</option>
                                                    <option value="Asia/Tomsk">Asia/Tomsk</option>
                                                    <option value="Asia/Novokuznetsk">Asia/Novokuznetsk</option>
                                                    <option value="Asia/Krasnoyarsk">Asia/Krasnoyarsk</option>
                                                    <option value="Asia/Irkutsk">Asia/Irkutsk</option>
                                                    <option value="Asia/Chita">Asia/Chita</option>
                                                    <option value="Asia/Yakutsk">Asia/Yakutsk</option>
                                                    <option value="Asia/Khandyga">Asia/Khandyga</option>
                                                    <option value="Asia/Vladivostok">Asia/Vladivostok</option>
                                                    <option value="Asia/Ust-Nera">Asia/Ust-Nera</option>
                                                    <option value="Asia/Magadan">Asia/Magadan</option>
                                                    <option value="Asia/Sakhalin">Asia/Sakhalin</option>
                                                    <option value="Asia/Srednekolymsk">Asia/Srednekolymsk</option>
                                                    <option value="Asia/Kamchatka">Asia/Kamchatka</option>
                                                    <option value="Asia/Anadyr">Asia/Anadyr</option>
                                                    <option value="Asia/Riyadh">Asia/Riyadh</option>
                                                    <option value="Pacific/Guadalcanal">Pacific/Guadalcanal</option>
                                                    <option value="Indian/Mahe">Indian/Mahe</option>
                                                    <option value="Africa/Khartoum">Africa/Khartoum</option>
                                                    <option value="Europe/Stockholm">Europe/Stockholm</option>
                                                    <option value="Asia/Singapore">Asia/Singapore</option>
                                                    <option value="America/Paramaribo">America/Paramaribo</option>
                                                    <option value="Africa/Juba">Africa/Juba</option>
                                                    <option value="Africa/Sao_Tome">Africa/Sao_Tome</option>
                                                    <option value="America/El_Salvador">America/El_Salvador</option>
                                                    <option value="Asia/Damascus">Asia/Damascus</option>
                                                    <option value="America/Grand_Turk">America/Grand_Turk</option>
                                                    <option value="Africa/Mbeya">Africa/Mbeya</option>
                                                    <option value="Indian/Kerguelen">Indian/Kerguelen</option>
                                                    <option value="Asia/Dushanbe">Asia/Dushanbe</option>
                                                    <option value="Pacific/Fakaofo">Pacific/Fakaofo</option>
                                                    <option value="Asia/Bangkok">Asia/Bangkok</option>
                                                    <option value="Asia/Dili">Asia/Dili</option>
                                                    <option value="Asia/Ashgabat">Asia/Ashgabat</option>
                                                    <option value="Africa/Tunis">Africa/Tunis</option>
                                                    <option value="Pacific/Tongatapu">Pacific/Tongatapu</option>
                                                    <option value="Europe/Istanbul">Europe/Istanbul</option>
                                                    <option value="Asia/Almaty">Asia/Almaty</option>
                                                    <option value="Africa/Dar_es_Salaam">Africa/Dar_es_Salaam</option>
                                                    <option value="Europe/Kiev">Europe/Kiev</option>
                                                    <option value="Europe/Uzhgorod">Europe/Uzhgorod</option>
                                                    <option value="Europe/Zaporozhye">Europe/Zaporozhye</option>
                                                    <option value="Pacific/Wake">Pacific/Wake</option>
                                                    <option value="America/New_York">America/New_York</option>
                                                    <option value="America/Detroit">America/Detroit</option>
                                                    <option value="America/Kentucky/Louisville">America/Kentucky/Louisville</option>
                                                    <option value="America/Kentucky/Monticello">America/Kentucky/Monticello</option>
                                                    <option value="America/Indiana/Indianapolis">America/Indiana/Indianapolis</option>
                                                    <option value="America/Indiana/Vincennes">America/Indiana/Vincennes</option>
                                                    <option value="America/Indiana/Winamac">America/Indiana/Winamac</option>
                                                    <option value="America/Indiana/Marengo">America/Indiana/Marengo</option>
                                                    <option value="America/Indiana/Petersburg">America/Indiana/Petersburg</option>
                                                    <option value="America/Indiana/Vevay">America/Indiana/Vevay</option>
                                                    <option value="America/Chicago">America/Chicago</option>
                                                    <option value="America/Indiana/Tell_City">America/Indiana/Tell_City</option>
                                                    <option value="America/Indiana/Knox">America/Indiana/Knox</option>
                                                    <option value="America/Menominee">America/Menominee</option>
                                                    <option value="America/North_Dakota/Center">America/North_Dakota/Center</option>
                                                    <option value="America/North_Dakota/New_Salem">America/North_Dakota/New_Salem</option>
                                                    <option value="America/North_Dakota/Beulah">America/North_Dakota/Beulah</option>
                                                    <option value="America/Denver">America/Denver</option>
                                                    <option value="America/Boise">America/Boise</option>
                                                    <option value="America/Phoenix">America/Phoenix</option>
                                                    <option value="America/Los_Angeles">America/Los_Angeles</option>
                                                    <option value="America/Anchorage">America/Anchorage</option>
                                                    <option value="America/Juneau">America/Juneau</option>
                                                    <option value="America/Sitka">America/Sitka</option>
                                                    <option value="America/Metlakatla">America/Metlakatla</option>
                                                    <option value="America/Yakutat">America/Yakutat</option>
                                                    <option value="America/Nome">America/Nome</option>
                                                    <option value="America/Adak">America/Adak</option>
                                                    <option value="Pacific/Honolulu">Pacific/Honolulu</option>
                                                    <option value="Pacific/Midway">Pacific/Midway</option>
                                                    <option value="Pacific/Wake">Pacific/Wake</option>
                                                    <option value="Pacific/Apia">Pacific/Apia</option>
                                                </select>                                                
                                            </div>
                                            <div class="booking_calendar mt-5 p-0 mb-4">
                                                <label> Date <span class="text-danger">*</span></label>
                                                <input type="date" name="book_session_date" class="form-control" placeholder="">
                                            </div>
                                            <div class="booking_calendar mt-5 p-0 mb-4">
                                                <label> Time <span class="text-danger">*</span></label>
                                                <input type="time" name="book_session_time" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <div class="book_now_btn hide mt-5 ">
                                                <button type="submit" class="ud-btn btn-thm btn-md fs-14">
                                                    Send a Request <i class="fa fa-arrow-right pl-2"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                    <div class="sidebar-widget skills-container mb30 pb20 bdrs8">
                        <h4 class="widget-title">My Skills</h4>
                        <div class="tag-list mt30">
                            @foreach ($users->mentor->Skills ?? [] as $skills)
                             <a href="#">{{ $skills }}</a>
                            @endforeach
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')

<script>
    var Hidden = document.querySelector('#hidden');
    function show(){
        Hidden.style.display = 'block';
    }
</script>
<script>
    var customCheckboxes = document.querySelectorAll('.custom_checkbox');
    customCheckboxes.forEach(function(customCheckbox) {
        customCheckbox.addEventListener('click', function() {
            // Remove 'active' class from all labels
            customCheckboxes.forEach(function(cb) {
                cb.classList.remove('active');
            });
            // Add 'active' class to the clicked label
            this.classList.add('active');
        });
    });
</script>
<script>
    // Assign the input elements correctly
    var sessionID = document.getElementById('session_id');
    var sessionTitle = document.getElementById('session_title');
    var sessionPrice = document.getElementById('session_price');
    var sessionTime = document.getElementById('session_time');

    document.querySelectorAll('input[name="book_session"]').forEach(function(radio) {
        radio.addEventListener('click', function() {
            console.clear();

            var sessionDetails = JSON.parse(this.value);

            console.log("Session ID: " + sessionDetails.id);
            console.log("Session Title: " + sessionDetails.title);
            console.log("Session Time: " + sessionDetails.time);
            console.log("Session Price: " + sessionDetails.price);

            // Update the value of the input fields with the session details
            sessionID.value = sessionDetails.id;
            sessionTitle.value = sessionDetails.title;
            sessionTime.value = sessionDetails.time;
            sessionPrice.value = sessionDetails.price;
        });
    });

</script>
@endpush