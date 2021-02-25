<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api;

use Mycom\Tracker\S2S\Api\Common\{Credentials, Gender};

/**
 * Simple tracker s2s api example
 */
class Example
{
    /**
     * Simple api call without any credentials
     */
    public static function getActualVersion(): int
    {
        $client = Client::getDefault();
        $method = new VersionMethod();
        $response = $client->request($method);

        return (int)$response->getBody()->getContents();
    }

    /**
     * Check s2s app access and return response status code.
     *
     * @param int    $trackerAppId          Your application id in tracker
     * @param string $mytrackerAccountToken Your tracker account token
     *
     * @return int
     */
    public static function testAppAccess(int $trackerAppId, string $mytrackerAccountToken): int
    {
        $client = Client::getDefault();

        $accountCredentials = new Credentials($mytrackerAccountToken);
        $method = new TestAppAccessMethod($accountCredentials, $trackerAppId);

        $response = $client->request($method);

        return $response->getStatusCode();
    }

    /**
     * Registration events example
     *
     * @param int    $trackerAppId          Your application id in tracker
     * @param string $mytrackerAccountToken Your tracker account token
     *
     * @return void
     */
    public static function sendRegistrationEvent(int $trackerAppId, string $mytrackerAccountToken): void
    {
        $client = Client::getDefault();

        // prepare registration event method instance for specified application
        $accountCredentials = new Credentials($mytrackerAccountToken);
        $registrationMethod = new RegistrationMethod($accountCredentials, $trackerAppId);

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
     * @param int    $trackerAppId          Your application id in tracker
     * @param string $mytrackerAccountToken Your tracker account token
     *
     * @return void
     */
    public static function sendLoginEvent(int $trackerAppId, string $mytrackerAccountToken): void
    {
        $client = Client::getDefault();

        // prepare login event method instance for specified application
        $accountCredentials = new Credentials($mytrackerAccountToken);
        $loginMethod = new LoginMethod($accountCredentials, $trackerAppId);

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
     * @param int    $trackerAppId          Your application id in tracker
     * @param string $mytrackerAccountToken Your tracker account token
     *
     * @return void
     */
    public static function sendCustomEvent(int $trackerAppId, string $mytrackerAccountToken): void
    {
        $client = Client::getDefault();

        // prepare custom event method instance for specified application
        $accountCredentials = new Credentials($mytrackerAccountToken);
        $customEventMethod = new CustomEventMethod($accountCredentials, $trackerAppId);

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
     * @param int    $trackerAppId          Your application id in tracker
     * @param string $mytrackerAccountToken Your tracker account token
     *
     * @return void
     */
    public static function sendCustomRevenue(int $trackerAppId, string $mytrackerAccountToken): void
    {
        $client = Client::getDefault();

        // prepare custom event method instance for specified application
        $accountCredentials = new Credentials($mytrackerAccountToken);
        $customRevenueMethod = new CustomRevenueMethod($accountCredentials, $trackerAppId);

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
