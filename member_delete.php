<?php
    $id = $_GET['id'];
    require_once("dbconnect.inc");

    $sql = "DELETE FROM member WHERE m_id = $id";

    if (mysqli_query($link, $sql)) {

        mysqli_close($link);
        header('Location: member.php'); 
        exit;
    } else {
        echo "Error deleting record";
        echo $id;
    }
?>