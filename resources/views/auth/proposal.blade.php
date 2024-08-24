@extends('layouts.main')
@section('title', 'Proposal')
@section('content')
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
    <div class="cta-service-single cta-banner mx-auto maxw1700 pt120 pt60-sm pb120 pb60-sm bdrs16 position-relative overflow-hidden d-flex align-items-center mx20-lg px30-lg">
        <img class="left-top-img wow zoomIn" src="/images/vector-img/left-top.png" alt="">
        <img class="right-bottom-img wow zoomIn" src="/images/vector-img/right-bottom.png" alt="">
        <img class="service-v1-vector bounce-y d-none d-xl-block" src="/images/vector-img/vector-service-v1.png" alt="">
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-xl-7">
                    <div class="position-relative">
                        <h2>Preference</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Shop Checkout Area -->
<section class="shop-checkout pt-0" id="psWidget">
    <div class="container">
        <div class="row wow fadeInUp" data-wow-delay="300ms">
            <div class="col-md-10 col-lg-10 m-auto">
                <div class="checkout_form">
                    <div class="checkout_coupon">
                       @livewire('preference')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        Livewire.on('showAlert', function (message) {
            Swal.fire({
                title: 'Success',
                text: message,
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    });
</script>
@endsection


