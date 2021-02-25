<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api;

use Mycom\Tracker\S2S\Api\Client\ClientInterface;
use Mycom\Tracker\S2S\Api\Common\{Credentials, Gender};

/**
 * Simple tracker s2s api example
 */
class Example
{
    /**
     * Simple api call without any credentials
     *
     * @param ClientInterface|null $client
     *
     * @return int
     * @throws Exception\ExceptionInterface
     */
    public static function getActualVersion(ClientInterface $client = null): int
    {
        $client ??= Client::getDefault();
        $method = new VersionMethod();
        $response = $client->request($method);

        return (int)$response->getBody()->getContents();
    }

    /**
     * Check s2s app access and return response status code.
     *
     * @param int                  $appId        Your application id in tracker
     * @param string               $accountToken Your account token in tracker
     * @param ClientInterface|null $client
     *
     * @return int
     * @throws Exception\ExceptionInterface
     */
    public static function testAppAccess(int $appId, string $accountToken, ClientInterface $client = null): int
    {
        $client ??= Client::getDefault();

        $accountCredentials = new Credentials($accountToken);
        $method = new TestAppAccessMethod($accountCredentials, $appId);

        $response = $client->request($method);

        return $response->getStatusCode();
    }

    /**
     * Registration events example
     *
     * @param int                  $appId        Your application id in tracker
     * @param string               $accountToken Your account token in tracker
     * @param ClientInterface|null $client
     *
     * @return void
     * @throws Exception\ExceptionInterface
     */
    public static function sendRegistrationEvent(int $appId, string $accountToken, ClientInterface $client = null): void
    {
        $client ??= Client::getDefault();

        // prepare registration event method instance for specified application
        $accountCredentials = new Credentials($accountToken);
        $registrationMethod = new RegistrationMethod($accountCredentials, $appId);

        $params = $registrationMethod->params();
        $params->customUserId = '100500';
        $params->idGender = Gender::FEMALE;
        $params->age = 25;
        $params->lvid = '00000000000000000000000000000001';
        $client->request($registrationMethod);

        // cleanup method params before next call
        $params->reset();

        // send our next event
        $params->customUserId = '42';
        $client->request($registrationMethod);
    }

    /**
     * Login events example
     *
     * @param int                  $appId        Your application id in tracker
     * @param string               $accountToken Your account token in tracker
     * @param ClientInterface|null $client
     *
     * @return void
     * @throws Exception\ExceptionInterface
     */
    public static function sendLoginEvent(int $appId, string $accountToken, ClientInterface $client = null): void
    {
        $client ??= Client::getDefault();

        // prepare login event method instance for specified application
        $accountCredentials = new Credentials($accountToken);
        $loginMethod = new LoginMethod($accountCredentials, $appId);

        $params = $loginMethod->params();
        $params->customUserId = '100500';
        $params->eventTimestamp = strtotime('2020-04-22 14:00');
        $client->request($loginMethod);

        // cleanup method params before next call
        $params->reset();

        // send our next event
        $params->customUserId = '42';
        $params->ipv4 = '8.8.8.8';
        $params->eventTimestamp = strtotime('2020-04-22 14:02');
        $client->request($loginMethod);
    }

    /**
     * Custom events example
     *
     * @param int                  $appId        Your application id in tracker
     * @param string               $accountToken Your account token in tracker
     * @param ClientInterface|null $client
     *
     * @return void
     * @throws Exception\ExceptionInterface
     */
    public static function sendCustomEvent(int $appId, string $accountToken, ClientInterface $client = null): void
    {
        $client ??= Client::getDefault();

        // prepare custom event method instance for specified application
        $accountCredentials = new Credentials($accountToken);
        $customEventMethod = new CustomEventMethod($accountCredentials, $appId);

        // send our first event
        $params = $customEventMethod->params();
        $params->customUserId = '100500';
        $params->customEventName = 'levelUp';
        $params->customEventParams = ['level' => '2'];
        $params->lvid = '00000000000000000000000000000001';
        $client->request($customEventMethod);

        // cleanup method params before next call
        $params->reset();

        // send our next event
        $params->customUserId = '42';
        $params->customEventName = 'levelUp';
        $params->customEventParams = [
            'level' => '5',
            'coins' => '10',
        ];
        $client->request($customEventMethod);
    }

    /**
     * Custom revenue example
     *
     * @param int                  $appId        Your application id in tracker
     * @param string               $accountToken Your account token in tracker
     * @param ClientInterface|null $client
     *
     * @return void
     * @throws Exception\ExceptionInterface
     */
    public static function sendCustomRevenue(int $appId, string $accountToken, ClientInterface $client = null): void
    {
        $client ??= Client::getDefault();

        // prepare custom event method instance for specified application
        $accountCredentials = new Credentials($accountToken);
        $customRevenueMethod = new CustomRevenueMethod($accountCredentials, $appId);

        // send our first payment
        $params = $customRevenueMethod->params();
        $params->customUserId = '100500';
        $params->idTransaction = 'order1';
        $params->currency = 'USD';
        $params->total = 4.5;
        $params->lvid = '00000000000000000000000000000001';
        $client->request($customRevenueMethod);

        // cleanup method params before next call
        $params->reset();

        // send our next transaction
        $params->customUserId = '42';
        $params->idTransaction = 'order2';
        $params->currency = 'RUB';
        $params->total = 3000;

        $client->request($customRevenueMethod);
    }
}
