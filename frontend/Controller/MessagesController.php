<?php
require_once 'Model/Messages.php';

class MessagesController {
    private static $msg;

    public static function getMessage(){
        return self::$msg;
    }

    public static function setMessage($_msg){
        $item_name = '';
        $arr_msg = explode('-', $_msg);
        $accion = $arr_msg[0];

        if (count($arr_msg) == 2) {
            $item_name = $arr_msg[1];
        }

        $message = new Messages();

        if (isset($item_name)) {
            $message->set($accion,$item_name);
        } else {
            $message->set($accion);
        }

        self::$msg = $message->get($accion);
    }
}
