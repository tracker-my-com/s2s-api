<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api;

use Mycom\Tracker\S2S\Api\Common\CredentialsInterface;
use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use Mycom\Tracker\S2S\Api\RegistrationBatchMethod;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\RegistrationBatchMethod
 */
class RegistrationBatchMethodTest extends TestCase
{

    /**
     * @covers ::validate
     * @return void
     */
    public function testValidateEmptyBatchError(): void
    {
        $credential = $this->createMock(CredentialsInterface::class);
        $method = new RegistrationBatchMethod($credential, 1);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Empty params batch');
        $method->validate();
    }

    /**
     * @covers ::validate
     * @return void
     */
    public function testValidateBigBatchError(): void
    {
        $credential = $this->createMock(CredentialsInterface::class);
        $method = new RegistrationBatchMethod($credential, 1);

        for ($i = 0; $i <= 20; ++$i) {
            $method->addParams();
        }
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Batch expected to be below 20');
        $method->validate();
    }
}
