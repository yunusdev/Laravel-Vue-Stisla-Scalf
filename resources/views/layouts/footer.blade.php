<footer class="site-footer">
    <div class="container">
{{--        <hr class="hr-light mt-2 margin-bottom-2x">--}}
        <div class="row justify-content-center">
{{--            <div class="col-lg-3 padding-bottom-1x">--}}
{{--                <!-- Payment Methods-->--}}
{{--                <div class="margin-bottom-1x" style="max-width: 615px;"><img src="img/payment_methods.png" alt="Payment Methods">--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-lg-4 padding-bottom-1x">
                <!-- Contact Info-->
                <section class="widget widget-light-skin">
                    <h3 class="widget-title">Get In Touch With Us</h3>
                    <p class="text-white">Phone: 00 33 169 7720</p>
                    <ul class="list-unstyled text-sm text-white">
                        <li><span class="opacity-50">Monday-Friday:</span>9.00 am - 8.00 pm</li>
                        <li><span class="opacity-50">Saturday:</span>10.00 am - 6.00 pm</li>
                    </ul>
                    <p><a class="navi-link-light" href="#">support@unishop.com</a></p><a class="social-button shape-circle sb-facebook sb-light-skin" href="#"><i class="socicon-facebook"></i></a><a class="social-button shape-circle sb-twitter sb-light-skin" href="#"><i class="socicon-twitter"></i></a><a class="social-button shape-circle sb-instagram sb-light-skin" href="#"><i class="socicon-instagram"></i></a><a class="social-button shape-circle sb-google-plus sb-light-skin" href="#"><i class="socicon-googleplus"></i></a>
                </section>
            </div>
            <div class="col-lg-4 padding-bottom-1x">
                <section class="widget widget-links widget-light-skin">
                    <h3 class="widget-title">Links</h3>
                    <ul>
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('/shop')}}">Shop</a></li>
                        <li><a href="{{url('/cart')}}">Cart</a></li>
                        @auth
                            <li><a href="{{url('/account/orders')}}">Orders</a></li>
                        @elseauth
                            <li><a href="{{url('/login')}}">Login</a></li>
                            <li><a href="{{url('/register')}}">Register</a></li>
                        @endauth
                    </ul>
                </section>
            </div>
            <div class="col-lg-4 padding-bottom-1x">
                <!-- Contact Info-->
                <section class="widget widget-light-skin">
                    <h3 class="widget-title">Get In Touch With Us</h3>
                    <p class="text-white">Phone: 00 33 169 7720</p>
                    <ul class="list-unstyled text-sm text-white">
                        <li><span class="opacity-50">Monday-Friday:</span>9.00 am - 8.00 pm</li>
                        <li><span class="opacity-50">Saturday:</span>10.00 am - 6.00 pm</li>
                    </ul>
                    <p><a class="navi-link-light" href="#">support@unishop.com</a></p><a class="social-button shape-circle sb-facebook sb-light-skin" href="#"><i class="socicon-facebook"></i></a><a class="social-button shape-circle sb-twitter sb-light-skin" href="#"><i class="socicon-twitter"></i></a><a class="social-button shape-circle sb-instagram sb-light-skin" href="#"><i class="socicon-instagram"></i></a><a class="social-button shape-circle sb-google-plus sb-light-skin" href="#"><i class="socicon-googleplus"></i></a>
                </section>
            </div>



            {{--            <div class="col-md-5 padding-bottom-1x">--}}

        </div>
        <!-- Copyright-->
        <p class="footer-copyright">© All rights reserved. Made with &nbsp;<i class="icon-heart text-danger"></i><a href="http://rokaux.com/" target="_blank"> &nbsp;by yunusdev</a></p>
    </div>
</footer>
