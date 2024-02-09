@extends('frontned.master')

@section('content')
    <!-- =================================
    Banner Part Start 
======================================-->
<section id="banner_two">
    <div class="shap_img">

        <img class="first_shap" src="{{asset('frontend/images/breadcrumb-shape01.png')}}" alt="">
        <img class="second_shap" src="{{asset('frontend/images/breadcrumb-shape02.png')}}" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="breadcrumb">
                    <h2>Privacy Policy</h2>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- ===================================
        Careers page content
=======================================-->
<section id="blog-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-details-content">
                    
                     {!!$policy_info->desp !!}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection