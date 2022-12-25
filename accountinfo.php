<?php
include './function/dbconnect.php';
$cus_id = $_SESSION["cus_id"];
$customer = new Customer($cus_id, "", "", "", "", "", "");
$result = $customer->searchCustomer($conn);
$row = $result->fetch_assoc();
$cus_name = $row["cus_name"];
$cus_gender = $row["cus_gender"];
$cus_phone = $row["cus_phone"];
$cus_email = $row["cus_email"];
$cus_imageURL = $row["cus_imageURL"];
?>
<div class="content" id="info">

    <div class="content-header"><h1>Personal Information</h1></div>

    <div class="content-body">
        <form class="form-horizontal" action="" method="post" id="formInfo" enctype="multipart/form-data">
            <div class="col-lg-8 col-md-8">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="info_name">Name</label>
                    <div class="col-sm-10"> 
                        <input type="text" class="form-control" id="info_name" name="info_name" required placeholder="Enter name" value="<?php echo $cus_name; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="info_email">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="info_email" name="info_email" required placeholder="Enter email" value="<?php echo $cus_email; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="info_phone">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="info_phone" name="info_phone" required placeholder="Enter phone number" value="<?php echo $cus_phone; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="info_gender">Gender</label>
                    <div class="col-sm-10" style="display: flex">
                        <div class="squaredcheck" style="flex: 1 0 auto;display: flex;flex-direction: column;padding-top: 7px">
                            <input type="radio" name="optradio" id="male" <?php if ($cus_gender == "Male") { ?> checked <?php } ?> value="Male">
                            <label for="male"><span>Male</span></label><br>
                        </div>
                        <div class="squaredcheck" style="flex: 1 0 auto;display: flex;flex-direction: column;padding-top: 7px">
                            <input type="radio" name="optradio" id="female" <?php if ($cus_gender == "Female") { ?> checked <?php } ?> value="Female">
                            <label for="female"><span>Female</span></label><br>
                        </div>
                        <div class="squaredcheck" style="flex: 1 0 auto;display: flex;flex-direction: column;padding-top: 7px">
                            <input type="radio" name="optradio" id="other" <?php if ($cus_gender == "Other") { ?> checked <?php } ?> value="Other">
                            <label for="other"><span>Other</span></label><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4" style="align-items: center; display: flex; flex-direction: column;">
                <div style="align-items: center; border-bottom: 2px solid #e8e8e8; padding-bottom: 10px; display: flex;">
                    <div style="overflow: hidden; width: 150px; height: 150px; border-radius: 50%; margin: auto;">
                        <?php
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['cus_imageURL']) . '" id="imageInfo" alt="alt"/>';
                        ?>
                    </div>
                </div>
                <!--<div style="">-->
                <input type="file" id="fileToUpload" name="imagefile" style="display: none" onchange="readURL(this)"><br>
                <input type="button" value="Choose A Photo" name="btnUpload" id="btnUpload">
                <!--</div>-->
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Save" id="submitInfo" name="submitInfo" class="btn btn-submit btn-bold" style="min-width: 132px">
                </div>
            </div>
        </form>
    </div>
</div>