<?php
include './function/dbconnect.php';
include_once './model/categories_data.php';
$category = new Category("", "", "", "");
$result = $category->showAllCategories($conn);
?>
<div class="header-middle biolife-sticky-object">
    <div class="container md-possition-relative">
        <div class="row">
            <div class="col-lg-3 col-md-2 col-md-6 col-xs-6">
                <a href="index.php?page=home" class="biolife-logo"><img src="assets/images/organic-3-green.png"
                                                                        alt="biolife logo" width="135" height="36"></a>
            </div>
            <div class="col-lg-6 col-md-7 hidden-sm hidden-xs">
                <div class="primary-menu">
                    <ul class="menu biolife-menu clone-main-menu clone-primary-menu" id="primary-menu"
                        data-menuname="main menu">
                        <li class="menu-item"><a href="index.php?page=home">Home</a></li>
                        <li class="menu-item"><a href="index.php?page=about">About Us</a></li>
                        <li class="menu-item menu-item-has-children has-child">
                            <a href="product.php" class="menu-name" data-title="Product">Product</a>
                            <ul class="sub-menu">
                                <li class="menu-item"><a href="product.php?category=freshfruits">Fresh Fruits</a></li>
                                <li class="menu-item"><a href="product.php?category=drinkfruits">Drink Fruits</a></li>
                                <li class="menu-item"><a href="product.php?category=vegetables">Vegetables</a></li>
                                <li class="menu-item"><a href="product.php?category=dryfruits">Dry Fruits</a></li>
                                <li class="menu-item"><a href="product.php?category=nutsandseeds">Nuts and Seeds</a></li>
                            </ul>
                        </li>
                        <li class="menu-item menu-item-has-children has-child">
                            <a href="#" class="menu-name" data-title="Shop">Shop</a>
                            <ul class="sub-menu">
                                <li class="menu-item"><a href="index.php?page=wishlist">Wishlist</a></li>
                                <li class="menu-item"><a href="index.php?page=cart">Shopping Cart</a></li>
                                <li class="menu-item"><a href="index.php?page=checkout">Check out</a></li>
                            </ul>
                        </li>
                        <li class="menu-item"><a href="index.php?page=contact">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-md-6 col-xs-6">
                <div class="biolife-cart-info">
                    <div class="mobile-search">
                        <a href="javascript:void(0)" class="open-searchbox"><i
                                class="biolife-icon icon-search"></i></a>
                        <div class="mobile-search-content">
                            <form action="#" class="form-search" name="mobile-seacrh" method="get">
                                <a href="#" class="btn-close"><span
                                        class="biolife-icon icon-close-menu"></span></a>
                                <input type="text" name="s" class="input-text" value=""
                                       placeholder="Search here...">
                                       <?php
                                       $result = $category->showAllCategories($conn);
                                       if ($result->num_rows > 0) {
                                           ?>
                                    <select name="category">
                                        <option value="all" selected>All Categories</option>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo strtolower(str_replace(" ", "", $row["cate_name"])); ?>"><?php echo $row["cate_name"] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <?php
                                }
                                ?>
                                <button type="submit" class="btn-submit">go</button>
                            </form>
                        </div>
                    </div>
                    <div class="wishlist-block hidden-sm hidden-xs">
                        <a href="index.php?page=wishlist" class="link-to" id="total_items_wishlist">
                        </a>
                    </div>
                    <div class="minicart-block" onmouseover="show_cart()">
                        <div class="minicart-contain">
                            <a href="javascript:void(0)" class="link-to" id="total_items">

                            </a>
                            <div class="cart-content">
                                <div class="cart-inner">
                                    <ul class="products" id="minicart_list">
                                        <li></li>
                                    </ul>
                                    <p class="btn-control">
                                        <a href="index.php?page=cart" class="btn view-cart">view cart</a>
                                        <a href="index.php?page=checkout" class="btn">checkout</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-toggle">
                        <a class="btn-toggle" data-object="open-mobile-menu" href="javascript:void(0)">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header-bottom hidden-sm hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="vertical-menu vertical-category-block">
                    <div class="block-title">
                        <span class="menu-icon">
                            <span class="line-1"></span>
                            <span class="line-2"></span>
                            <span class="line-3"></span>
                        </span>
                        <span class="menu-title">All departments</span>
                        <span class="angle" data-tgleclass="fa fa-caret-down"><i class="fa fa-caret-up"
                                                                                 aria-hidden="true"></i></span>
                    </div>
                    <div class="wrap-menu">
                        <ul class="menu">
                            <li class="menu-item"><a href="product.php?category=freshfruits" class="menu-name" data-title="Fresh Fruits"><i
                                        class="biolife-icon icon-fruits"></i>Fresh Fruits</a></li>
                            <li class="menu-item"><a href="product.php?category=drinkfruits" class="menu-name" data-title="Drink Fruits"><i
                                        class="biolife-icon icon-fresh-juice"></i>Drink Fruits</a></li>
                            <li class="menu-item"><a href="product.php?category=vegetables" class="menu-name" data-title="Vegetables"><i
                                        class="biolife-icon icon-broccoli-1"></i>Vegetables</a></li>
                            <li class="menu-item"><a href="#product.php?category=dryfruits" class="menu-name" data-title="Dry Fruits"><i
                                        class="biolife-icon icon-avocado"></i>Dry Fruits</a></li>
                            <li class="menu-item"><a href="product.php?category=nutsandseeds" class="menu-name" data-title="Nuts and Seeds"><i
                                        class="biolife-icon icon-contain"></i>Nuts and Seeds</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 padding-top-2px">
                <div class="header-search-bar layout-01">
                    <form action="" class="form-search" name="desktop-seacrh" method="get">
                        <input type="text" name="s" id="searchKeyword" class="input-text" value="" placeholder="Search here...">
                        <?php
                        include './function/dbconnect.php';
                        $result = $category->showAllCategories($conn);
                        if ($result->num_rows > 0) {
                            ?>
                            <select name="category">
                                <option value="all" selected>All Categories</option>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo strtolower(str_replace(" ", "", $row["cate_name"])); ?>"><?php echo $row["cate_name"] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php
                        }
                        ?>
                        <button type="button" onclick="search()" class="btn-submit"><i
                                class="biolife-icon icon-search"></i></button>
                    </form>
                </div>
                <div class="live-info">
                    <p class="telephone"><i class="fa fa-phone" aria-hidden="true"></i><b
                            class="phone-number">(+900) 123 456 7891</b></p>
                    <p class="working-time">Mon-Fri: 8:30am-7:30pm; Sat-Sun: 9:30am-4:30pm</p>
                </div>
            </div>
        </div>
    </div>
</div>