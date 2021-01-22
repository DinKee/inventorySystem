<head>
    <meta charset="utf-8">
    <title>購貨訂單更新</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="Page-2.css" media="screen">
</head>

<?php
    require_once("dbconnect.inc");
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM purchase WHERE purchase_id = $id ";
        $result = mysqli_query($link, $sql);
        if (isset($result)){
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
        $purchase_id = $row["purchase_id"];
        $old_t_name_ch = $row["tea_type"];
        $origin_t_num = $row["tea_num"];

        // get old tea inventory
        $inv_sql = "SELECT * FROM tea_inventory WHERE tea_type = '$old_t_name_ch' ";
        $inv_result = mysqli_query($link, $inv_sql);
        if (isset($inv_result)){
            $inv_row = mysqli_fetch_array($inv_result, MYSQLI_ASSOC);
        }
        $inv_num = $inv_row["inventory_qty"];
        //clear old tea type first // avoid different tea type
        $update_num = $inv_num - $origin_t_num;
        $update_inventory_sql = "UPDATE tea_inventory SET inventory_qty = '$update_num' WHERE tea_type = '$old_t_name_ch'";
        if(mysqli_query($link, $update_inventory_sql)) {
        }else {
            echo "Error: " . $update_inventory_sql . "<br>" . $link->error;
        }
    }
    if (isset($_POST["update"])) {        

        $id = $_POST['purchase_id'];
        $t_name_ch = $_POST["teaName"];
        $t_num = $_POST["teaNum"];
        $t_price = 220 * $t_num;

        // get new tea inventory
        $inv_sql = "SELECT * FROM tea_inventory WHERE tea_type = '$t_name_ch' ";
        $inv_result = mysqli_query($link, $inv_sql);
        if (isset($inv_result)){
            $inv_row = mysqli_fetch_array($inv_result, MYSQLI_ASSOC);
        }
        $inv_num = $inv_row["inventory_qty"];

        $update_num = $inv_num + $t_num;
        $update_inventory_sql = "UPDATE tea_inventory SET inventory_qty = '$update_num' WHERE tea_type = '$t_name_ch'";
        mysqli_query($link, $update_inventory_sql);

        $update_purchase_sql = "UPDATE purchase  SET tea_type = '$t_name_ch', tea_num = '$t_num', tea_price = '$t_price' WHERE purchase_id = '$id' ";
        
        if (mysqli_query($link, $update_purchase_sql)) {
        echo "Record updated successfully";
        mysqli_close($link);
        header('Location: purchaseOrder.php'); 
        } else {
        echo "Error: " . $update_purchase_sql . "<br>" . $link->error;
        }
    }
    
?>

<section class="u-align-center u-clearfix u-section-2" id="sec-e399">
    <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <h2 class="u-text u-text-1">更新資料</h2>
        <div class="u-form u-form-1">
            <form action="purchase_edit.php" method="POST" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" style="padding: 10px" source="email" name="form">
                <div class="u-form-email u-form-group">
                    <label for="email-3b9a" class="u-form-control-hidden u-label">Email</label>
                    <input type="text" placeholder="訂單編號" value="<?php echo $purchase_id; ?>" readonly id="email-3b9a" name="purchase_id" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-2" required="">
                </div>
                <div class="u-form-group u-form-group-4">
                    <label for="text-6448" class="u-form-control-hidden u-label"></label>
                    <select name="teaName" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-5" value="茶種">
                        <option selected><?php echo $old_t_name_ch; ?></option>
                        <option>紅茶</option>
                        <option>綠茶</option>
                        <option>青茶</option>
                        <option>烏龍茶</option>
                        <option>古早味紅茶</option>
                        <option>古早味綠茶</option>
                        <option>高山茶</option>
                        <option>台灣茶</option>
                    </select>
                </div>
                <div class="u-form-group u-form-group-5">
                    <label for="text-a175" class="u-form-control-hidden u-label"></label>
                    <input type="number" placeholder="數量" value="<?php echo $origin_t_num; ?>" min="1" id="text-a175" name="teaNum" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-5">
                </div>
                <div class="u-align-center u-form-group u-form-submit">
                    <input type="submit" value="更新" class="u-btn u-btn-submit u-button-style" name="update">
                </div>
                <div class="u-form-send-message u-form-send-success"> Thank you! Your message has been sent. </div>
                <div class="u-form-send-error u-form-send-message"> Unable to send your message. Please fix errors then try again. </div>
                <input type="hidden" value="" name="recaptchaResponse">
            </form>
        </div>
    </div>
</section>

<?php require_once("dbclose.inc"); ?>