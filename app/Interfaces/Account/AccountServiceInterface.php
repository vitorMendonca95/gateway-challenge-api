<?php

namespace App\Interfaces\Account;

use App\Models\Account;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface AccountServiceInterface
{
    public function __construct(AccountRepositoryInterface $accountRepository);

    public function getAccount(int $accountId) : Model;

    public function create(Collection $accountParams): Builder|Account;
}
