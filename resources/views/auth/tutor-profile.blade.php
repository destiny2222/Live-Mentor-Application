@extends('layouts.main')
@section('title', 'Tutor Profile')
@section('content')
<style>
    .skills-container {
    display: flex;
    flex-wrap: wrap; 
    gap: 1px; 
}

.tag-list {
    /* flex: 1 1 100px;  */
}

</style>
<!-- Breadcumb Sections -->
<section class="breadcumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-lg-10">
                <div class="breadcumb-style1 mb10-xs">
                    <div class="breadcumb-list">
                        <a href="#">Home</a>
                        <a href="#">Services</a>
                        <a href="#">Design & Creative</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-2">
                <div class="d-flex align-items-center justify-content-sm-end">
                    <div class="share-save-widget d-flex align-items-center">
                        <span class="icon flaticon-share dark-color fz12 mr10"></span>
                        <div class="h6 mb-0">Share</div>
                    </div>
                    <div class="share-save-widget d-flex align-items-center ml15">
                        <span class="icon flaticon-like dark-color fz12 mr10"></span>
                        <div class="h6 mb-0">Save</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcumb Sections -->
<section class="breadcumb-section pt-0">
    <div class="cta-service-v1 freelancer-single-style mx-auto maxw1700 pt120 pt60-sm pb120 pb60-sm bdrs16 position-relative overflow-hidden d-flex align-items-center mx20-lg px30-lg">
        <img class="left-top-img wow zoomIn" src="images/vector-img/left-top.png" alt="">
        <img class="right-bottom-img wow zoomIn" src="images/vector-img/right-bottom.png" alt="">
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-xl-7">
                    <div class="position-relative">
                        <div class="list-meta d-sm-flex align-items-center mt30">
                            <a class="position-relative freelancer-single-style" href="#">
                                <img class="rounded-circle w-100 wa-sm mb15-sm" src="{{ asset('profile/'.$tutor->user->image) }}" alt="Freelancer Photo">
                            </a>
                            <div class="ml20 ml0-xs">
                                <h5 class="title mb-1">{{ $tutor->user->name }}</h5>
                                <p class="mb-0">{{ $tutor->title }}</p>
                                <p class="mb-0 dark-color fz15 fw500 list-inline-item mb5-sm"><i class="fas fa-star vam fz10 review-color me-2"></i> {{ number_format($tutor->averageRating(), 1) }} reviews</p>
                                <p class="mb-0 dark-color fz15 fw500 list-inline-item ml15 mb5-sm ml0-xs"><i class="flaticon-place vam fz20 me-2"></i> London, UK</p>
                                <p class="mb-0 dark-color fz15 fw500 list-inline-item ml15 mb5-sm ml0-xs"><i class="flaticon-30-days vam fz20 me-2"></i> Member since {{ $tutor->user->created_at->format("F j, Y") }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Details -->
<section class="pt10 pb90 pb30-md">
    <div class="container">
        <div class="row wow fadeInUp">
            <div class="col-lg-8">
                <div class="service-about">
                    <h4>Description</h4>
                    <p class="text mb30">
                        {{ $tutor->description }}    
                    </p>
                    <hr class="opacity-100 mb60 mt60">
                    <h4 class="mb30">Education</h4>
                    <div class="educational-quality">
                        <div class="m-circle text-thm">M</div>
                        <div class="wrapper mb40">
                            <span class="tag">2012 - 2014</span>
                            <h5 class="mt15">Bachlors in Fine Arts</h5>
                            <h6 class="text-thm">Modern College</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et
                                malesuada fames ac ante ipsum primis in faucibus.</p>
                        </div>
                        <div class="m-circle before-none text-thm">M</div>
                        <div class="wrapper mb60">
                            <span class="tag">2008 - 2012</span>
                            <h5 class="mt15">Computer Science</h5>
                            <h6 class="text-thm">Harvartd University</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et
                                malesuada fames ac ante ipsum primis in faucibus.</p>
                        </div>
                    </div>
                    <hr class="opacity-100 mb60">
                    <h4 class="mb30">Work & Experience</h4>
                    <div class="educational-quality">
                        <div class="m-circle text-thm">M</div>
                        <div class="wrapper mb40">
                            <span class="tag">2012 - 2014</span>
                            <h5 class="mt15">UX Designer</h5>
                            <h6 class="text-thm">Dropbox</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et
                                malesuada fames ac ante ipsum primis in faucibus.</p>
                        </div>
                        <div class="m-circle before-none text-thm">M</div>
                        <div class="wrapper mb60">
                            <span class="tag">2008 - 2012</span>
                            <h5 class="mt15">Art Director</h5>
                            <h6 class="text-thm">amazon</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et
                                malesuada fames ac ante ipsum primis in faucibus.</p>
                        </div>
                    </div>
                    <hr class="opacity-100 mb60">
                    <h4 class="mb30">Awards adn Certificates</h4>
                    <div class="educational-quality ps-0">
                        <div class="wrapper mb40">
                            <span class="tag">2012 - 2014</span>
                            <h5 class="mt15">UI UX Design</h5>
                            <h6 class="text-thm">Udemy</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et
                                malesuada fames ac ante ipsum <br class="d-none d-lg-block"> primis in faucibus.</p>
                        </div>
                        <div class="wrapper mb60">
                            <span class="tag">2008 - 2012</span>
                            <h5 class="mt15">App Design</h5>
                            <h6 class="text-thm">Google</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et
                                malesuada fames ac ante ipsum <br class="d-none d-lg-block"> primis in faucibus.</p>
                        </div>
                    </div>
                    
                    <hr class="opacity-100 mb60">
                    <div class="product_single_content mb60">
                        <div class="mbp_pagination_comments">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="total_review mb30">
                                        <h4>{{ $tutor->reviewCount() }} Reviews</h4>
                                    </div>
                                    <div class="d-md-flex align-items-center mb30">
                                        <div class="total-review-box d-flex align-items-center text-center mb30-sm">
                                            <div class="wrapper mx-auto">
                                                <div class="t-review mb15">{{ number_format($tutor->averageRating(), 2) }}</div>
                                                <h5>Exceptional</h5>
                                                <p class="text mb-0">{{ $tutor->reviewCount() }} reviews</p>
                                            </div>
                                        </div>
                                        <div class="wrapper ml60 ml0-sm">
                                            @php
                                                $ratingDistribution = [
                                                    5 => $tutor->reviews()->where('rating', 5)->count(),
                                                    4 => $tutor->reviews()->where('rating', 4)->count(),
                                                    3 => $tutor->reviews()->where('rating', 3)->count(),
                                                    2 => $tutor->reviews()->where('rating', 2)->count(),
                                                    1 => $tutor->reviews()->where('rating', 1)->count(),
                                                ];
                                                $totalReviews = $tutor->reviewCount();
                                            @endphp
                                            @foreach ($ratingDistribution as $star => $count)
                                                <div class="review-list d-flex align-items-center mb10">
                                                    <div class="list-number">{{ $star }} Star</div>
                                                    <div class="progress">
                                                        <div class="progress-bar" style="width: {{ $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0 }}%;" role="progressbar"></div>
                                                    </div>
                                                    <div class="value text-end">{{ $count }}</div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @foreach ($tutor->reviews as $review)
                                    <div class="col-md-12">
                                        <div class="mbp_first position-relative d-flex align-items-center justify-content-start mb30-sm">
                                            <img src="{{ asset('images/blog/comments-2.png') }}" class="mr-3" alt="comments-2.png">
                                            <div class="ml20">
                                                <h6 class="mt-0 mb-0">{{ $tutor->user->name }}</h6>
                                                <div><span class="fz14">{{ $tutor->created_at->format('d M Y') }}</span></div>
                                            </div>
                                        </div>
                                        <p class="text mt20 mb20">{{ $tutor->comment }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <div class="bsp_reveiw_wrt">
                        <h6 class="fz17">Add a Review</h6>
                        <p class="text">Your email address will not be published. Required fields are marked *</p>
                        <h6>Your rating of this tutor</h6>
                        <form class="comments_form mt30 mb30-md" action="{{ route('review.store') }}" method="POST">
                            @csrf
                            <div class="d-flex">
                                <input type="hidden" name="rating" id="rating" value="5">
                                <i class="fas fa-star review-color" data-value="1"></i>
                                <i class="far fa-star review-color ms-2" data-value="2"></i>
                                <i class="far fa-star review-color ms-2" data-value="3"></i>
                                <i class="far fa-star review-color ms-2" data-value="4"></i>
                                <i class="far fa-star review-color ms-2" data-value="5"></i>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="fw500 fz16 ff-heading dark-color mb-2">Comment</label>
                                        <textarea name="comment" class="pt15" rows="6" placeholder="There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text."></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb20">
                                        <input type="text" name="name" value="{{ Auth::user()->name ?? '' }}" hidden class="form-control" placeholder="Ali Tufan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb20">
                                        <input type="email" name="email" value="{{ Auth::user()->email ?? '' }}" hidden class="form-control" placeholder="creativelayers088">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="ud-btn btn-thm">Send<i class="fal fa-arrow-right-long"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog-sidebar ms-lg-auto">
                    <div class="price-widget pt25 widget-mt-minus bdrs8">
                        <div class="category-list mt20">
                            <a class="d-flex align-items-center justify-content-between bdrb1 pb-2" href="#">
                                <span class="text"><i class="flaticon-place text-thm2 pe-2 vam"></i>Location</span> <span class="">London, UK</span>
                            </a>
                            <a class="d-flex align-items-center justify-content-between bdrb1 pb-2" href="#">
                                <span class="text"><i class="flaticon-30-days text-thm2 pe-2 vam"></i>Member since</span> <span class="">{{ $tutor->user->created_at->format('F j') }}</span>
                            </a>
                            <a class="d-flex align-items-center justify-content-between bdrb1 pb-2" href="#">
                                <span class="text"><i class="flaticon-mars text-thm2 pe-2 vam"></i>Gender</span> <span class="">Male</span>
                            </a>
                            <a class="d-flex align-items-center justify-content-between bdrb1 pb-2" href="#">
                                <span class="text"><i class="flaticon-translator text-thm2 pe-2 vam"></i>Languages</span> <span class="">English</span>
                            </a>
                            <a class="d-flex align-items-center justify-content-between mb-3" href="#">
                                <span class="text"><i class="flaticon-sliders text-thm2 pe-2 vam"></i>English Level</span> <span class="">{{ $tutor->language }}</span>
                            </a>
                        </div>
                        <div class="d-grid">
                            <a href="{{ route('tutor.request') }}" onclick="event.preventDefault(); document.getElementById('request-form-{{ $tutor->id }}').submit();" class="ud-btn btn-thm">Send a Request <i class="fal fa-arrow-right-long"></i></a>
                            <form action="{{ route('tutor.request') }}" method="post" id="request-form-{{ $tutor->id }}">
                                @csrf
                                <input type="text" value="{{ $tutor->user->id }}" name="id" hidden>
                            </form>
                        </div>
                    </div>
                    <div class="sidebar-widget skills-container mb30 pb20 bdrs8">
                        <h4 class="widget-title">My Skills</h4>
                        <div class="tag-list mt30">
                            @foreach ($tutor->skill as $skills)
                             <a href="#">{{ $skills }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.querySelectorAll('.fa-star').forEach(star => {
        star.addEventListener('click', function() {
            const selectedValue = document.getElementById('rating').value;
            const currentValue = this.getAttribute('data-value');

            if (selectedValue === currentValue) {
                // If the clicked star is already selected, deselect it
                document.getElementById('rating').value = 0;
                resetStars();
            } else {
                // Set the new value and update the star icons
                document.getElementById('rating').value = currentValue;
                updateStars(currentValue);
            }
        });
    });

    function updateStars(value) {
        document.querySelectorAll('.fa-star').forEach(star => {
            if (star.getAttribute('data-value') <= value) {
                star.classList.add('fas');
                star.classList.remove('far');
            } else {
                star.classList.add('far');
                star.classList.remove('fas');
            }
        });
    }

    function resetStars() {
        document.querySelectorAll('.fa-star').forEach(star => {
            star.classList.add('far');
            star.classList.remove('fas');
        });
    }

</script>
@endsection
