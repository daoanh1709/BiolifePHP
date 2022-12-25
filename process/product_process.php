<?php
include '../function/dbconnect.php';
include_once '../model/categories_data.php';
$currentCate;
$currentCateID = null;
//if (isset($_GET["category"])) {
    $cate = $_GET["category"];
    $category = new Category("", "", "", "");
    $result = $category->showAllCategories($conn);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (strtolower(str_replace(" ", "", $row["cate_name"])) == $cate) {
                $currentCate = $row["cate_name"];
                $currentCateID = $row["cate_id"];
            }
        }
    }
//}
?>
<?php
include '../function/dbconnect.php';
include_once '../model/product_data.php';
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno - 1) * $no_of_records_per_page;
$total_rows;
$total_pages;
$result1;
if ($currentCateID != null) {
    $total_pages_sql = "SELECT COUNT(*) FROM product WHERE cate_id = '" . $currentCateID . "'";
    include '../function/dbconnect.php';
    $result2 = mysqli_query($conn, $total_pages_sql);
    $total_rows = mysqli_fetch_array($result2)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    $product = new Product("", "", "", $currentCateID, "", "", "", "", "");
    $result1 = $product->showProductByCategory($conn, $offset, $no_of_records_per_page);
} else {
    $total_pages_sql = "SELECT COUNT(*) FROM product";
    include '../function/dbconnect.php';
    $result2 = mysqli_query($conn, $total_pages_sql);
    $total_rows = mysqli_fetch_array($result2)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    $product = new Product("", "", "", "", "", "", "", "", "");
    $result1 = $product->showAllProduct($conn, $offset, $no_of_records_per_page);
}
?>
<div class="product-category grid-style">

    <div id="top-functions-area" class="top-functions-area">
        <div class="flt-item to-left group-on-mobile">

        </div>
        <div class="flt-item to-right">
            <span class="flt-title">Sort</span>
            <div class="wrap-selectors">
                <div class="selector-item orderby-selector">
                    <select name="orderby" class="orderby" aria-label="Shop order">
                        <option value="menu_order" selected="selected">Default sorting</option>
                        <option value="price-asc">Price: low to high</option>
                        <option value="price-desc">Price: high to low</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php
        if ($result1->num_rows > 0) {
            ?>
            <ul class="products-list">
                <?php
                while ($row = $result1->fetch_assoc()) {
                    include '../function/dbconnect.php';
                    include_once '../model/product_data.php';
                    $product = new Product($row["pro_id"], "", "", "", "", "", "", "", "");
                    $cateName = $product->getCategoryNameByProductID($conn);
                    ?>
                    <li class="product-item col-lg-4 col-md-4 col-sm-4 col-xs-6" id="hello">
                        <div class="contain-product layout-default">
                            <div class="product-thumb">
                                <a href="productdetails.php?id=<?php echo $row["pro_id"]; ?>" class="link-to-product">
                                    <img src="<?php echo $row["pro_imageURL"]; ?>" alt="dd" width="270"
                                         height="270" class="product-thumnail">
                                </a>
                            </div>
                            <div class="info">
                                <b class="categories"><?php echo $cateName; ?></b>
                                <h4 class="product-title"><a href="productdetails.php?id=<?php echo $row["pro_id"]; ?>" class="pr-name"><?php echo $row["pro_name"]; ?></a></h4>
                                <?php
                                include '../function/dbconnect.php';
                                include_once '../model/deal_data.php';
                                $deal = new Deal("", "", "", "", "");
                                $result2 = $deal->showEnableDeals($conn);
                                $unitprice = $row["pro_unitprice"];
                                $discount = null;
                                if ($result2->num_rows > 0) {
                                    while ($row1 = $result2->fetch_assoc()) {
                                        if ($row1["pro_id"] == $row["pro_id"]) {
                                            $discount = number_format($unitprice - $unitprice * floatval($row1["deal_discount"]), 2, '.', '');
                                        }
                                    }
                                }
                                ?>
                                <div class="price">
                                    <?php
                                    $price;
                                    if ($discount != null) {
                                        $price = doubleval($discount);
                                        ?>
                                        <ins><span class="price-amount"><span
                                                    class="currencySymbol">$</span><?php echo $discount; ?></span></ins>
                                        <del><span class="price-amount"><span
                                                    class="currencySymbol">$</span><?php echo $unitprice; ?></span></del>
                                            <?php
                                        } else {
                                            $price = $unitprice;
                                            ?>
                                        <ins><span class="price-amount"><span
                                                    class="currencySymbol">$</span><?php echo $unitprice; ?></span></ins>
                                            <?php
                                        }
                                        ?>
                                </div>
                                <div class="shipping-info">
                                    <p class="shipping-day">3-Day Shipping</p>
                                </div>
                                <div class="slide-down-box">
                                    <p class="message">All products are carefully selected to ensure food
                                        safety.</p>
                                    <div class="buttons">
                                        <a href="javascript:wishlist(<?php echo $row["pro_id"]; ?>, <?php echo $price; ?>, 'add')" class="btn wishlist-btn"><i class="fa fa-heart"
                                                                                                                                                               aria-hidden="true"></i></a>
                                        <a href="javascript:cart(<?php echo $row["pro_id"]; ?>, <?php echo $price; ?>, 'add', 1)" class="btn add-to-cart-btn"><i
                                                class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to
                                            cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <?php
        }
        ?>
    </div>

    <div class="biolife-panigations-block">
        <ul class="biolife-panigations-block" style="border: none">
            <!--<li><a href="?pageno=1" class="link-page current-page">First</a></li>-->
            <?php
            $pagLink = "";
            if ($pageno >= 2) {
                echo "<li><a href='' class='link-page' id='" . ($pageno - 1) . "'>  Prev </a></li>";
            }

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $pageno) {
                    $pagLink .= "<li><a class='link-page' id='" . $i . "' href=''><span class=current-page>" . $i . " </span></a></li>";
                } else {
                    $pagLink .= "<li><a class='link-page' id='" . $i . "' href=''> " . $i . " </a></li>";
                }
            };
            echo $pagLink;
            if ($pageno < $total_pages) {
                echo "<li><a href='' class='link-page' id='" . ($pageno + 1) . "'>  Next </a></li>";
            }
            ?>
        </ul>
    </div>

</div>