<?php

namespace App\Services\Payment\PaymentType;

use App\Interfaces\Payment\PaymentTypeInterface;

class DebitService implements PaymentTypeInterface
{

    public function getPercentageTax()
    {
        return config('payment.debit.percent_tax');
    }
}
