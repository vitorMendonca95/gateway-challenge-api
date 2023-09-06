<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Http\Resources\AccountResource;
use App\Interfaces\Account\AccountServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct(protected AccountServiceInterface $accountService)
    {
    }

    /**
     * @param int $accountId
     * @return JsonResponse
     */
    public function getAccount(int $accountId) : JsonResponse
    {
        $accountResource = new AccountResource($this->accountService->getAccount($accountId));

        return response()->json($accountResource);
    }

    /**
     * @param AccountRequest $request
     * @return JsonResponse
     */
    public function create(AccountRequest $request): JsonResponse
    {
        $accountParams = collect([
            'id' => $request->get('conta_id'),
            'amount' => $request->get('valor'),
        ]);

       $accountResource = new AccountResource($this->accountService->create($accountParams));

        return response()->json($accountResource);
    }
}
