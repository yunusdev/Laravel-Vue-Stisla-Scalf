@extends('layouts.base')

@section('content')
    <!-- Main Slider-->
    <section class="hero-slider" style="background-image: url(img/hero-slider/main-bg.jpg);">
        <div class="owl-carousel large-controls dots-inside" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 7000 }">
            <div class="item">
                <div class="container padding-top-3x">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-5 col-md-6 padding-bottom-2x text-md-left text-center">
                            <div class="from-bottom"><img class="d-inline-block w-150 mb-4" src="img/hero-slider/logo02.png" alt="Puma">
                                <div class="h2 text-body text-normal mb-2 pt-1">Puma Backpacks Collection</div>
                                <div class="h2 text-body text-normal mb-4 pb-1">starting at <span class="text-bold">$37.99</span></div>
                            </div><a class="btn btn-primary scale-up delay-1" href="/shop">Shop Now</a>
                        </div>
                        <div class="col-md-6 padding-bottom-2x mb-3"><img class="d-block mx-auto" src="img/hero-slider/02.png" alt="Puma Backpack"></div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="container padding-top-3x">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-5 col-md-6 padding-bottom-2x text-md-left text-center">
                            <div class="from-bottom"><img class="d-inline-block w-200 mb-4" src="img/hero-slider/logo01.png" alt="Converse">
                                <div class="h2 text-body text-normal mb-2 pt-1">Chuck Taylor All Star II</div>
                                <div class="h2 text-body text-normal mb-4 pb-1">for only <span class="text-bold">$59.99</span></div>
                            </div><a class="btn btn-primary scale-up delay-1" href="/shop">Shop Now</a>
                        </div>
                        <div class="col-md-6 padding-bottom-2x mb-3"><img class="d-block mx-auto" src="img/hero-slider/01.png" alt="Chuck Taylor All Star II"></div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="container padding-top-3x">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-5 col-md-6 padding-bottom-2x text-md-left text-center">
                            <div class="from-bottom"><img class="d-inline-block mb-4" src="img/hero-slider/logo03.png" style="width: 125px;" alt="Motorola">
                                <div class="h2 text-body text-normal mb-2 pt-1">Smart Watch Moto 360 2nd</div>
                                <div class="h2 text-body text-normal mb-4 pb-1">for only <span class="text-bold">$299.99</span></div>
                            </div><a class="btn btn-primary scale-up delay-1" href="/shop">Shop Now</a>
                        </div>
                        <div class="col-md-6 padding-bottom-2x mb-3"><img class="d-block mx-auto" src="img/hero-slider/03.png" alt="Moto 360"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Top Categories-->
    <section class="container padding-top-3x">
        <h3 class="text-center mb-30">Top Categories</h3>
        <div class="row">
            @foreach($top_categories as $key => $category)
            <div class="col-md-4 col-sm-6">
                <div class="card mb-30">
                    <a class="card-img-tiles" href="{{route('category.products', $category->slug)}}">
                        <div class="inner">
                            <div class="main-img"><img style="height: 179px !important;" src="{{$category->top_products[0]->front_image}}" alt="Category"></div>
                            <div class="thumblist"><img style="height: 83px !important;" src="{{$category->top_products[1]->front_image}}" alt="Category">
                            <img style="height: 83px !important;" src="{{$category->top_products[2]->front_image}}" alt="Category"></div>
                        </div>
                    </a>
                    <div class="card-body text-center">
                        <h4 class="card-title">
                            <a class="text-decoration-none" href="{{route('category.products', $category->slug)}}">{{$category->name}}</a>
                        </h4>
                        <p class="text-muted">Starting from N5000</p><a class="btn btn-outline-primary btn-sm" href="{{route('category.products', $category->slug)}}">View Products</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center"><a class="btn btn-outline-secondary margin-top-none" href="shop-categories.html">All Categories</a></div>
    </section>
    <!-- Promo #1-->
    <section class="container-fluid padding-top-3x">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 mb-30">
                <div class="rounded bg-faded position-relative padding-top-3x padding-bottom-3x"><span class="product-badge text-danger" style="top: 24px; left: 24px;">Limited Offer</span>
                    <div class="text-center">
                        <h3 class="h2 text-normal mb-1">New</h3>
                        <h2 class="display-2 text-bold mb-2">Sunglasses</h2>
                        <h4 class="h3 text-normal mb-4">collection at discounted price!</h4>
                        <div class="countdown mb-3" data-date-time="12/30/2019 12:00:00">
                            <div class="item">
                                <div class="days">00</div><span class="days_ref">Days</span>
                            </div>
                            <div class="item">
                                <div class="hours">00</div><span class="hours_ref">Hours</span>
                            </div>
                            <div class="item">
                                <div class="minutes">00</div><span class="minutes_ref">Mins</span>
                            </div>
                            <div class="item">
                                <div class="seconds">00</div><span class="seconds_ref">Secs</span>
                            </div>
                        </div><br><a class="btn btn-primary margin-bottom-none" href="#">View Offers</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6 mb-30" style="min-height: 270px;">
                <div class="img-cover rounded" style="background-image: url(img/banners/home01.jpg);"></div>
            </div>
        </div>
    </section>
    <!-- Promo #2-->
    <section class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12">
                <div class="fw-section rounded padding-top-4x padding-bottom-4x" style="background-image: url(img/banners/home02.jpg);"><span class="overlay rounded" style="opacity: .35;"></span>
                    <div class="text-center">
                        <h3 class="display-4 text-normal text-white text-shadow mb-1">Old Collection</h3>
                        <h2 class="display-2 text-bold text-white text-shadow">HUGE SALE!</h2>
                        <h4 class="d-inline-block h2 text-normal text-white text-shadow border-default border-left-0 border-right-0 mb-4">at our outlet stores</h4><br><a class="btn btn-primary margin-bottom-none" href="contacts.html">Locate Stores</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Products Carousel-->
    <!-- Product Widgets-->

    <leading-products-home></leading-products-home>

    <!-- Popular Brands-->
    <section class="bg-faded padding-top-3x padding-bottom-3x">
        <div class="container">
            <h3 class="text-center mb-30 pb-2">Popular Brands</h3>
            <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: false, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 4000, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:2}, &quot;470&quot;:{&quot;items&quot;:3},&quot;630&quot;:{&quot;items&quot;:4},&quot;991&quot;:{&quot;items&quot;:5},&quot;1200&quot;:{&quot;items&quot;:6}} }"><img class="d-block w-110 opacity-75 m-auto" src="img/brands/01.png" alt="Adidas"><img class="d-block w-110 opacity-75 m-auto" src="img/brands/02.png" alt="Brooks"><img class="d-block w-110 opacity-75 m-auto" src="img/brands/03.png" alt="Valentino"><img class="d-block w-110 opacity-75 m-auto" src="img/brands/04.png" alt="Nike"><img class="d-block w-110 opacity-75 m-auto" src="img/brands/05.png" alt="Puma"><img class="d-block w-110 opacity-75 m-auto" src="img/brands/06.png" alt="New Balance"><img class="d-block w-110 opacity-75 m-auto" src="img/brands/07.png" alt="Dior"></div>
        </div>
    </section>
    <!-- Services-->
    <section class="container padding-top-3x padding-bottom-2x">
        <div class="row">
            <div class="col-md-3 col-sm-6 text-center mb-30"><img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="img/services/01.png" alt="Shipping">
                <h6>Free Worldwide Shipping</h6>
                <p class="text-muted margin-bottom-none">Free shipping for all orders over $100</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center mb-30"><img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="img/services/02.png" alt="Money Back">
                <h6>Money Back Guarantee</h6>
                <p class="text-muted margin-bottom-none">We return money within 30 days</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center mb-30"><img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="img/services/03.png" alt="Support">
                <h6>24/7 Customer Support</h6>
                <p class="text-muted margin-bottom-none">Friendly 24/7 customer support</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center mb-30"><img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="img/services/04.png" alt="Payment">
                <h6>Secure Online Payment</h6>
                <p class="text-muted margin-bottom-none">We posess SSL / Secure Certificate</p>
            </div>
        </div>
    </section>
    <!-- Site Footer-->

@endsection
<script>
    import LeadingProductsHome from "../js/components/User/Shop/LeadingProductsHome";
    export default {
        components: {LeadingProductsHome}
    }
</script>
