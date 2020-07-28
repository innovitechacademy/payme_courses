<?php
    session_start();
    extract($_POST);
    $item_id = intval($item_id);

    if(array_key_exists($item_id, $_SESSION['shopping_cart'])){
        $_SESSION['shopping_cart'][$item_id]['num'] += 1;
    }
    else{
        $_SESSION['shopping_cart'][$item_id]['name'] = $name;
        $_SESSION['shopping_cart'][$item_id]['price'] = doubleval($price);
        $_SESSION['shopping_cart'][$item_id]['num'] = 1;
    }

    echo json_encode($_SESSION['shopping_cart']);
?>