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

if (!function_exists('telefoneFormat')) {

    function telefoneFormat($input) {
        if (!$input || strlen($input) < 10 || strlen($input) > 12)
            return $input;
        return '(' . substr($input, 0, 2) . ') ' . substr($input, 2);
    }

}


if (!function_exists('filtroFornecido')) {

    function filtroFornecido($criterios, $nomeFiltro, $tamanho = 0) {
        if ($tamanho)
            return (isset($criterios[$nomeFiltro]) && strlen($criterios[$nomeFiltro]) == $tamanho);
        return (isset($criterios[$nomeFiltro]) && strlen($criterios[$nomeFiltro]) > 0);
    }

}


if (!function_exists('buscaPadrao')) {

    function buscaPadrao($input) {
        return (!$input || (count($input) == 1 && isset($input['page'])));
    }

}

if (!function_exists('moneyFormat')) {

    function moneyFormat($valor) {
        return 'R$' . number_format($valor, 2, ',', '.');
    }

}