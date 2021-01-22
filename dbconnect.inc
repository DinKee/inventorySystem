<?php
// 建立MySQL的member資料庫連接
$link =@mysqli_connect("localhost", "root", "") 
        or die("無法開啟MySQL資料庫連接!<br/>");
mysqli_select_db($link, "inventory_system");
mysqli_query($link, 'SET NAMES utf8');
?>