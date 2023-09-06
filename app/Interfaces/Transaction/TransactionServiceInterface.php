<?php

namespace App\Interfaces\Transaction;

use App\Interfaces\Payment\PaymentTypeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface TransactionServiceInterface
{
    /**
     * @param Collection $transactionParams
     * @return Model
     */
    public function transaction(Collection $transactionParams): Model;
}
