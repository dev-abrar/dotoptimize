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
                    <h2>Careers</h2>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- ===================================
        Careers page content
=======================================-->
<section id="project-area-four">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="careers_content">
                    <span>Case Studies</span>
                    <h2>We’ve Done Lot’s Of Work, Let’s
                        Check Some From Here</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="veiw_all ">
                    <a href="{{route('project')}}" >See All Projects</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection