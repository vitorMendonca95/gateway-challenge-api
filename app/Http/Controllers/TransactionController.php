<?php

namespace App\Http\Controllers;

use App\Exceptions\Transaction\NotAuthorizedTransactionException;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\AccountResource;
use App\Interfaces\Transaction\TransactionServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class TransactionController extends Controller
{
    public function __construct(protected TransactionServiceInterface $transactionService)
    {
    }

    /**
     * @param TransactionRequest $request
     * @return JsonResponse
     */
    public function transaction(TransactionRequest $request)
    {
        try {
            $transactionParams = collect(
                [
                    'paymentType' => $request->get('forma_pagamento'),
                    'accountId' => $request->get('conta_id'),
                    'amount' => $request->get('valor'),
                ]
            );

            $accountResource = new AccountResource($this->transactionService->transaction($transactionParams));

            return response()->json($accountResource);

        } catch (\Throwable $exception) {
            return Response::json(['message' => $exception->getMessage()], $exception->getCode());
        }


    }
}
