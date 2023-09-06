<?php

namespace Services\Account;

use App\Http\Kernel;
use App\Interfaces\Account\AccountRepositoryInterface;
use App\Models\Account;
use App\Repositories\Account\AccountRepository;
use App\Services\Account\AccountService;
use Illuminate\Foundation\Testing\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotEquals;

class AccountServiceTest extends TestCase
{

    private \ReflectionClass $accountServiceReflected;

    private AccountService $accountService;

    public function createApplication()
    {
        $app = require __DIR__ . '/../../../../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function setUp(): void
    {
        parent::setUp();

        $mockAccountModel = $this->getMockBuilder(Account::class)->getMock();
        $mockAccountRepository = $this->getMockBuilder(AccountRepository::class)
            ->setConstructorArgs([$mockAccountModel])
            ->getMock();

        $this->accountServiceReflected = new \ReflectionClass(AccountService::class);
        $this->accountService = new AccountService($mockAccountRepository);

    }

    /**
     * A basic unit test example.
     * @throws ReflectionException
     */
    public function testIfAddDefaultAmountOnCreateIsWasCorrect(): void
    {
        $addDefaultAmountOnCreate = $this->accountServiceReflected->getMethod('addDefaultAmountOnCreate');
        $amountWithInitialValue = $addDefaultAmountOnCreate->invokeArgs($this->accountService, [100]);

        assertEquals(600, $amountWithInitialValue);
    }
}
