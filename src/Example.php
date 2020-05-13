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
     * @param int $trackerAppId Your application id in tracker
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
     * @param int $trackerAppId Your application id in tracker
     * @param string $mytrackerAccountToken Your tracker account token
     *
     * @return void
     */
    public static function sendRegistrationEvent(int $trackerAppId, string $mytrackerAccountToken)
    {
        $client = Client::getDefault();

        // prepare registration event method instance for specified application
        $accountCredentials = new Credentials($mytrackerAccountToken);
        $registrationMethod = new RegistrationMethod($accountCredentials, $trackerAppId);

        $registrationMethod->params()
            ->setCustomUserId('100500')
            ->setIdGender(Gender::FEMALE)
            ->setAge(25)
            ->setLvid('00000000000000000000000000000001');
        $client->request($registrationMethod);

        // cleanup method params before next call
        $registrationMethod->params()->reset();

        // send our next event
        $registrationMethod->params()
            ->setCustomUserId('42');
        $client->request($registrationMethod);
    }

    /**
     * Login events example
     *
     * @param int $trackerAppId Your application id in tracker
     * @param string $mytrackerAccountToken Your tracker account token
     *
     * @return void
     */
    public static function sendLoginEvent(int $trackerAppId, string $mytrackerAccountToken)
    {
        $client = Client::getDefault();

        // prepare login event method instance for specified application
        $accountCredentials = new Credentials($mytrackerAccountToken);
        $loginMethod = new LoginMethod($accountCredentials, $trackerAppId);

        $loginMethod->params()
            ->setCustomUserId('100500')
            ->setEventTimestamp(strtotime('2020-04-22 14:00'));
        $client->request($loginMethod);

        // cleanup method params before next call
        $loginMethod->params()->reset();

        // send our next event
        $loginMethod->params()
            ->setCustomUserId('42')
            ->setIpv4('8.8.8.8')
            ->setEventTimestamp(strtotime('2020-04-22 14:02'));
        $client->request($loginMethod);
    }

    /**
     * Custom events example
     *
     * @param int $trackerAppId Your application id in tracker
     * @param string $mytrackerAccountToken Your tracker account token
     *
     * @return void
     */
    public static function sendCustomEvent(int $trackerAppId, string $mytrackerAccountToken)
    {
        $client = Client::getDefault();

        // prepare custom event method instance for specified application
        $accountCredentials = new Credentials($mytrackerAccountToken);
        $customEventMethod = new CustomEventMethod($accountCredentials, $trackerAppId);

        // send our first event
        $customEventMethod->params()
            ->setCustomUserId('100500')
            ->setCustomEventName('levelUp')
            ->addCustomEventParam('level', '2')
            ->setLvid('00000000000000000000000000000001');
        $client->request($customEventMethod);

        // cleanup method params before next call
        $customEventMethod->params()->reset();

        // send our next event
        $customEventMethod->params()
            ->setCustomUserId('42')
            ->setCustomEventName('levelUp')
            ->addCustomEventParam('level', '5')
            ->addCustomEventParam('coins', '10');
        $client->request($customEventMethod);
    }
}
