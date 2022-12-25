<?php
include './function/dbconnect.php';
include_once './model/categories_data.php';
$category = new Category("", "", "", "");
$result = $category->showAllCategories($conn);
?>
<div class="wrap-category xs-margin-top-80px sm-margin-top-50px">
    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            ?>
            <div class="biolife-title-box style-02 xs-margin-bottom-33px">
                <span class="subtitle">Hot Categories 2019</span>
                <h3 class="main-title">Our Categories</h3>
                <p class="desc">Natural food is taken from the world's most modern farms with strict safety
                    cycles</p>
            </div>

            <ul class="biolife-carousel nav-center-bold nav-none-on-mobile"
                data-slick='{"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":30,"slidesToShow":4, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 3}},{"breakpoint":992, "settings":{ "slidesToShow": 3}},{"breakpoint":768, "settings":{ "slidesToShow": 2}}, {"breakpoint":500, "settings":{ "slidesToShow": 1}}]}'>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                    <li>
                        <div class="biolife-cat-box-item">
                            <div class="cat-thumb">
                                <a href="product.php?category=<?php echo strtolower(str_replace(" ", "", $row["cate_name"])); ?>" class="cat-link">
                                    <img src="<?php echo $row["cate_imageURL"] ?>" width="277" height="185"
                                         alt="">
                                </a>
                            </div>
                            <a class="cat-info" href="product.php?category=<?php strtolower(str_replace(" ", "", $row["cate_name"])) ?>">
                                <h4 class="cat-name"><?php echo $row["cate_name"] ?></h4>
                                <?php
                                include './function/dbconnect.php';
                                include_once './model/product_data.php';
                                $product = new Product("", "", "", intval($row["cate_id"]), "", "", "", "", "");
                                $item = $product->countProductByCategory($conn);
                                ?>
                                <span class="cat-number">(<?php echo $item ?> items)</span>
                            </a>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <?php
        }
        ?>
        <div class="biolife-service type01 biolife-service__type01 sm-margin-top-25px xs-margin-top-65px">
            <ul class="services-list">
                <li>
                    <div class="service-inner">
                        <span class="number">1</span>
                        <span class="biolife-icon icon-beer"></span>
                        <a class="srv-name" href="#">full stamped product</a>
                    </div>
                </li>
                <li>
                    <div class="service-inner">
                        <span class="number">2</span>
                        <span class="biolife-icon icon-schedule"></span>
                        <a class="srv-name" href="#">place and delivery on time</a>
                    </div>
                </li>
                <li>
                    <div class="service-inner">
                        <span class="number">3</span>
                        <span class="biolife-icon icon-car"></span>
                        <a class="srv-name" href="#">Free shipping in the city</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>