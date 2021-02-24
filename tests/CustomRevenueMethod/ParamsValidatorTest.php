<?php

declare(strict_types=1);

namespace MycomTest\Tracker\S2S\Api\CustomRevenueMethod;

use Mycom\Tracker\S2S\Api\CustomRevenueMethod\{Params, ParamsInterface, ParamsValidator};
use Mycom\Tracker\S2S\Api\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Mycom\Tracker\S2S\Api\CustomRevenueMethod\ParamsValidator
 */
class ParamsValidatorTest extends TestCase
{
    /**
     * @covers ::validate
     * @dataProvider providerValidate
     *
     * @param ParamsInterface $params
     * @param string|null     $error
     */
    public function testValidate(ParamsInterface $params, string $error = null): void
    {
        try {
            (new ParamsValidator($params))->validate();
            self::assertEmpty($error);
        } catch (InvalidArgumentException $exception) {
            self::assertEquals($error, $exception->getMessage());
        }
    }

    /**
     * @return array
     */
    public function providerValidate(): array
    {
        return [
            'idTransaction not set' => [
                'params' => new Params(),
                'error' => 'idTransaction param is required',
            ],
            'idTransaction empty string' => [
                'params' => (new Params())
                    ->setIdTransaction(''),
                'error' => 'idTransaction param is required',
            ],
            'idTransaction too long string' => [
                'params' => (new Params())
                    ->setIdTransaction(\str_repeat('t', 256)),
                'error' => 'idTransaction expected to be below 255',
            ],
            'currency not set' => [
                'params' => (new Params())
                    ->setIdTransaction('idTransaction'),
                'error' => 'currency param is required',
            ],
            'currency empty string' => [
                'params' => (new Params())
                    ->setIdTransaction('idTransaction')
                    ->setCurrency(''),
                'error' => 'currency param is required',
            ],
            'currency big string' => [
                'params' => (new Params())
                    ->setIdTransaction('idTransaction')
                    ->setCurrency('some'),
                'error' => 'currency must be 3 character code',
            ],
            'total not set' => [
                'params' => (new Params())
                    ->setIdTransaction('idTransaction')
                    ->setCurrency('RUB'),
                'error' => 'total param is required',
            ],
            'total is zero' => [
                'params' => (new Params())
                    ->setIdTransaction('idTransaction')
                    ->setCurrency('RUB')
                    ->setTotal(0),
                'error' => null,
            ],
            'all correct' => [
                'params' => (new Params())
                    ->setIdTransaction('idTransaction')
                    ->setCurrency('RUB')
                    ->setTotal(12.33434),
                'error' => null,
            ],
        ];
    }
}
