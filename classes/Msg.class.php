<?php

class Msg
{
    public function success($msg)
    {
        return
        "<div class='kode-alert kode-alert-icon alert3'>
            <i class='fa fa-check'></i><a href='#' class='closed'>x</a>".$msg.
        "</div>";
    }

    public function warning($msg){
        return 
        "<div class='kode-alert kode-alert-icon alert5-light'>
            <i class='fa fa-warning'></i>
            <a href='#' class='closed'>×</a>".$msg.
        "</div>";
    }

    public function error($msg){
        return 
        "<div class='kode-alert kode-alert-icon kode-alert-click alert6'>
            <i class='fa fa-lock'></i>
            <a href='#' class='closed'>×</a>".$msg.
        "</div>";
    }
}
?>