<?php

declare(strict_types=1);

namespace App\Interfaces\Account;

use App\Models\Account;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Integer;

interface AccountRepositoryInterface
{
    public function __construct(Account $model);

    /**
     * @param int $accountId
     * @return Model
     */
    public function findById(int $accountId) : Model;

    /**
     * @param Collection $accountParams
     * @return Builder|Account
     */
    public function create(Collection $accountParams): Builder|Account;

    /**
     * @param int $accountId
     * @param float $newAmount
     * @return int|bool
     */
    public function updateAmountById(int $accountId, float $newAmount) : int|bool;
}
