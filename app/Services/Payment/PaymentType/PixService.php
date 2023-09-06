<?php

namespace App\Services\Payment\PaymentType;

use App\Interfaces\Payment\PaymentTypeInterface;

class PixService implements PaymentTypeInterface
{

    public function getPercentageTax()
    {
        return config('payment.pix.percent_tax');
    }
}
