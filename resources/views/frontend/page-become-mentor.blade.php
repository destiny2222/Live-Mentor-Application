@extends('layouts.main')
@section('title', 'Start Mentoring')
@section('content')

  <!-- Breadcumb Sections -->
  <section class="breadcumb-section wow fadeInUp mt40">
    <div class="cta-commmon-v1 cta-banner bgc-thm2 mx-auto maxw1700 pt120 pb120 bdrs16 position-relative overflow-hidden d-flex align-items-center mx20-lg">
      <img class="left-top-img wow zoomIn" src="images/vector-img/left-top.png" alt="">
      <img class="right-bottom-img wow zoomIn" src="images/vector-img/right-bottom.png" alt="">
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
        <div class="col-sm-6 col-lg-4">
          <div class="iconbox-style1 border-less p-0">
            <div class="icon before-none"><span class="flaticon-cv"></span></div>
            <div class="details">
              <h4 class="title mt10 mb-3">Sign up for free as a mentor/tutor</h4>
              <p class="text">Create an account for free as a mentor/tutor</p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4">
          <div class="iconbox-style1 border-less p-0">
            <div class="icon before-none"><span class="flaticon-web-design"></span></div>
            <div class="details">
              <h4 class="title mt10 mb-3">Complete your profile</h4>
              <p class="text">Update accurate details and get verified</p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4">
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
            <p class="paragraph mt10">Lorem ipsum dolor sit amet, consectetur.</p>
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
                      data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">What methods of
                      payments are supported?</button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-parent="#accordionExample">
                    <div class="accordion-body">Cras vitae ac nunc orci. Purus amet tortor non at phasellus
                      ultricies hendrerit. Eget a, sit morbi nunc sit id massa. Metus, scelerisque volutpat nec sit
                      vel donec. Sagittis, id volutpat erat vel.</div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Can I cancel
                      at anytime?</button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-parent="#accordionExample">
                    <div class="accordion-body">Cras vitae ac nunc orci. Purus amet tortor non at phasellus
                      ultricies hendrerit. Eget a, sit morbi nunc sit id massa. Metus, scelerisque volutpat nec sit
                      vel donec. Sagittis, id volutpat erat vel.</div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">How do I
                      get a receipt for my purchase?</button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-parent="#accordionExample">
                    <div class="accordion-body">Cras vitae ac nunc orci. Purus amet tortor non at phasellus
                      ultricies hendrerit. Eget a, sit morbi nunc sit id massa. Metus, scelerisque volutpat nec sit
                      vel donec. Sagittis, id volutpat erat vel.</div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Which
                      license do I need?</button>
                  </h2>
                  <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                    data-parent="#accordionExample">
                    <div class="accordion-body">Cras vitae ac nunc orci. Purus amet tortor non at phasellus
                      ultricies hendrerit. Eget a, sit morbi nunc sit id massa. Metus, scelerisque volutpat nec sit
                      vel donec. Sagittis, id volutpat erat vel.</div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">How do I get
                      access to a theme I purchased?</button>
                  </h2>
                  <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                    data-parent="#accordionExample">
                    <div class="accordion-body">Cras vitae ac nunc orci. Purus amet tortor non at phasellus
                      ultricies hendrerit. Eget a, sit morbi nunc sit id massa. Metus, scelerisque volutpat nec sit
                      vel donec. Sagittis, id volutpat erat vel.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
 

  
@endsection
  

  