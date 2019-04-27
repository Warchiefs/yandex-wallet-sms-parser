<?php

require_once("YandexWalletSmsParser.php");

$smsMessage = "Пароль: 9823
Спишется 1005,03р.
Перевод на счет 410013949644723";

$parser = new YandexWalletSmsParser($smsMessage);
$response = $parser->parse();

print_r($response);