<?php

namespace App\Enums;

enum PaymentTypesEnum:string
{
    case PIX = 'P';
    case CREDIT_CARD = 'C';
    case DEBIT_CARD = 'D';
}
