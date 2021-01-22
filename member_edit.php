<head>
    <meta charset="utf-8">
    <title>會員資料更新</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="Page-2.css" media="screen">
</head>

<?php
    require_once("dbconnect.inc");
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];      
        $sql = "SELECT * FROM member WHERE m_id = $id ";
        $result = mysqli_query($link, $sql);
        if (isset($result)){
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
        $m_id = $row["m_ID"];
        $name = $row["m_name"];
        $tel = $row["m_tel"];
        $address = $row["m_address"];
    }
    if (isset($_POST["update"])) {
        $id = $_POST['m_num'];
        $m_name_ch = $_POST["m_name"];
        $m_tel = $_POST["m_tel"];
        $m_address = $_POST["m_address"];

        $update_sql = "UPDATE member  SET m_name = '$m_name_ch', m_tel = '$m_tel', m_address = '$m_address' WHERE m_id = $id ";
        // $_SESSION["member_add.php"] = $insert_sql;
        // mysqli_query($link, $insert_sql);
        if (mysqli_query($link, $update_sql)) {
        echo "Record updated successfully";
        mysqli_close($link);
        header('Location: member.php'); 
        } else {
        echo "Error: " . $update_sql . "<br>" . $link->error;
        }
    }
    require_once("dbclose.inc");
?>

<section class="u-align-center u-clearfix u-section-2" id="sec-e399">
    <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <h2 class="u-text u-text-1">更新資料</h2>
        <div class="u-form u-form-1">
            <form action="member_edit.php" method="POST" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" style="padding: 10px" source="email" name="form">
                <div class="u-form-group u-form-group-5">
                    <label for="text-a175" class="u-form-control-hidden u-label"></label>
                    <input type="number" placeholder="會員編號" value="<?php echo $m_id; ?>" readonly id="text-a175" name="m_num" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-5">
                </div>
                <div class="u-form-group u-form-group-5">
                    <label for="text-a175" class="u-form-control-hidden u-label"></label>
                    <input type="text" placeholder="會員姓名" value="<?php echo $name; ?>" id="text-a175" name="m_name" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-5">
                </div>
                <div class="u-form-group u-form-group-4">
                    <label for="text-6448" class="u-form-control-hidden u-label"></label>
                    <input type="number" placeholder="會員電話" value="<?php echo $tel; ?>" id="text-6448" name="m_tel" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-4">
                </div>
                <div class="u-form-group u-form-group-5">
                    <label for="text-a175" class="u-form-control-hidden u-label"></label>
                    <input type="text" placeholder="會員地址" value="<?php echo $address; ?>" id="text-a175" name="m_address" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-5">
                </div>
                <div class="u-align-center u-form-group u-form-submit">
                    <!-- <a href="#" class="u-btn u-btn-submit u-button-style">資料送出<br>
                    </a> -->
                    <input type="submit" value="更新" class="u-btn u-btn-submit u-button-style" name="update">
                </div>
                <div class="u-form-send-message u-form-send-success"> Thank you! Your message has been sent. </div>
                <div class="u-form-send-error u-form-send-message"> Unable to send your message. Please fix errors then try again. </div>
                <input type="hidden" value="" name="recaptchaResponse">
            </form>
        </div>
    </div>
</section>

