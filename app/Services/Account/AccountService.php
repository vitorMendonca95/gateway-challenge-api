<?php

namespace App\Services\Account;

use App\Interfaces\Account\AccountRepositoryInterface;
use App\Interfaces\Account\AccountServiceInterface;
use App\Models\Account;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class AccountService implements AccountServiceInterface
{
    public function __construct(protected AccountRepositoryInterface $accountRepository)
    {
    }

    /**
     * @param int $accountId
     * @return Model
     */
    public function getAccount(int $accountId) : Model
    {
        return $this->accountRepository->findById($accountId);
    }


    /**
     * @param Collection $accountParams
     * @return Builder|Account
     */
    public function create(Collection $accountParams): Builder|Account
    {
        $amount = $accountParams['amount'];
        $accountParams['amount'] = $this->addDefaultAmountOnCreate($amount);

        return $this->accountRepository->create($accountParams);
    }

    /**
     * @param float $amount
     * @return float
     */
    private function addDefaultAmountOnCreate(float $amount): float
    {
        return $amount + (float) config('account.default_amount_on_create');
    }
}
