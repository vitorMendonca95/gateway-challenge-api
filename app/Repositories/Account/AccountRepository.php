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

    public function getById(int $accountId) : Model
    {
        return $this->model::query()->findOrFail($accountId);
    }

    public function create(Collection $accountParams): Builder|Account
    {
        $this->model
            ->fill($accountParams->toArray())
            ->save();

        return $this->model;
    }
}
