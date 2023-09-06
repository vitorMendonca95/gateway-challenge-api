<?php

namespace App\Services\Payment\PaymentType;

use App\Interfaces\Payment\PaymentTypeInterface;

class CreditService implements PaymentTypeInterface
{

    public function getPercentageTax()
    {
        return config('payment.credit.percent_tax');
    }
}
