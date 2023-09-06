<?php

namespace Services\Transaction;

use App\Exceptions\Transaction\NotAuthorizedTransactionException;
use App\Factories\PaymentTypes\PaymentTypeFactory;
use App\Http\Kernel;
use App\Interfaces\Account\AccountRepositoryInterface;
use App\Models\Account;
use App\Repositories\Account\AccountRepository;
use App\Services\Account\AccountService;
use App\Services\Transaction\TransactionService;
use Illuminate\Foundation\Testing\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotEquals;

class TransactionServiceTest extends TestCase
{

    private \ReflectionClass $transactionServiceReflected;

    private TransactionService $transactionService;

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

        $mockPaymentTypeFactory = $this->getMockBuilder(PaymentTypeFactory::class)->getMock();
        $this->transactionServiceReflected = new \ReflectionClass(TransactionService::class);
        $this->transactionService = new TransactionService($mockPaymentTypeFactory, $mockAccountRepository);

    }

    /**
     * @throws ReflectionException
     */
    public function testWithDrawAmountFromAccountWithSuccess(): void
    {
        $withDrawAmountFromAccountMethod = $this->transactionServiceReflected
            ->getMethod('withDrawAmountFromAccount');

        $amountWithdrawnWhenProductIsZero = $withDrawAmountFromAccountMethod
            ->invokeArgs($this->transactionService, [100, 100]);

        $amountWithdrawnWhenHigher = $withDrawAmountFromAccountMethod
            ->invokeArgs($this->transactionService, [101, 100]);


        assertEquals(0, $amountWithdrawnWhenProductIsZero);
        assertEquals(1, $amountWithdrawnWhenHigher);
    }

    /**
     * @throws ReflectionException
     */
    public function testWithDrawAmountFromAccountWithNotAuthorizedException(): void
    {
        $this->expectException(NotAuthorizedTransactionException::class);

        $withDrawAmountFromAccountMethod = $this->transactionServiceReflected
            ->getMethod('withDrawAmountFromAccount');

        $amountWithdrawn = $withDrawAmountFromAccountMethod
            ->invokeArgs($this->transactionService, [100, 101]);
    }

    /**
     * @throws ReflectionException
     */
    public function testCalculateAmountToWithdrawWithTaxAppliedWhenIsCreditCard(): void
    {
        $calculateAmountToWithdrawWithTaxAppliedMethod = $this->transactionServiceReflected
            ->getMethod('calculateAmountToWithdrawWithTaxApplied');

        $paymentTypeFactory = new PaymentTypeFactory();
        $paymentType = $paymentTypeFactory->getPaymentInstance('C');

        $calculatedAmountWithTaxes = $calculateAmountToWithdrawWithTaxAppliedMethod
            ->invokeArgs($this->transactionService, [$paymentType, 100]);

        assertEquals(105 ,$calculatedAmountWithTaxes);
    }

    /**
     * @throws ReflectionException
     */
    public function testCalculateAmountToWithdrawWithTaxAppliedWhenIsPix(): void
    {
        $calculateAmountToWithdrawWithTaxAppliedMethod = $this->transactionServiceReflected
            ->getMethod('calculateAmountToWithdrawWithTaxApplied');

        $paymentTypeFactory = new PaymentTypeFactory();
        $paymentType = $paymentTypeFactory->getPaymentInstance('P');

        $calculatedAmountWithTaxes = $calculateAmountToWithdrawWithTaxAppliedMethod
            ->invokeArgs($this->transactionService, [$paymentType, 100]);

        assertEquals(100 ,$calculatedAmountWithTaxes);
    }

    /**
     * @throws ReflectionException
     */
    public function testCalculateAmountToWithdrawWithTaxAppliedWhenIsDebitCard(): void
    {
        $calculateAmountToWithdrawWithTaxAppliedMethod = $this->transactionServiceReflected
            ->getMethod('calculateAmountToWithdrawWithTaxApplied');

        $paymentTypeFactory = new PaymentTypeFactory();
        $paymentType = $paymentTypeFactory->getPaymentInstance('D');

        $calculatedAmountWithTaxes = $calculateAmountToWithdrawWithTaxAppliedMethod
            ->invokeArgs($this->transactionService, [$paymentType, 100]);

        assertEquals(103 ,$calculatedAmountWithTaxes);
    }
}
