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
            <div class="col-lg-6 m-auto">
                <div class="breadcrumb">
                    <h2>Galleries</h2>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- ====================================
     Gallery Part Start
=======================================-->
<section id="gallery-section">
    <div class="container">
        <div class="row">
            @foreach ($galleries as $gallery)
            <div class="col-lg-4 col-sm-6">
                <div class="gallery-img">
                    <img src="{{asset('upload/gallery')}}/{{$gallery->gallery_image}}" class="img-fluid" alt="">
                    <div class="overlay">
                        <a><h4 class="gallery-title">{{$gallery->gallery_name}}</h4></a>
                        <p>By Super Admin</p>
                    </div>
                </div>
            </div>
            @endforeach
            {{$galleries->links()}}
        </div>
    </div>
</section>


@endsection