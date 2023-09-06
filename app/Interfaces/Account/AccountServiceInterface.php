<?php

namespace App\Interfaces\Account;

use App\Models\Account;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface AccountServiceInterface
{
    /**
     * @param AccountRepositoryInterface $accountRepository
     */
    public function __construct(AccountRepositoryInterface $accountRepository);

    /**
     * @param int $accountId
     * @return Model
     */
    public function getAccount(int $accountId) : Model;

    /**
     * @param Collection $accountParams
     * @return Builder|Account
     */
    public function create(Collection $accountParams): Builder|Account;
}
