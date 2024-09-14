@extends('layouts.main')
@section('title', 'Contact')
@section('content')
<section class="breadcumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-lg-10">
                <div class="breadcumb-style1 mb10-xs">
                    <div class="breadcumb-list">
                        <a href="/">Home</a>
                        <a href="#">About us</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-2 d-none d-lg-block">
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

    <section class="pt-0">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-delay="300ms">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="position-relative mt40">
                        <div class="main-title">
                            <h4 class="form-title mb25">Keep In Touch With Us.</h4>
                        </div>
                        {{-- <div class="iconbox-style1 contact-style d-flex align-items-start mb30">
                            <div class="icon flex-shrink-0"><span class="flaticon-tracking"></span></div>
                            <div class="details">
                                <h5 class="title">Address</h5>
                                <p class="mb-0 text">328 Queensberry Street, North <br> Melbourne VIC 3051, Australia.</p>
                            </div>
                        </div> --}}
                        <div class="iconbox-style1 contact-style d-flex align-items-start mb30">
                            <div class="icon flex-shrink-0"><span class="flaticon-call"></span></div>
                            <div class="details">
                                <h5 class="title">Phone</h5>
                                <p class="mb-0 text">+2348076899750</p>
                            </div>
                        </div>
                        <div class="iconbox-style1 contact-style d-flex align-items-start mb30">
                            <div class="icon flex-shrink-0"><span class="flaticon-mail"></span></div>
                            <div class="details">
                                <h5 class="title">Email</h5>
                                <p class="mb-0 text">info@gritinai.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="contact-page-form default-box-shadow1 bdrs8 bdr1 p50 mb30-md bgc-white">
                        <h4 class="form-title mb25">Tell us about yourself</h4>
                        <p class="text mb30">Whether you have questions or you would just like to say hello, contact us.</p>
                        <form action="#" class="form-style1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10" for="">Name</label>
                                        <input type="text" class="form-control" placeholder="Ali">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10" for="">Email</label>
                                        <input type="email" class="form-control" placeholder="Tufan">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10" for="">Messages</label>
                                        <textarea name="" id="" cols="30" rows="6" placeholder="Description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="">
                                        <a class="ud-btn btn-thm" href="page-contact.html">Send Messages<i class="fal fa-arrow-right-long"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection
    @push('scripts')
    <script>
        $(document).ready(function(){
            $('#contact_form').submit(function(e){
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var data = form.serialize();
                $.ajax({
                    url:url,
                    type:'post',
                    data:data,
                    success:function(res){
                        if(res.status == 'success'){
                            $('#contact_form')[0].reset();
                            alert(res.message);
                        }else{
                            alert(res.message);
                        }
                    }
                });
            });
        });
    </script>
    @endpush

          

       