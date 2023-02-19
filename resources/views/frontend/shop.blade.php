@extends('frontend.layout')
@section('page_title','Shop')
@section('content')

 <!-- Page Title -->
 <!-- <div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="title-content">
                    <h2>Shop</h2>
                    <ul>
                        <li>
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li>
                            <span>Shop</span>
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

<!-- Products -->
<div class="products-area ptb-100">
    <div class="container">
        <div class="row" style="margin-top: 20px !important;">
            <div style="display: flex; justify-content: flex-end;">
                {{ $product->links("pagination::bootstrap-4") }}
            </div>
            <div class="col-lg-12">
                <div id="Container" class="row">

                <div class="col-lg-12">
                <div id="Container" class="row">
                    @foreach($product as $val)
                        @if($val->image != null)
                            <?php 
                                $file_type = mime_content_type('products/'.$val->image->image);
                                $file_ext = explode('/', $file_type)[1];
                            ?>
                            @if($file_ext == 'mp4')
                            <div class="col-sm-6 col-lg-3 mix armchair center-table">
                                <div class="products-item">
                                    <div class="top">
                                        <a class="wishlist" href="javascript:void(0)" onclick="addToCart('{{ $val->id }}')">
                                            <i class='bx bx-plus'></i>
                                        </a>
                                        <video height="110px" controls>
                                            <source src="{{URL::asset('products/'.$val->image->image)}}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        <div class="inner">
                                            <!-- <h3>
                                                <a href="{{ url('/single-product/'.$val->id ) }}">{{ $val->sku }}</a>
                                            </h3> -->
                                            <a href="{{ url('/single-product/'.$val->id ) }}" style="color: black;"><span>{{ $val->name }}</span></a>
                                        </div>
                                    </div>
                                    <!-- <div class="bottom">
                                        <a class="cart-text" href="javascript:void(0)" onclick="addToCart('{{ $val->id }}')">Add in inquiry cart</a>
                                        <i class='bx bx-plus'></i>
                                    </div> -->
                                </div>
                            </div>
                            @else
                            <div class="col-sm-6 col-lg-3 mix armchair center-table">
                                <div class="products-item">
                                    <div class="top">
                                        <a class="wishlist" href="javascript:void(0)" onclick="addToCart('{{ $val->id }}')">
                                            <i class='bx bx-plus'></i>
                                        </a>
                                        <img src="{{ url('products/'.$val->image->image) }}" alt="Products">
                                        <div class="inner">
                                            <!-- <h3>
                                                <a href="{{ url('/single-product/'.$val->id ) }}">{{ $val->sku }}</a>
                                            </h3> -->
                                            <a href="{{ url('/single-product/'.$val->id ) }}" style="color: black;"><span>{{ $val->name }}</span></a>
                                        </div>
                                    </div>
                                    <!-- <div class="bottom">
                                        <a class="cart-text" href="javascript:void(0)" onclick="addToCart('{{ $val->id }}')">Add in inquiry cart</a>
                                        <i class='bx bx-plus'></i>
                                    </div> -->
                                </div>
                            </div>
                            @endif
                        @else
                            <div class="col-sm-6 col-lg-3 mix armchair center-table">
                                <div class="products-item">
                                    <div class="top">
                                        <a class="wishlist" href="javascript:void(0)" onclick="addToCart('{{ $val->id }}')">
                                            <i class='bx bx-plus'></i>
                                        </a>
                                        <img src="{{ url('products/') }}" alt="Products">
                                        <div class="inner">
                                            <!-- <h3>
                                                <a href="{{ url('/single-product/'.$val->id ) }}">{{ $val->sku }}</a>
                                            </h3> -->
                                            <a href="{{ url('/single-product/'.$val->id ) }}" style="color: black;"><span>{{ $val->name }}</span></a>
                                        </div>
                                    </div>
                                    <!-- <div class="bottom">
                                        <a class="cart-text" href="javascript:void(0)" onclick="addToCart('{{ $val->id }}')">Add in inquiry cart</a>
                                        <i class='bx bx-plus'></i>
                                    </div> -->
                                </div>
                            </div>
                        @endif
                    @endforeach 
                </div>
            </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection