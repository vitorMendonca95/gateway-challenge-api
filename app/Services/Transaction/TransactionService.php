<?php

namespace App\Services\Transaction;

use App\Exceptions\Transaction\NotAuthorizedTransactionException;
use App\Factories\PaymentTypes\PaymentTypeFactory;
use App\Interfaces\Account\AccountRepositoryInterface;
use App\Interfaces\Payment\PaymentTypeInterface;
use App\Interfaces\Transaction\TransactionServiceInterface;
use http\Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TransactionService implements TransactionServiceInterface
{
    public function __construct(
        protected PaymentTypeFactory $paymentTypeFactory,
        protected AccountRepositoryInterface $accountRepository
    )
    {
    }

    /**
     * @param Collection $transactionParams
     * @return Model
     * @throws NotAuthorizedTransactionException
     */
    public function transaction(Collection $transactionParams): Model
    {
        $paymentType = $transactionParams->get('paymentType');
        $amountToWithdraw = $transactionParams->get('amount');
        $accountId = $transactionParams->get('accountId');

        $paymentTypeService = $this->paymentTypeFactory->getPaymentInstance($paymentType);
        $amountWithTaxApplied = $this->calculateAmountToWithdrawWithTaxApplied($paymentTypeService, $amountToWithdraw);

        $amountInAccount = $this->accountRepository->findById($accountId)->getAttributeValue('amount');
        $newAmount = $this->withDrawAmountFromAccount($amountInAccount, $amountWithTaxApplied);

        $this->accountRepository->updateAmountById($accountId, $newAmount);

        return $this->accountRepository->findById($accountId);

    }

    /**
     * @param PaymentTypeInterface $paymentTypeService
     * @param float $amountToWithdraw
     * @return float
     */
    private function calculateAmountToWithdrawWithTaxApplied(
        PaymentTypeInterface $paymentTypeService,
        float $amountToWithdraw): float
    {
        return $amountToWithdraw + ($amountToWithdraw * ($paymentTypeService->getPercentageTax() / 100));
    }

    /**
     * @param float $amountInAccount
     * @param float $amountToWithdraw
     * @return float|Exception
     * @throws NotAuthorizedTransactionException
     */
    private function withDrawAmountFromAccount(float $amountInAccount, float $amountToWithdraw): float|Exception
    {
        if ($amountInAccount < $amountToWithdraw) {
            throw new NotAuthorizedTransactionException();
        }

        return $amountInAccount - $amountToWithdraw;
    }
}
