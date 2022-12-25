<?php
include './function/dbconnect.php';
include_once './model/address_data.php';
$cus_id = $_SESSION["cus_id"];
$address = new Address("", $cus_id, "", "", "", "", "");
$result = $address->showAdressByCustomer($conn);
?>
<div class="content" id="myAddress">
    <div class="content-header">
        <h1>My Address</h1>
    </div>
    <div class="content-body" style="text-align: right">
        <button type="button" name="addAddress" data-toggle="modal" data-target="#newAddress" class="btn btn-submit btn-bold" style="min-width: 132px; margin-bottom: 20px">Add New Address</button>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form class="shopping-cart-form" action="#" method="post">
            <table class="shop_table cart-form table table-striped">
                <thead>
                    <tr>
                        <th class="product-name">Name</th>
                        <th class="product-price">Phone Number</th>
                        <th class="product-quantity">City</th>
                        <th class="product-subtotal">Address</th>
                        <th class="product-subtotal">Edit</th>
                        <th class="product-subtotal">Delete</th>
                    </tr>
                </thead>
                <tbody id="address-table">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $add_id = $row["add_id"];
                        $add_name = $row["add_name"];
                        $add_phone = $row["add_phone"];
                        $add_city = $row["add_city"];
                        $add_detail = $row["add_detail"];
                        if ($row["add_status"] == 1) {
                            ?>
                            <tr class="address-info" id="<?php echo $add_id; ?>">
                                <td class="address-name" data-title="Name" style="text-align: left;">
                                    <div class="name name-contain">
                                        <span class="add_name">
                                            <?php echo $add_name; ?>
                                        </span>
                                    </div>
                                </td>
                                <td class="address-phone" data-title="Phone" style="text-align: right">
                                    <div class="phone phone-contain">
                                        <span class="add_phone">
                                            <?php echo $add_phone; ?>
                                        </span>
                                    </div>
                                </td>
                                <td class="address-city" data-title="City" style="text-align: left">
                                    <div class="city city-contain">
                                        <span class="add_city">
                                            <?php echo $add_city; ?>
                                        </span>
                                    </div>
                                </td>
                                <td class="address-detail" data-title="Detail" style="text-align: left">
                                    <div class="detail detail-contain">
                                        <span class="add_detail">
                                            <?php echo $add_detail; ?>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="action">
                                        <p id="edit-address" style="margin: 0px; cursor: pointer" data-toggle="modal" data-target="#editAddress"><i class="fa fa-pencil" aria-hidden="true"></i></p>
                                    </div>
                                </td>
                                <td>
                                    <div class="action">
                                        <p id="remove-address" class="remove" style="margin: 0px; cursor: pointer"><i class="fa fa-trash-o" aria-hidden="true"></i></p>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>
    <!-- The Add Modal -->
    <div class="modal fade" id="newAddress">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">New Address</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form class="form-horizontal" action="" method="post" style="width: 95%;">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="add_name">Name <span class="requite">*</span></label>
                            <div class="col-sm-10"> 
                                <input type="text" class="form-control" id="add_name" name="add_name" required placeholder="" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="add_phone">Phone <span class="requite">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="add_phone" name="add_phone" required placeholder="" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="add_city">City <span class="requite">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="add_city" name="add_city" required placeholder="" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="add_detail">Address <span class="requite">*</span></label>
                            <div class="col-sm-10">
                                <textarea id="add_detail" name="add_detail" rows="3" cols="" style="width: 100%"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" name="submitAdd" id="submitAddAddress" class="btn btn-submit btn-bold" onclick="addAddress(<?php echo $_SESSION["cus_id"]; ?>)" style="min-width: 132px">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- The Edit Modal -->
    <div class="modal fade" id="editAddress">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Address</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form class="form-horizontal" action="" method="post" onsubmit="return editAddress();" style="width: 95%;">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="edit_name">Name</label>
                            <div class="col-sm-10"> 
                                <input type="text" class="form-control" id="edit_name" name="edit_name" required placeholder="" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="edit_phone">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_phone" name="edit_phone" required placeholder="" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="edit_city">City</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_city" name="edit_city" required placeholder="" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="edit_detail">Address</label>
                            <div class="col-sm-10">
                                <textarea id="edit_detail" name="edit_detail" rows="3" cols="" style="width: 100%"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" name="submitEdit" id="submitEditAddress" class="btn btn-submit btn-bold" style="min-width: 132px" onclick="editAddress()">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>