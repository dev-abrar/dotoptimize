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
                    <h2>How It Work</h2>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- ===================================
        Careers page content
=======================================-->
<section id="how_it_work">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-0 order-lg-2">
                <div class="work_img">
                    <img src="{{asset('frontend/images/banner-shape02.png')}}" alt="">
                    <img style="margin-left: 40px;" src="#" alt="Best Digital Solution Provider Agency">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="work_content">
                    <span>Who We Are</span>
                    <h2>Best Digital Solution Provider Agency</h2>
                        <p class="work_info">When An Unknown Printer Took A Galley Of Type And Scrambled It Ake A Type Specimen Book. When An Unknown Printer Took A Galley Of Type And Scrambled It Ake.</p>
                        <ul class="list-wrap">
                            @foreach ($work_way as $ways)
                            <li><i class="fas fa-arrow-right"></i>{{$ways->add_way}}</li>
                            @endforeach
                            <div class="veiw_all " style="margin-top: 50px;">
                                <a href="{{route('service')}}" >Take Our Service</a>
                            </div>
                        </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection