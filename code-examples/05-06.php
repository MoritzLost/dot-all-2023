<?php

$number = $entryData['phone_number'];
$phoneNumberUtil = PhoneNumberUtil::getInstance();

try {
    $phoneNumber = $phoneNumberUtil->parse($number, 'DE');
} catch (\Throwable $e) {
    echo sprintf(
        '### WARNING: Dropping invalid phone number %s. Error: %s',
        $number,
        $e->getMessage()
    ) . PHP_EOL;
}