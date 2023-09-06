<?php

namespace App\Repositories\Account;

use App\Interfaces\Account\AccountRepositoryInterface;
use App\Interfaces\Account\AccountServiceInterface;
use App\Models\Account;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class AccountRepository implements AccountRepositoryInterface
{
    public function __construct(private Account $model)
    {
    }

    /**
     * @param int $accountId
     * @return Model
     */
    public function findById(int $accountId) : Model
    {
        return $this->model::query()->findOrFail($accountId);
    }

    /**
     * @param Collection $accountParams
     * @return Builder|Account
     */
    public function create(Collection $accountParams): Builder|Account
    {
        $this->model
            ->fill($accountParams->toArray())
            ->save();

        return $this->model;
    }

    /**
     * @param int $accountId
     * @param float $newAmount
     * @return bool|int
     */
    public function updateAmountById(int $accountId, float $newAmount): bool|int
    {
        return $this->model::query()->findOrFail($accountId)->update(['amount' => $newAmount]);
    }
}
