<?php
require_once ("Exceptions/UnavailableText.php");

class YandexWalletSmsParser
{
    protected $text;

    const CHECK_SUCCESS_PATTERN = '/[\d]/';

    const SMS_CODE_KEY = 'sms_code';
    const SMS_CODE_PATTERN = '/(?<![\d])[\d]{4,6}(?![\d,.])/';

    const SUM_KEY = 'sum';
    const SUM_PATTERN = '/[\d]{1,11}[,.][\d]{0,2}/';

    const WALLET_KEY = 'receiver';
    const WALLET_PATTERN = '/41001[\d]{8,10}/';

    public function parse($text)
    {
        $this->text = $text;

        return [
            self::SUM_KEY => $this->parseSum(),
            self::WALLET_KEY => $this->parseWallet(),
            self::SMS_CODE_KEY => $this->parseSmsCode(),

        ];
    }

    protected function parseSmsCode()
    {
        preg_match(self::SMS_CODE_PATTERN, $this->text, $matches);
        return $matches[0];
    }

    protected function parseSum()
    {
        preg_match(self::SUM_PATTERN, $this->text, $matches);
        return $matches[0];
    }

    protected function parseWallet()
    {
        preg_match(self::WALLET_PATTERN, $this->text, $matches);
        return $matches[0];
    }

}


