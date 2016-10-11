<?php

if (!function_exists('dateToBrFormat')) {

	function dateToBrFormat($date, $hms = false) {
		if ($hms)
			return date("d/m/Y H:i:s", strtotime($date));
		else
			return date("d/m/Y", strtotime($date));
	}

}

if (!function_exists('dataPorExtenso')) {

	function dataPorExtenso($date = null) {
		setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		date_default_timezone_set('America/Fortaleza');
		return utf8_encode(strftime('%A, %d de %B de %Y', $date ? $date : strtotime("today")));
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

	function moneyFormat($valor, $prefix = true) {
		return ($prefix ? 'R$ ' : '') . number_format($valor, 2, ',', '.');
	}

}

if (!function_exists('resolverGeneroServico')) {

	function resolverGeneroServico($masculino, $feminino) {
		if ($masculino && $feminino)
			return 'AMBOS OS SEXOS';
		if ($masculino && !$feminino)
			return 'HOMENS';
		if (!$masculino && $feminino)
			return 'MULHERES';
		return null;
	}

}

if (!function_exists('funcionarioHabilitado')) {

	function funcionarioHabilitado($servico, $funcionarioProcurado) {
		foreach ($servico->funcionariosHabilitados as $funcionario)
			if ($funcionario->id == $funcionarioProcurado->id)
				return true;
		return false;
	}

}

if (!function_exists('itemComprovanteCompra')) {

	function itemComprovanteCompra($item, $padding) {
		if (strlen($item) <= $padding)
			return $item;
		return mb_substr($item, 0, $padding - 3, "utf-8") . '...';
	}

}

if (!function_exists('mb_str_pad')) {

	function mb_str_pad($str, $pad_len, $pad_str = ' ', $dir = STR_PAD_RIGHT, $encoding = NULL) {
		$encoding = $encoding === NULL ? mb_internal_encoding() : $encoding;
		$padBefore = $dir === STR_PAD_BOTH || $dir === STR_PAD_LEFT;
		$padAfter = $dir === STR_PAD_BOTH || $dir === STR_PAD_RIGHT;
		$pad_len -= mb_strlen($str, $encoding);
		$targetLen = $padBefore && $padAfter ? $pad_len / 2 : $pad_len;
		$strToRepeatLen = mb_strlen($pad_str, $encoding);
		$repeatTimes = ceil($targetLen / $strToRepeatLen);
		$repeatedString = str_repeat($pad_str, max(0, $repeatTimes));
		$before = $padBefore ? mb_substr($repeatedString, 0, floor($targetLen), $encoding) : '';
		$after = $padAfter ? mb_substr($repeatedString, 0, ceil($targetLen), $encoding) : '';
		return $before . $str . $after;
	}

}