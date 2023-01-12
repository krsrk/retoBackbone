<?php
namespace App\Helpers;

class StringConverter
{
    public function __construct(protected $stringToConvert = '') {}

    public function toUpperCase()
    {
        $forbiddenSpecialChar = ['ñ', '°', 'Ñ'];
        $processSpecialCharString = str_replace($forbiddenSpecialChar, '?', $this->stringToConvert);
        $stringToUpper = mb_strtoupper($processSpecialCharString);

        return iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $stringToUpper);
    }
}
