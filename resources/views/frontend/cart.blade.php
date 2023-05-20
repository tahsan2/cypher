@extends('frontend.master')

@section('content')
<!-- ======================= Top Breadcrubms ======================== -->
<div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Support</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ======================= Top Breadcrubms ======================== -->

<!-- ======================= Product Detail ======================== -->
<section class="middle">
    <div class="container">
    
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="text-center d-block mb-5">
                    <h2>Shopping Cart</h2>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-between">
            <div class="col-12 col-lg-7 col-md-12">
                <form action="{{route('cart.update')}}" method="POST">
                    @csrf
                    
                <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">
                    @php
                        $sub_total = 0;
                    @endphp
                    @foreach ($carts as $cart)
                    <li class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-3">
                                <!-- Image -->
                                <a href="product.html"><img src="{{asset('uploads/product/preview')}}/{{$cart->rel_to_product->preview}}" alt="..." class="img-fluid"></a>
                            </div>
                            <div class="col d-flex align-items-center justify-content-between">
                                <div class="cart_single_caption pl-2">
                                    <h4 class="product_title fs-md ft-medium mb-1 lh-1">{{$cart->rel_to_product->product_name}}</h4>
                                    <p class="mb-1 lh-1"><span class="text-dark">Size: {{$cart->rel_to_size->size_name}}</span></p>
                                    <p class="mb-3 lh-1"><span class="text-dark">Color: {{$cart->rel_to_color->color_name}}</span></p>
                                    <h4 class="fs-md ft-medium mb-3 lh-1">&#2547;{{$cart->rel_to_product->after_discount}}</h4>
                                    <select class="mb-2 custom-select w-auto" name="quantity[{{$cart->id}}]">
                                        @for ($i=1;$i<=10;$i++)
                                        <option value="{{$i}}" {{$cart->quantity==$i?'selected':''}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="fls_last"><a href="{{route('remove.cart', $cart->id)}}" class="close_slide gray"><i class="ti-close"></i></a></div>
                            </div>
                        </div>
                    </li>
                    @php
                        $sub_total += $cart->rel_to_product->after_discount*$cart->quantity;
                    @endphp
                    @endforeach
                </ul>
                
                <div class="row align-items-end justify-content-between mb-10 mb-md-0">
                    
                    <div class="col-12 col-md-auto mfliud">
                        <button class="btn stretched-link borders">Update Cart</button>
                    </div>
                </form>
                </div>
            </div>
            
            <div class="col-12 col-md-12 col-lg-4">
                <div class="mb-2">
                    @if ($mesg)
                        <div class="alert alert-danger">{{$mesg}}</div>
                    @endif
                    <form class="mb-7 mb-md-0" action="{{route('cart')}}" method="GET">
                        <label class="fs-sm ft-medium text-dark">Coupon code:</label>
                        <div class="row form-row">
                            <div class="col">
                              <input name="coupon_name" class="form-control" type="text" placeholder="Enter coupon code*" value="{{@$_GET['coupon_name']}}">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-dark" type="submit">Apply</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card mb-4 gray mfliud">
                  <div class="card-body">
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Subtotal</span> <span class="ml-auto text-dark ft-medium">&#2547;{{$sub_total}}</span>
                      </li>
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Discount</span> <span class="ml-auto text-dark ft-medium">
                           @php
                               if($type == 1){
                                    $after_discount = $sub_total*$discount/(100);
                               }
                               else{
                                  $after_discount = $discount;
                               }
                           @endphp
                           &#2547;{{$after_discount}}
                        </span>
                      </li>
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Total</span> <span class="ml-auto text-dark ft-medium">&#2547;{{$sub_total - $after_discount}}</span>
                      </li>
                      <li class="list-group-item fs-sm text-center">
                        Shipping cost calculated at Checkout *
                      </li>
                    </ul>
                  </div>
                </div>
                @php
                    session([
                        'discount'=>$after_discount,
                    ])
                @endphp
                <a class="btn btn-block btn-dark mb-3" href="{{route('checkout')}}">Proceed to Checkout</a>
                
                <a class="btn-link text-dark ft-medium" href="{{route('index')}}">
                  <i class="ti-back-left mr-2"></i> Continue Shopping
                </a>
            </div>
            
        </div>
        
    </div>
</section>
<!-- ======================= Product Detail End ======================== -->
@endsection