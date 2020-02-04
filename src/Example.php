<?php declare(strict_types=1);

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
     * Custom events example
     * @see  doc
     *
     * @param int    $trackerAppId          Your application id in tracker
     * @param string $mytrackerAccountToken Your tracker account token
     *
     * @todo add link to doc about events here, how to generate token
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
            ->setCustomUserId('1')
            ->setCustomEventName('levelUp')
            ->addCustomEventParam('level', '2')
            ->setIdGender(Gender::FEMALE)
            ->setAge(25)
            ->setLvid('00000000000000000000000000000001');
        $client->request($customEventMethod);

        // cleanup method params before next call
        $customEventMethod->params()->reset();

        // send our next event
        $customEventMethod->params()
            ->setCustomUserId('2')
            ->setCustomEventName('levelUp')
            ->addCustomEventParam('level', '5')
            ->addCustomEventParam('coins', '10');
        $client->request($customEventMethod);
    }
}
