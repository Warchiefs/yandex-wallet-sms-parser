<?php

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

    /**
     * YandexWalletSmsParser constructor.
     *
     * @param $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return array
     */
    public function parse(): array
    {
        return [
            self::SUM_KEY => $this->parseSum(),
            self::WALLET_KEY => $this->parseWallet(),
            self::SMS_CODE_KEY => $this->parseSmsCode(),

        ];
    }

    /**
     * @return null|string
     */
    protected function parseSmsCode(): ?string
    {
        preg_match(self::SMS_CODE_PATTERN, $this->text, $matches);
        return $matches[0] ?? null;
    }

    /**
     * @return null|string
     */
    protected function parseSum(): ?string
    {
        preg_match(self::SUM_PATTERN, $this->text, $matches);
        return $matches[0] ?? null;
    }

    /**
     * @return null|string
     */
    protected function parseWallet(): ?string
    {
        preg_match(self::WALLET_PATTERN, $this->text, $matches);
        return $matches[0] ?? null;
    }

}


