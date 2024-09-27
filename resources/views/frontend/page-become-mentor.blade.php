@extends('layouts.main')
@section('title', 'Start Mentoring')
@section('content')

  <!-- Breadcumb Sections -->
  <section class="breadcumb-section wow fadeInUp mt40">
    <div class="cta-commmon-v1 cta-banner bgc-thm2 mx-auto maxw1700 pt120 pb120 bdrs16 position-relative overflow-hidden d-flex align-items-center mx20-lg">
      <img class="left-top-img wow zoomIn" src="/images/vector-img/left-top.png" alt="">
      <img class="right-bottom-img wow zoomIn" src="/images/vector-img/right-bottom.png" alt="">
      <div class="container">
        <div class="row">
          <div class="col-xl-5">
            <div class="position-relative wow fadeInUp" data-wow-delay="300ms">
              <h2 class="text-white">Join our pool of experts!</h2>
              <p class="text mb30 text-white">Find fulfillment in helping others achieve their goals and succeed in their careers.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Features --> 
  <section class="our-features pt-100 pb90">
    <div class="container">
      <div class="row wow fadeInUp">
        <div class="col-lg-12 text-center">
          <div class="main-title">
            <h2>How It Works</h2>
          </div>
        </div>
      </div>
      <div class="row wow fadeInUp" data-wow-delay="300ms">
        <div class="col-sm-6 col-lg-3">
          <div class="iconbox-style1 border-less p-0">
            <div class="icon before-none"><span class="flaticon-cv"></span></div>
            <div class="details">
              <h4 class="title mt10 mb-3">Sign up for free as a mentor/tutor</h4>
              <p class="text">Create an account for free as a mentor/tutor</p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="iconbox-style1 border-less p-0">
            <div class="icon before-none"><span class="flaticon-web-design"></span></div>
            <div class="details">
              <h4 class="title mt10 mb-3">Complete your profile</h4>
              <p class="text">Update accurate details and get verified</p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="iconbox-style1 border-less p-0">
            <div class="icon before-none"><span class="flaticon-secure"></span></div>
            <div class="details">
              <h4 class="title mt10 mb-3">Deliver custom sessions</h4>
              <p class="text">Tailor session delivery to clients' needs.</p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="iconbox-style1 border-less p-0">
            <div class="icon before-none"><span class="flaticon-customer-service"></span></div>
            <div class="details">
              <h4 class="title mt10 mb-3">Get paid</h4>
              <p class="text">Payment is available for withdrawal as soon as the session is completed</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Our faq -->
  <section class="our-faqs pt-0 pb50">
    <div class="container">
      <div class="row wow fadeInUp">
        <div class="col-lg-6 m-auto">
          <div class="main-title text-center">
            <h2 class="title">Frequently Asked Questions</h2>
          </div>
        </div>
      </div>
      <div class="row wow fadeInUp" data-wow-delay="300ms">
        <div class="col-lg-8 mx-auto">
          <div class="ui-content">
            <div class="accordion-style1 faq-page mb-4 mb-lg-5">
              <div class="accordion" id="accordionExample">
                <div class="accordion-item active">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">How much time do I need to invest?</button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-parent="#accordionExample">
                    <div class="accordion-body">
                      LiveMentor allows you to set availability
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">How do I accept mentees?</button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-parent="#accordionExample">
                    <div class="accordion-body">
                      You will get notified once a proposal is sent. All proposals will be visible on your dashboard where you accept/decline proposals
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">How do I get paid?
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-parent="#accordionExample">
                    <div class="accordion-body">Payment is made on request for a minimum of one (1) completed sessions.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
 

  <section class="our-faqs pt-0 pb50">
    <div class="container">
      <div class="row wow fadeInUp">
        <div class="col-lg-6 m-auto">
          <div class="main-title text-center">
             <a href="/register" class="ud-btn btn-thm-border mb25 me-4">Get Started<i class="fal fa-arrow-right-long"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  
@endsection
  

  