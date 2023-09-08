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
     * @dataProvider valueProvider
     * @throws ReflectionException
     */
    public function testIfAddDefaultAmountOnCreateIsWasCorrect($value, $expectedResult): void
    {
        $addDefaultAmountOnCreate = $this->accountServiceReflected->getMethod('addDefaultAmountOnCreate');
        $amountWithInitialValue = $addDefaultAmountOnCreate->invokeArgs($this->accountService, [$value]);

        assertEquals($expectedResult, $amountWithInitialValue);
    }

    public static function valueProvider(): array
    {
        return [
          'shouldBeValidWhenFunctionIncreaseValueCorrectly1'  => ['value' => 100, 'expected' => 600],
          'shouldBeValidWhenFunctionIncreaseValueCorrectly2'  => ['value' => 200, 'expected' => 700],
          'shouldBeValidWhenFunctionIncreaseValueCorrectly3'  => ['value' => 50, 'expected' => 550],
        ];
    }
}
