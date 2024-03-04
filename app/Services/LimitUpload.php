<?php
require_once dirname(__DIR__).'/Services/MensagensAlerta.php';
class LimitUpload
{
    public static function verificaLimitUpload()
    {
        if(isset($_SERVER['CONTENT_LENGTH'])){
            if ($_SERVER['CONTENT_LENGTH'] > 20971520) {
                MensagensAlerta::erroExcedeuLimitBytes();
                return false;
            }
        }
    }
}