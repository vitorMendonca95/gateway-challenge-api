<?php

declare(strict_types=1);

namespace App\Interfaces\Account;

use App\Models\Account;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface AccountRepositoryInterface
{
    public function __construct(Account $model);

    public function getById(int $accountId) : Model;

    public function create(Collection $accountParams): Builder|Account;
}
