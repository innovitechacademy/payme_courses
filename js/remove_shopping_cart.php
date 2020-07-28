<?php
    session_start();
    extract($_POST);
    $item_id = intval($item_id);

    if($_SESSION['shopping_cart'][$item_id]['num']==1){
        unset($_SESSION['shopping_cart'][$item_id]);
    }
    else{
        $_SESSION['shopping_cart'][$item_id]['num'] -= 1;
    }

    echo json_encode($_SESSION['shopping_cart']);
?>