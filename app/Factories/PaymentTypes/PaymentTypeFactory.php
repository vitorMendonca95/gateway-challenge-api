<?php

namespace App\Factories\PaymentTypes;

use App\Enums\PaymentTypesEnum;
use App\Interfaces\Payment\PaymentTypeInterface;
use App\Services\Payment\PaymentType\CreditService;
use App\Services\Payment\PaymentType\DebitService;
use App\Services\Payment\PaymentType\PixService;

class PaymentTypeFactory
{
    public function getPaymentInstance(string $paymentType) : PaymentTypeInterface
    {
        return match ($paymentType) {
            PaymentTypesEnum::DEBIT_CARD->value => new DebitService(),
            PaymentTypesEnum::CREDIT_CARD->value => new CreditService(),
            PaymentTypesEnum::PIX->value => new PixService(),
        };
    }
}
