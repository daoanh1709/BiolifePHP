<?php ?>
<div class="page-contain">

    <!-- Main content -->
    <div id="main-content" class="main-content">

        <!-- Block 01: Main slide block-->
        <div class="main-slide block-slider">
            <ul class="biolife-carousel nav-none-on-mobile"
                data-slick='{"arrows": true, "dots": false, "slidesMargin": 0, "slidesToShow": 1, "infinite": true, "speed": 800}'>
                <li>
                    <div class="slide-contain slider-opt03__layout01 mode-03 black-color slide-bgr-mode03-01">
                        <div class="media"></div>
                        <div class="text-content">
                            <i class="first-line">Pomegranate</i>
                            <h3 class="second-line">Fresh Juice. 100% Organic</h3>
                            <p class="third-line">A blend of freshly squeezed green apple & fruits</p>
                            <p class="buttons">
                                <a href="product.php" class="btn btn-thin">Shop now</a>
                            </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="slide-contain slider-opt03__layout01 mode-03 slide-bgr-mode03-02">
                        <div class="media">
                        </div>
                        <div class="text-content">
                            <i class="first-line">Pomegranate</i>
                            <h3 class="second-line">Fresh Juice. 100% Organic</h3>
                            <p class="third-line">A blend of freshly squeezed green apple & fruits</p>
                            <p class="buttons">
                                <a href="product.php" class="btn btn-thin">Shop now</a>
                            </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="slide-contain slider-opt03__layout01 mode-03 slide-bgr-mode03-03">
                        <div class="media">
                        </div>
                        <div class="text-content">
                            <i class="first-line">Pomegranate</i>
                            <h3 class="second-line">Fresh Juice. 100% Organic</h3>
                            <p class="third-line">A blend of freshly squeezed green apple & fruits</p>
                            <p class="buttons">
                                <a href="product.php" class="btn btn-thin">Shop now</a>
                            </p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <!--Block 02: Categories-->
        <?php
        include_once './homecategories.php';
        ?>

        <!-- Block 04: Featured Products-->
        <?php
        include_once './homeFeaturedProducts.php';
        ?>

        <!-- Block 05: Banner Promotion-->
        <div class="banner-promotion xs-margin-top-0 sm-margin-top-60px xs-margin-top-100">
            <div class="biolife-banner promotion6 biolife-banner__promotion6">
                <div class="banner-contain">
                    <div class="media">
                        <div class="img-moving position-1">
                            <a href="#" class="banner-link">
                                <img src="assets/images/home-01/bn-promotion-6-child-01.png" width="568"
                                     height="760" alt="img msv">
                            </a>
                        </div>
                        <div class="img-moving position-2">
                            <img src="assets/images/home-01/bn-promotion-6-child-02.png" width="745" height="682"
                                 alt="img msv">
                        </div>
                    </div>
                    <div class="text-content">
                        <i class="text1">Sumer Fruit</i>
                        <b class="text2">100% Pure Natural Fruit Juice</b>
                        <p class="buttons">
                            <a href="product.php" class="btn btn-thin">Shop Now</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        !<!-- Block 06: Deals Products -->
        <?php
        include_once './homeDealProducts.php';
        ?>

        <!-- Block 09: Instagram-->
        <div class="biolife-instagram-block sm-margin-top-76px xs-margin-top-60px">
            <div class="wrap-title xs-margin-bottom-60px-im sm-margin-bottom-35-im">
                <i class="subtitle hidden-xs">Use Top food for a chance to be featured</i>
                <h3 class="title">Follow us on instagram</h3>
            </div>
            <div class="instagram-inline-wrap">
                <ul class="biolife-carousel nav-none-on-mobile"
                    data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":6, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 6}},{"breakpoint":992, "settings":{ "slidesToShow": 5}},{"breakpoint":800, "settings":{ "slidesToShow": 4}},{"breakpoint":768, "settings":{ "slidesToShow": 3}},{"breakpoint":600, "settings":{ "slidesToShow": 2}},{"breakpoint":480, "settings":{"rows":2, "slidesToShow": 3}}]}'>
                    <li>
                        <div class="instagram-ltl-item">
                            <a href="#" class="link-to">
                                <span class="show-on-hover biolife-icon icon-capacity-about"></span>
                                <img src="assets/images/home-02/instag-inline-01.jpg" width="320" height="320"
                                     alt="">
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="instagram-ltl-item">
                            <a href="#" class="link-to">
                                <span class="show-on-hover biolife-icon icon-fresh-drink"></span>
                                <img src="assets/images/home-02/instag-inline-02.jpg" width="320" height="320"
                                     alt="">
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="instagram-ltl-item">
                            <a href="#" class="link-to">
                                <span class="show-on-hover biolife-icon icon-green-safety"></span>
                                <img src="assets/images/home-02/instag-inline-03.jpg" width="320" height="320"
                                     alt="">
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="instagram-ltl-item">
                            <a href="#" class="link-to">
                                <span class="show-on-hover biolife-icon icon-healthy-about"></span>
                                <img src="assets/images/home-02/instag-inline-04.jpg" width="320" height="320"
                                     alt="">
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="instagram-ltl-item">
                            <a href="#" class="link-to">
                                <span class="show-on-hover biolife-icon icon-honey"></span>
                                <img src="assets/images/home-02/instag-inline-05.jpg" width="320" height="320"
                                     alt="">
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="instagram-ltl-item">
                            <a href="#" class="link-to">
                                <span class="show-on-hover biolife-icon icon-fruits"></span>
                                <img src="assets/images/home-02/instag-inline-06.jpg" width="320" height="320"
                                     alt="">
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="instagram-ltl-item">
                            <a href="#" class="link-to">
                                <span class="show-on-hover biolife-icon icon-broccoli-1"></span>
                                <img src="assets/images/home-02/instag-inline-07.jpg" width="320" height="320"
                                     alt="">
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="instagram-ltl-item">
                            <a href="#" class="link-to">
                                <span class="show-on-hover biolife-icon icon-grape"></span>
                                <img src="assets/images/home-02/instag-inline-08.jpg" width="320" height="320"
                                     alt="">
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="instagram-ltl-item">
                            <a href="#" class="link-to">
                                <span class="show-on-hover biolife-icon icon-avocado"></span>
                                <img src="assets/images/home-02/instag-inline-09.jpg" width="320" height="320"
                                     alt="">
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="instagram-ltl-item">
                            <a href="#" class="link-to">
                                <span class="show-on-hover biolife-icon icon-fresh-juice"></span>
                                <img src="assets/images/home-02/instag-inline-10.jpg" width="320" height="320"
                                     alt="">
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Block 10: Brands-->
        <div class="brand-slide sm-margin-top-76px sm-margin-bottom-77px xs-margin-top-80px xs-margin-bottom-80px">
            <div class="container">
                <ul class="biolife-carousel nav-center-bold nav-none-on-mobile"
                    data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":30,"slidesToShow":4, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin": 10}},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin": 10}}]}'>
                    <li>
                        <div class="biolife-brd-container transparent-effect">
                            <a href="#" class="link">
                                <figure><img src="assets/images/home-01/brd-01.png" width="199" height="110" alt="">
                                </figure>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="biolife-brd-container transparent-effect">
                            <a href="#" class="link">
                                <figure><img src="assets/images/home-01/brd-02.png" width="199" height="110" alt="">
                                </figure>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="biolife-brd-container transparent-effect">
                            <a href="#" class="link">
                                <figure><img src="assets/images/home-01/brd-03.png" width="199" height="110" alt="">
                                </figure>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="biolife-brd-container transparent-effect">
                            <a href="#" class="link">
                                <figure><img src="assets/images/home-01/brd-04.png" width="199" height="110" alt="">
                                </figure>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="biolife-brd-container transparent-effect">
                            <a href="#" class="link">
                                <figure><img src="assets/images/home-01/brd-01.png" width="199" height="110" alt="">
                                </figure>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="biolife-brd-container transparent-effect">
                            <a href="#" class="link">
                                <figure><img src="assets/images/home-01/brd-02.png" width="199" height="110" alt="">
                                </figure>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="biolife-brd-container transparent-effect">
                            <a href="#" class="link">
                                <figure><img src="assets/images/home-01/brd-03.png" width="199" height="110" alt="">
                                </figure>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="biolife-brd-container transparent-effect">
                            <a href="#" class="link">
                                <figure><img src="assets/images/home-01/brd-04.png" width="199" height="110" alt="">
                                </figure>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </div>

</div>