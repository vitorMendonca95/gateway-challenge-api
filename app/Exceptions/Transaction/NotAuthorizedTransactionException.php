<?php

namespace App\Exceptions\Transaction;

use Exception;

class NotAuthorizedTransactionException extends Exception
{
    protected $message = "Transaction not authorized. Account does not have sufficient funds";

    protected $code = 404;
}
