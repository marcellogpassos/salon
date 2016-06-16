<?php

if (!function_exists('dateToBrFormat')) {

    function dateToBrFormat($date) {
        return date("d/m/Y", strtotime($date));
    }

}

if (!function_exists('stringFormat')) {

    function stringFormat($str, $args) {
        for ($i = 0; $i < count($args); $i++)
            $str = str_replace("{" . $i . "}", $args[$i], $str);
        return $str;
    }

}

if (!function_exists('showMessage')) {

    function showMessage($type, $messageId, array $args = null) {
        $messageScope = 'messages.' . $type;
        $preFormattedMessage = Config::get($messageScope)[$messageId];
        $message = ($args) ? stringFormat($preFormattedMessage, $args) : $preFormattedMessage;
        session()->flash($type, $message);
    }

}