<?php
    $id = $_GET['id'];
    require_once("dbconnect.inc");

    $sql = "DELETE FROM tea_order WHERE order_ID = $id";
    $order_sql ="SELECT * FROM tea_order WHERE order_ID = $id";
    $order_row = mysqli_fetch_array(mysqli_query($link, $order_sql), MYSQLI_ASSOC);
    $t_name_ch = $order_row["tea_type"];
    $t_num = $order_row["tea_num"];

    if (mysqli_query($link, $sql)) {

        $tea_sql = "SELECT * FROM tea_inventory WHERE tea_type = '$t_name_ch' ";
        $tea_row = mysqli_fetch_array(mysqli_query($link, $tea_sql), MYSQLI_ASSOC);
        $tea_num = $tea_row["inventory_qty"];
        $tea_total = $tea_num + $t_num;
        $update_sql ="UPDATE tea_inventory SET inventory_qty = '$tea_total' WHERE tea_type = '$t_name_ch' ";
        mysqli_query($link, $update_sql);

        mysqli_close($link);
        header('Location: sellOrder.php'); //If book.php is your main page where you list your all records
        exit;
    } else {
        echo "Error deleting record";
        echo $id;
    }
?>
