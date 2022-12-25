<?php
include '../../function/dbconnect.php';
include_once '../../model/orderdetails_data.php';
if (isset($_GET['action']) && $_GET['action'] == "view") {
    $id = $_GET['id'];
    $orderDetail = new OrderDetails($id, "", "", "");
    $result = $orderDetail->searchOrderDetailsByID($conn);
    include '../../function/dbconnect.php';
    include_once '../../model/order_data.php';
    $order = new Order($id, "", "", "", "", "", "");
    $result1 = $order->searchAddressOfOrder($conn);
    $row1 = $result1->fetch_assoc();
    ?>
    
    <div class="">
        <b class="stt-name" style="display: inline-block; font-size: 14px; line-height: 30px; color: #222222; font-weight: 700; text-transform: uppercase">Delivery Address</b>
        <p class="txt-desc"><span id="nameAddress"><?php echo $row1["add_name"]; ?></span></p>
        <p class="txt-desc"><span id="phoneAddress"><?php echo $row1["add_phone"]; ?></span></p>
        <p class="txt-desc"><span id="addressAdd"><?php echo $row1["add_detail"]; ?></span></p>
    </div>
    <div class="">
        <b class="stt-name" style="display: inline-block; font-size: 14px; line-height: 30px; color: #222222; font-weight: 700; text-transform: uppercase">Order Details</b>
    </div>
    <table class="table table-bordered table-striped mb-none" id="datatable-default">
        <thead>
            <tr>
                <th style="text-align: center">#</th>
                <th style="text-align: center">Product Name</th>
                <th style="text-align: center">Image</th>
                <th style="text-align: center">Price</th>
                <th style="text-align: center">Quantity</th>
                <th style="text-align: center">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $i++;
                include '../../function/dbconnect.php';
                include_once '../../model/product_data.php';
                $product = new Product($row["pro_id"], "", "", "", "", "", "", "", "");
                $result1 = $product->searchProductByID($conn);
                $row1 = $result1->fetch_assoc();
                $imgURL = "../" . $row1["pro_imageURL"];
                ?>
                <tr class="gradeC">
                    <td class="item" style="text-align: center"><?php echo $i; ?></td>
                    <td class="item" style="text-align: center"><?php echo $row1["pro_name"]; ?></td>
                    <td class="item" style="text-align: center"><img src="<?php echo $imgURL; ?>" width="50px" height="50px" alt="alt"/></td>
                    <td class="item" style="text-align: center">$ <?php echo $row["unitprice"]; ?></td>
                    <td class="item" style="text-align: center"><?php echo $row["quantity"]; ?></td>
                    <td class="item" style="text-align: center">$ <?php echo $row["quantity"] * $row["unitprice"]; ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>