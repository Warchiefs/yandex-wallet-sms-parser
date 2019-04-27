<?php

require_once ("YandexWalletSmsParser.php");

$text =
    "Пароль: 9823
Спишется 10035,03р.
Перевод на счет 410013949644723";

$parser = new YandexWalletSmsParser();
$response = $parser->parse($text);


print_r ($response);