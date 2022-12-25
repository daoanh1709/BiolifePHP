<section role="main" class="content-body">
    <header class="page-header">
        <h2>Dashboard</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="homeadmin.php">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Dashboard</span></li>
            </ol>

            <a class="sidebar-right-toggle" style="cursor: unset"></a>
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-md-6 col-lg-12 col-xl-6">
            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-secondary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-secondary">
                                        <i class="fa fa-usd"></i>
                                    </div>
                                </div>
                                <?php
                                include '../function/dbconnect.php';
                                include_once '../model/order_data.php';
                                $totalProfit = 0;
                                $order = new Order("", "", "", "", "", "", "");
                                $result = $order->showAllOrders($conn);
                                if ($result->num_rows > 0) {
                                    $total = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        include '../function/dbconnect.php';
                                        include_once '../model/orderdetails_data.php';
                                        $orderDetail = new OrderDetails($row["ord_id"], "", "", "");
                                        $result1 = $orderDetail->searchOrderDetailsByID($conn);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            $total = $total + $row1["unitprice"] * $row1["quantity"];
                                        }
                                        $totalProfit = $totalProfit + $total;
                                    }
                                }
                                ?>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Total Profit</h4>
                                        <div class="info">
                                            <strong class="amount">$ <?php echo $totalProfit; ?></strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-tertiary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-tertiary">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                </div>
                                <?php
                                include '../function/dbconnect.php';
                                $order1 = new Order("", "", "", "", "", "", "");
                                $result1 = $order1->getTodayOrders($conn);
                                $num = $result1->num_rows;
                                ?>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Today's Orders</h4>
                                        <div class="info">
                                            <strong class="amount"><?php echo $num; ?></strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>