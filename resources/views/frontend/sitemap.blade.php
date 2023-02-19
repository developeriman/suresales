@extends('frontend.layout')
@section('page_title','Site Map')
@section('content')

 <!-- Page Title -->
 <!-- <div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="title-content">
                    <h2>Site Map</h2>
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <span>Site-map</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="title-img">
        <img src="{{ asset('frontend/images/page-title1.jpg') }}" alt="About">
        <img src="{{ asset('frontend/images/shape16.png') }}" alt="Shape">
        <img src="{{ asset('frontend/images/shape17.png') }}" alt="Shape">
        <img src="{{ asset('frontend/images/shape18.png') }}" alt="Shape">
    </div>
</div> -->
<!-- End Page Title -->

<!-- Rules -->
<div class="rules-area ptb-100">
    <div class="container">
        <h3 style="text-align: center !important; margin-top: 20px;">{{ GoogleTranslate::trans('Site Map', app()->getLocale()) }}</h3>
        <div class="rules-item mt-5">
            <h6>{{ GoogleTranslate::trans('Page Link', app()->getLocale()) }}</h6>
            @foreach($sitemap as $val)
            <div style="display: flex !important;">
                <div>
                    <h6>.</h6>
                </div>
                <div>
                    <a href="{{ url($val->link) }}" style="color: black !important;">{{ $val->link }}</a>
                </div>
            </div>
            
            @endforeach
        </div>

    </div>
</div>
<!-- End Rules -->

@endsection