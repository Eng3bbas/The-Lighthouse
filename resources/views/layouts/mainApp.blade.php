<html lang="en"><head>
    <title>{{str_replace('-',' ',env("APP_NAME"))}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sublime project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield("styles")
</head>
<body>

<div class="super_container">
    @include("includes.header")
    @yield("content")
    <div class="footer_overlay"></div>
    <footer class="footer">
        <div class="footer_background" style="background-image:url(images/footer.jpg)"></div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="footer_content d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                        <div class="footer_logo"><a href="#">Sublime.</a></div>
                        <div class="copyright ml-auto mr-auto"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright ©<script>document.write(new Date().getFullYear());</script>2020 All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
                        <div class="footer_social ml-lg-auto">
                            <ul>
                                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{asset("/js/jquery-3.2.1.min.js")}}"></script>
    <script src="{{asset("/styles/bootstrap4/popper.js")}}"></script>
    <script src="{{asset("/styles/bootstrap4/bootstrap.min.js")}}"></script>
    <script src="{{asset("/plugins/greensock/TweenMax.min.js")}}"></script>
    <script src="{{asset("/plugins/greensock/TimelineMax.min.js")}}"></script>
    <script src="{{asset("/plugins/scrollmagic/ScrollMagic.min.js")}}"></script>
    <script src="{{asset('/plugins/greensock/animation.gsap.min.js')}}"></script>
    <script src="{{asset("/plugins/greensock/ScrollToPlugin.min.js")}}"></script>
    <script src="{{asset("/plugins/OwlCarousel2-2.2.1/owl.carousel.js")}}"></script>
    <script src="{{asset("/plugins/Isotope/isotope.pkgd.min.js")}}"></script>
    <script src="{{asset("/plugins/easing/easing.js")}}"></script>
    <script src="{{asset("/plugins/parallax-js-master/parallax.min.js")}}"></script>
    <script src="{{asset("/js/custom.js")}}"></script>
</div>
</body>
</html>
