@extends('layouts.main')
@section('title', 'Tutor')
@section('content')
<style>
.show-more-skills {
        cursor: pointer;
        background-color: #f0f0f0;
        transition: background-color 0.3s;
    }
    .show-more-skills:hover {
        background-color: #e0e0e0;
    }
    .top-0{
        top: 16px !important;
        display: table !important;
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
              <h2 class="text-white">Tutor</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




<!-- Listings All Lists -->
<section class="pt30 pb90" id="tutor">
    <div class="container">
        <div class="row">
            @foreach ($tutors as $tutor)
                @if ($tutor->is_approved == 1)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="freelancer-style1 text-center bdr1 hover-box-shadow">
                            
                            <div class="thumb mb25 mx-auto position-relative rounded-circle">
                                @if (!is_null($tutor->user) && !is_null($tutor->user->image))
                                    <img class="rounded-circle mx-auto" width="100" height="100" src="{{ asset('profile/'.$tutor->user->image) }}" alt="{{ $tutor->user->name }}" />
                                @else
                                    <img class="rounded-circle mx-auto" width="100" height="100" src="{{ asset('default-avatar.jpg') }}" alt="Default Avatar" />
                                @endif
                            </div>
                            
                            <div class="details">
                                @if (!is_null($tutor->user) && $tutor->user->last_seen >= now()->subMinutes(5))
                                    <div class="available-asap position-absolute top-0">
                                        <i class="fa fa-bolt"></i>
                                        <span class="ml-1 font-weight-600">Available ASAP</span>
                                    </div>
                                @endif
                                
                                <h5 class="title mb-1">{{ $tutor->user->name ?? 'Unknown' }}</h5>
                                <p class="mb-0">{{ $tutor->title ?? 'No title available' }}</p>
                                <div class="review">
                                    <p>
                                        <i class="fas fa-star fz10 review-color pr10"></i>
                                        <span class="dark-color fw500">{{ number_format($tutor->averageRating(), 1) }}</span>
                                        ({{ $tutor->reviewCount() }} reviews)
                                    </p>
                                </div>
                                
                                <div class="skill-tags d-flex align-items-center gap-3 justify-content-center mb5">
                                    @php 
                                        $skillCount = count($tutor->skill);
                                        $displayedSkills = array_slice($tutor->skill, 0, 3);
                                        $remainingSkills = array_slice($tutor->skill, 3);
                                    @endphp
                                    
                                    @foreach ($displayedSkills as $skill)
                                        <span class="tag">{{ $skill }}</span> 
                                    @endforeach
                                </div>
                                @if ($skillCount > 3)
                                        <span class="ta" data-bs-toggle="modal" data-bs-target="#skillsModal-{{ $tutor->id }}">
                                            +{{ $skillCount - 3 }} more
                                        </span>
                                    @endif
                                <!-- Modal for remaining skills -->
                                @if ($skillCount > 3)
                                    <div class="modal fade" id="skillsModal-{{ $tutor->id }}" tabindex="-1" aria-labelledby="skillsModalLabel-{{ $tutor->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="skillsModalLabel-{{ $tutor->id }}">All Skills</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="skill-tags d-flex flex-wrap gap-3">
                                                        @foreach ($tutor->skill as $skill)
                                                            <span class="tag">{{ $skill }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <hr class="opacity-100 mt20 mb15">
                                 
                                <div class="fl-meta d-flex align-items-center justify-content-between">
                                    <a class="meta fw500 text-start">Duration<br><span class="fz14 fw400">{{ $syllabi->duration ?? 'N/A' }}</span></a>
                                    <a class="meta fw500 text-start">Price<br><span class="fz14 fw400">&#8358; {{ number_format($syllabi->price ?? 0, 2) }}</span></a>
                                </div>
                                {{-- <div class="fl-meta d-flex align-items-center justify-content-between">
                                    <a class="meta fw500 text-start">Duration<br><span class="fz14 fw400">{{ $tutor->syllabus->duration }} </span></a>
                                    <a class="meta fw500 text-start">Price<br><span class="fz14 fw400">&#8358; {{  number_format($tutor->syllabus->price, 2) }}</span></a>
                                </div> --}}
                                <div class="d-grid mt15">
                                    <a href="{{ route('tutor.profile', $tutor->user->id ?? '#')}}" class="ud-btn btn-light-thm">
                                        View Profile<i class="fal fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach        
            
        </div>
        <div class="row">
            <div class="mbp_pagination mt30 text-center">
                 
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@endsection


