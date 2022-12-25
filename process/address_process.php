<?php

session_start();
include '../function/dbconnect.php';
include_once '../model/address_data.php';

// Add New Address
if (isset($_GET['action']) && $_GET['action'] == "add") {
    $id = $_GET["id"];
    $name = $_GET["name"];
    $phone = $_GET["phone"];
    $city = $_GET["city"];
    $address = $_GET["address"];

    $add_obj = new Address("", $id, $name, $phone, $city, $address, "");
    $addressID = $add_obj->getAddressElement($conn) + 1;
    $add_obj->setAddressID($addressID);
    include '../function/dbconnect.php';
    if ($add_obj->insertAddress($conn) == false) {
        echo 'failed';
        exit();
    } else {
        include '../function/dbconnect.php';
        $cus_id = $_SESSION["cus_id"];
        $address = new Address("", $cus_id, "", "", "", "", "");
        $result = $address->showAdressByCustomer($conn);
        while ($row = $result->fetch_assoc()) {
            $add_id = $row["add_id"];
            $add_name = $row["add_name"];
            $add_phone = $row["add_phone"];
            $add_city = $row["add_city"];
            $add_detail = $row["add_detail"];
            if ($row["add_status"] == 1) {
                echo '<tr class="address-info" id="' . $add_id . '">
                            <td class="address-name" data-title="Name" style="text-align: left;">
                                <div class="name name-contain">
                                    <span class="add_name">
                                        ' . $add_name . '
                                    </span>
                                </div>
                            </td>
                            <td class="address-phone" data-title="Phone" style="text-align: right">
                                <div class="phone phone-contain">
                                    <span class="add_phone">
                                        ' . $add_phone . '
                                    </span>
                                </div>
                            </td>
                            <td class="address-city" data-title="City" style="text-align: left">
                                <div class="city city-contain">
                                    <span class="add_city">
                                        ' . $add_city . '
                                    </span>
                                </div>
                            </td>
                            <td class="address-detail" data-title="Detail" style="text-align: left">
                                <div class="detail detail-contain">
                                    <span class="add_detail">
                                        ' . $add_detail . '
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
                        </tr>';
            }
        }
        exit();
    }
}

// Edit Address
if (isset($_GET['action']) && $_GET['action'] == "edit") {
    $id = $_GET["id"];
    $name = $_GET["name"];
    $phone = $_GET["phone"];
    $city = $_GET["city"];
    $address = $_GET["address"];

    $add_obj = new Address($id, "", $name, $phone, $city, $address, "");
    if ($add_obj->updateAddress($conn) == false) {
        echo 'failed';
        exit();
    } else {
        include '../function/dbconnect.php';
        $cus_id = $_SESSION["cus_id"];
        $address = new Address("", $cus_id, "", "", "", "", "");
        $result = $address->showAdressByCustomer($conn);
        while ($row = $result->fetch_assoc()) {
            $add_id = $row["add_id"];
            $add_name = $row["add_name"];
            $add_phone = $row["add_phone"];
            $add_city = $row["add_city"];
            $add_detail = $row["add_detail"];
            if ($row["add_status"] == 1) {
                echo '<tr class="address-info" id="' . $add_id . '">
                            <td class="address-name" data-title="Name" style="text-align: left;">
                                <div class="name name-contain">
                                    <span class="add_name">
                                        ' . $add_name . '
                                    </span>
                                </div>
                            </td>
                            <td class="address-phone" data-title="Phone" style="text-align: right">
                                <div class="phone phone-contain">
                                    <span class="add_phone">
                                        ' . $add_phone . '
                                    </span>
                                </div>
                            </td>
                            <td class="address-city" data-title="City" style="text-align: left">
                                <div class="city city-contain">
                                    <span class="add_city">
                                        ' . $add_city . '
                                    </span>
                                </div>
                            </td>
                            <td class="address-detail" data-title="Detail" style="text-align: left">
                                <div class="detail detail-contain">
                                    <span class="add_detail">
                                        ' . $add_detail . '
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
                        </tr>';
            }
        }
        exit();
    }
}

if (isset($_GET['action']) && $_GET['action'] == "remove") {
    $id = $_GET["id"];

    $add_obj = new Address($id, "", "", "", "", "", "");
    if ($add_obj->deleteAddress($conn) == false) {
        echo 'failed';
        exit();
    } else {
        include '../function/dbconnect.php';
        $cus_id = $_SESSION["cus_id"];
        $address = new Address("", $cus_id, "", "", "", "", "");
        $result = $address->showAdressByCustomer($conn);
        while ($row = $result->fetch_assoc()) {
            $add_id = $row["add_id"];
            $add_name = $row["add_name"];
            $add_phone = $row["add_phone"];
            $add_city = $row["add_city"];
            $add_detail = $row["add_detail"];
            if ($row["add_status"] == 1) {
                echo '<tr class="address-info" id="' . $add_id . '">
                            <td class="address-name" data-title="Name" style="text-align: left;">
                                <div class="name name-contain">
                                    <span class="add_name">
                                        ' . $add_name . '
                                    </span>
                                </div>
                            </td>
                            <td class="address-phone" data-title="Phone" style="text-align: right">
                                <div class="phone phone-contain">
                                    <span class="add_phone">
                                        ' . $add_phone . '
                                    </span>
                                </div>
                            </td>
                            <td class="address-city" data-title="City" style="text-align: left">
                                <div class="city city-contain">
                                    <span class="add_city">
                                        ' . $add_city . '
                                    </span>
                                </div>
                            </td>
                            <td class="address-detail" data-title="Detail" style="text-align: left">
                                <div class="detail detail-contain">
                                    <span class="add_detail">
                                        ' . $add_detail . '
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
                        </tr>';
            }
        }
        exit();
    }
}