@extends('frontend.layout')
@section('page_title','Index')
@section('content')

<!-- Page Title -->
<!-- <div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="title-content">
                    <h2>Single Product</h2>
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <span>Single Product</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="title-img">
        <img src="{{ url('frontend//images/page-title2.jpg') }}" alt="About">
        <img src="{{ asset('frontend/images/shape16.png') }}" alt="Shape">
        <img src="{{ asset('frontend/images/shape17.png') }}" alt="Shape">
        <img src="{{ asset('frontend/images/shape18.png') }}" alt="Shape">
    </div>
</div> -->
<!-- End Page Title -->

<!-- Single Product -->
<div class="product-details-area ptb-100">
    <div class="container mt-5">
        <h3>{{ $product->name }}</h3>
        <div class="top mt-5">
            <div class="row align-items-center">

                <div class="col-lg-8">
                    <div class="outer">
                        <div class="row">
                            <div class="col-sm-3 col-lg-3">
                                <div class="owl-thumbs" data-slider-id="1">
                                @if($product->singleProductLeftImages != null)
                                    <?php 
                                    foreach($product->singleProductLeftImages as $images){
                                        $file_type = mime_content_type('products/'.$images->image);
                                        $file_ext = explode('/', $file_type)[1];
                                        if($file_ext == 'mp4'){
                                    ?>
                                        <div class="item owl-thumb-item">
                                            <div class="top-img">
                                                <iframe width="170" height="100" src="{{URL::asset('products/'.$images->image)}}" sandbox>
                                                </iframe>
                                            </div>
                                        </div>
                                        <?php
                                        } else{ 
                                        ?>
                                        <div class="item owl-thumb-item">
                                            <div class="top-img">
                                                <img src="{{ url('products/'.$images->image) }}" alt="Product">
                                            </div>
                                        </div>
                                    <?php
                                        } 
                                    }
                                    ?>
                                @else
                                    <div class="item owl-thumb-item">
                                        <div class="top-img">
                                            <img src="{{ url('products/') }}" alt="Product">
                                        </div>
                                    </div>  
                                @endif
                                </div>
                            </div>

                            <div class="col-sm-9 col-lg-9">
                                <div class="image-slides owl-carousel owl-theme" data-slider-id="1">
                                @if($product->singleProductMainImages != null)
                                    <?php 
                                    foreach($product->singleProductMainImages as $multi_images){
                                        $file_type = mime_content_type('products/'.$multi_images->image);
                                        $file_ext = explode('/', $file_type)[1];
                                        if($file_ext == 'mp4'){
                                    ?>
                                        <div class="item">
                                            <div class="top-img">
                                                <iframe  width="480" height="380" src="{{URL::asset('products/'.$multi_images->image)}}" sandbox>
                                                </iframe >
                                            </div>
                                        </div>
                                        <?php
                                        } else{ 
                                        ?>
                                        <div class="item">
                                            <div class="top-img">
                                                <img src="{{ url('products/'.$multi_images->image) }}" alt="Product">
                                            </div>
                                        </div>
                                    <?php
                                        } 
                                    }
                                    ?>
                                @else
                                    <div class="item">
                                        <div class="top-img">
                                            <img src="{{ url('products/') }}" alt="Product">
                                        </div>
                                    </div>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="top-content">
                        <h6>{{ $product->name }}</h6>
                        <ul class="tag">
                            <li>{{ GoogleTranslate::trans('Item No:', app()->getLocale()) }} <span>{{ $product->sku }}</span></li>
                            <li>{{ GoogleTranslate::trans('Size:', app()->getLocale()) }} <span>{{ $product->size}} {{ $product->size_unit}}</span></li>
                            <li>{{ GoogleTranslate::trans('Color:', app()->getLocale()) }} <span>{{ $product->color}}</span></li>
                            <li>{{ GoogleTranslate::trans('Weight:', app()->getLocale()) }} <span>{{ $product->weight}} {{ $product->weight_unit}}</span></li>
                            @if(Auth::guard('member')->user())
                            <li>{{ GoogleTranslate::trans('Price Term:', app()->getLocale()) }} <span>{{ $product->price_term}}</span></li>
                            <li>{{ GoogleTranslate::trans('Price Per Quantity:', app()->getLocale()) }} <span>{{ $product->currency}} {{ $product->price}}{{ $product->price_per_unit}} <br>@if($product->price_per_quantity)({{ $product->price_per_quantity}}{{ $product->price_quantity_unit}})@endif</span></li>
                            @endif
                            <li>{{ GoogleTranslate::trans('Package/CTN:', app()->getLocale()) }} <span>{{ $product->inner_pack_qty}} {{ $product->inner_pack_unit}}, {{ $product->mid_pack_qty}} {{ $product->mid_pack_unit}}@if($product->big_pack_qty) @if($product->big_pack_qty > 1), {{ $product->big_pack_qty}} {{ $product->big_pack_unit}}@endif @else @endif</span></li>
                            <li>{{ GoogleTranslate::trans('Quantity/CTN:', app()->getLocale()) }} <span>{{ $product->quantity_ctn}} {{ $product->quantity_unit}}</span></li>
                            @if(Auth::guard('member')->user())
                            <li>{{ GoogleTranslate::trans('CTN/CBM (m3):', app()->getLocale()) }} <span>{{ $product->cbm_ctn }}</span></li>
                            <li>{{ GoogleTranslate::trans('G.W (kgs):', app()->getLocale()) }} <span>{{ $product->g_w }}</span></li>
                            @endif
                            <li>{{ GoogleTranslate::trans('MOQ:', app()->getLocale()) }} <span>{{ $product->moq }} {{ $product->moq_unit }}</span></li>
                            @if(Auth::guard('member')->user())
                            <li>{{ GoogleTranslate::trans('HS Code:', app()->getLocale()) }} <span>{{ $product->hs_code}}</span></li>
                            @endif
                            <li><a href="javascript:void(0)" onclick="addToCart('{{ $product->id }}')" style="color: black !important;">Add in inquiry cart <i style="color: green !important;" class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div class="bottom">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Description</a>
                </li>
                <!-- <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Reviews</a>
                </li> -->
                <!-- <li class="nav-item" role="presentation"> -->
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="bottom-description">
                        <span style="font-weight: 700 !important;">{{ GoogleTranslate::trans('Category', app()->getLocale()) }}</span> : <span>{{ $category }}</span><br>
                        <span style="font-weight: 700 !important;">{{ GoogleTranslate::trans('Sub-Category', app()->getLocale()) }}</span> : <span>{{ $sub_category }}</span>
                        <p>{{ $product->description }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- End Single Product -->
@endsection