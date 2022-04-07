<?php

declare(strict_types=1);

namespace Mycom\Tracker\S2S\Api;

use Mycom\Tracker\S2S\Api\Client\ClientInterface;
use Mycom\Tracker\S2S\Api\Common\{Credentials, Gender, Introductory, PaymentState};

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
     * @return string
     * @throws Exception\ExceptionInterface
     */
    public static function getActualVersion(ClientInterface $client = null): string
    {
        $client ??= Client::getDefault();
        $method = new VersionMethod();
        $response = $client->request($method);
        $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        return $data[VersionMethod::VERSION_FIELD];
    }

    /**
     * Check s2s app access and return response status code.
     *
     * @param int                  $appId        Your app ID in myTracker
     * @param string               $accountToken Your account token in myTracker
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
     * @param int                  $appId        Your app ID in myTracker
     * @param string               $accountToken Your account token in myTracker
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
     * Registration events batch example
     *
     * @param int                  $appId        Your app ID in myTracker
     * @param string               $accountToken Your account token in myTracker
     * @param ClientInterface|null $client
     *
     * @return void
     * @throws Exception\ExceptionInterface
     */
    public static function sendRegistrationEventBatch(int $appId, string $accountToken, ClientInterface $client = null): void
    {
        $client ??= Client::getDefault();

        // prepare registration event method instance for specified application
        $accountCredentials = new Credentials($accountToken);
        $registrationBatchMethod = new RegistrationBatchMethod($accountCredentials, $appId);

        // prepare our first event
        $params = $registrationBatchMethod->addParams();
        $params->customUserId = '100500';
        $params->idGender = Gender::FEMALE;
        $params->age = 25;
        $params->lvid = '00000000000000000000000000000001';

        // prepare our second event
        $params = $registrationBatchMethod->addParams();
        $params->customUserId = '42';
        $client->request($registrationBatchMethod);
    }

    /**
     * Login events example
     *
     * @param int                  $appId        Your app ID in myTracker
     * @param string               $accountToken Your account token in myTracker
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
     * Login events batch method example
     *
     * @param int                  $appId        Your app ID in myTracker
     * @param string               $accountToken Your account token in myTracker
     * @param ClientInterface|null $client
     *
     * @return void
     * @throws Exception\ExceptionInterface
     */
    public static function sendLoginEventBatch(int $appId, string $accountToken, ClientInterface $client = null): void
    {
        $client ??= Client::getDefault();

        // prepare login event method instance for specified application
        $accountCredentials = new Credentials($accountToken);
        $loginBatchMethod = new LoginBatchMethod($accountCredentials, $appId);
        // prepare our first event
        $params = $loginBatchMethod->addParams();
        $params->customUserId = '100500';
        $params->eventTimestamp = strtotime('2020-04-22 14:00');

        // prepare our second event
        $params = $loginBatchMethod->addParams();
        $params->customUserId = '42';
        $params->ipv4 = '8.8.8.8';
        $params->eventTimestamp = strtotime('2020-04-22 14:02');
        $client->request($loginBatchMethod);
    }

    /**
     * Custom events example
     *
     * @param int                  $appId        Your app ID in myTracker
     * @param string               $accountToken Your account token in myTracker
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
     * Custom events batch example
     *
     * @param int                  $appId        Your app ID in myTracker
     * @param string               $accountToken Your account token in myTracker
     * @param ClientInterface|null $client
     *
     * @return void
     * @throws Exception\ExceptionInterface
     */
    public static function sendCustomEventBatch(int $appId, string $accountToken, ClientInterface $client = null): void
    {
        $client ??= Client::getDefault();

        // prepare custom event method instance for specified application
        $accountCredentials = new Credentials($accountToken);
        $customEventBatchMethod = new CustomEventBatchMethod($accountCredentials, $appId);

        // prepare our first event
        $params = $customEventBatchMethod->addParams();
        $params->customUserId = '100500';
        $params->customEventName = 'levelUp';
        $params->customEventParams = ['level' => '2'];
        $params->lvid = '00000000000000000000000000000001';

        // prepare our second event
        $params = $customEventBatchMethod->addParams();
        $params->customUserId = '42';
        $params->customEventName = 'levelUp';
        $params->customEventParams = [
            'level' => '5',
            'coins' => '10',
        ];
        $client->request($customEventBatchMethod);
    }

    /**
     * Custom revenue example
     *
     * @param int                  $appId        Your app ID in myTracker
     * @param string               $accountToken Your account token in myTracker
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

    /**
     * Custom revenue batch example
     *
     * @param int                  $appId        Your app ID in myTracker
     * @param string               $accountToken Your account token in myTracker
     * @param ClientInterface|null $client
     *
     * @return void
     * @throws Exception\ExceptionInterface
     */
    public static function sendCustomRevenueBatch(int $appId, string $accountToken, ClientInterface $client = null): void
    {
        $client ??= Client::getDefault();

        // prepare custom event method instance for specified application
        $accountCredentials = new Credentials($accountToken);
        $customRevenueBatchMethod = new CustomRevenueBatchMethod($accountCredentials, $appId);

        // prepare our first event
        $params = $customRevenueBatchMethod->addParams();
        $params->customUserId = '100500';
        $params->idTransaction = 'order1';
        $params->currency = 'USD';
        $params->total = 4.5;
        $params->lvid = '00000000000000000000000000000001';

        // prepare our second event
        $params = $customRevenueBatchMethod->addParams();
        $params->customUserId = '42';
        $params->idTransaction = 'order2';
        $params->currency = 'RUB';
        $params->total = 3000;

        $client->request($customRevenueBatchMethod);
    }

    /**
     * Google play product transaction exapmle
     *
     * @param int                  $appId        Your app ID in myTracker
     * @param string               $accountToken Your account token in myTracker
     * @param ClientInterface|null $client
     *
     * @return void
     * @throws Exception\ExceptionInterface
     */
    public static function sendGooglePlayProductTransaction(int $appId, string $accountToken, ClientInterface $client = null): void
    {
        $client ??= Client::getDefault();

        // prepare google play product transaction method instance for specified application
        $accountCredentials = new Credentials($accountToken);
        $googlePlayProductTransaction = new GooglePlayProductTransactionMethod($accountCredentials, $appId);

        // send our data
        $params = $googlePlayProductTransaction->params();
        $params->customUserId = '100500';
        $params->eventTimestamp = time();
        $params->orderId = '234-1234-1234-12345';
        $params->productId = '001';
        $params->token = 'ofjkingojelmkmedpgfkfelj';
        $params->currency = 'USD';
        $params->revenue = 10.0;

        $client->request($googlePlayProductTransaction);

        // cleanup method params before next call
        $params->reset();

        // send our next transaction
        $params->customUserId = '500100';
        $params->eventTimestamp = time();
        $params->orderId = '321-4321-4321-54321';
        $params->productId = '002';
        $params->token = 'jlefkfgpdemkmlejognikjfo';
        $params->currency = 'USD';
        $params->revenue = 20.0;

        $client->request($googlePlayProductTransaction);
    }

    /**
     * Google play product transaction batch exapmle
     *
     * @param int                  $appId        Your app ID in myTracker
     * @param string               $accountToken Your account token in myTracker
     * @param ClientInterface|null $client
     *
     * @return void
     * @throws Exception\ExceptionInterface
     */
    public static function sendGooglePlayProductTransactionBatch(int $appId, string $accountToken, ClientInterface $client = null): void
    {
        $client ??= Client::getDefault();

        // prepare google play product transaction method instance for specified application
        $accountCredentials = new Credentials($accountToken);
        $googlePlayProductTransaction = new GooglePlayProductTransactionBatchMethod($accountCredentials, $appId);

        // prepare our first event
        $params = $googlePlayProductTransaction->addParams();
        $params->customUserId = '100500';
        $params->eventTimestamp = time();
        $params->orderId = '234-1234-1234-12345';
        $params->productId = '001';
        $params->token = 'ofjkingojelmkmedpgfkfelj';
        $params->currency = 'USD';
        $params->revenue = 10.0;

        // prepare our second event
        $params = $googlePlayProductTransaction->addParams();
        $params->customUserId = '500100';
        $params->eventTimestamp = time();
        $params->orderId = '321-4321-4321-54321';
        $params->productId = '002';
        $params->token = 'jlefkfgpdemkmlejognikjfo';
        $params->currency = 'USD';
        $params->revenue = 20.0;

        $client->request($googlePlayProductTransaction);
    }

    /**
     * Google play subscription transaction exapmle
     *
     * @param int                  $appId        Your app ID in myTracker
     * @param string               $accountToken Your account token in myTracker
     * @param ClientInterface|null $client
     *
     * @return void
     * @throws Exception\ExceptionInterface
     */
    public static function sendGooglePlaySubscriptionTransaction(int $appId, string $accountToken, ClientInterface $client = null): void
    {
        $client ??= Client::getDefault();

        // prepare google play subscription transaction method instance for specified application
        $accountCredentials = new Credentials($accountToken);
        $googlePlaySubscriptionTransaction = new GooglePlaySubscriptionTransactionMethod($accountCredentials, $appId);

        // send our data
        $params = $googlePlaySubscriptionTransaction->params();
        $params->customUserId = '100500';
        $params->eventTimestamp = time();
        $params->orderId = '234-1234-1234-12345';
        $params->priceCurrencyCode = 'USD';
        $params->priceAmountMicros = 1990000;
        $params->subscriptionId = 'monthly001';

        $client->request($googlePlaySubscriptionTransaction);

        // cleanup method params before next call
        $params->reset();

        // send our next transaction
        $params->customUserId = '500100';
        $params->eventTimestamp = time();
        $params->orderId = '234-1234-1234-54321';
        $params->priceCurrencyCode = 'USD';
        $params->priceAmountMicros = 5990000;
        $params->subscriptionId = 'monthly002';
        $params->paymentState = PaymentState::RECEIVED;
        $params->isIntroductory = Introductory::REGULAR;
        $params->startTimeMillis = 1693242344000;
        $params->expiryTimeMillis = 1693242344000;

        $client->request($googlePlaySubscriptionTransaction);
    }

    /**
     * Google play subscription transaction batch exapmle
     *
     * @param int                  $appId        Your app ID in myTracker
     * @param string               $accountToken Your account token in myTracker
     * @param ClientInterface|null $client
     *
     * @return void
     * @throws Exception\ExceptionInterface
     */
    public static function sendGooglePlaySubscriptionTransactionBatch(int $appId, string $accountToken, ClientInterface $client = null): void
    {
        $client ??= Client::getDefault();

        // prepare google play subscription transaction method instance for specified application
        $accountCredentials = new Credentials($accountToken);
        $googlePlaySubscriptionTransaction = new GooglePlaySubscriptionTransactionBatchMethod($accountCredentials, $appId);

        // prepare our first event
        $params = $googlePlaySubscriptionTransaction->addParams();
        $params->customUserId = '100500';
        $params->eventTimestamp = time();
        $params->orderId = '234-1234-4321-12345';
        $params->priceCurrencyCode = 'USD';
        $params->priceAmountMicros = 1990000;
        $params->subscriptionId = 'monthly001';

        // prepare our second event
        $params = $googlePlaySubscriptionTransaction->addParams();
        $params->customUserId = '500100';
        $params->eventTimestamp = time();
        $params->orderId = '2345-1234-1234-12345';
        $params->priceCurrencyCode = 'USD';
        $params->priceAmountMicros = 5990000;
        $params->subscriptionId = 'monthly002';
        $params->paymentState = PaymentState::RECEIVED;
        $params->isIntroductory = Introductory::REGULAR;
        $params->startTimeMillis = 1693242344000;
        $params->expiryTimeMillis = 1693242344000;

        $client->request($googlePlaySubscriptionTransaction);
    }

    /**
     * Google play subscription token exapmle
     *
     * @param int                  $appId        Your app ID in myTracker
     * @param string               $accountToken Your account token in myTracker
     * @param ClientInterface|null $client
     *
     * @return void
     * @throws Exception\ExceptionInterface
     */
    public static function sendGooglePlaySubscriptionToken(int $appId, string $accountToken, ClientInterface $client = null): void
    {
        $client ??= Client::getDefault();

        // prepare google play subscription token method instance for specified application
        $accountCredentials = new Credentials($accountToken);
        $googlePlaySubscriptionToken = new GooglePlaySubscriptionTokenMethod($accountCredentials, $appId);

        // send our data
        $params = $googlePlaySubscriptionToken->params();
        $params->customUserId = '100500';
        $params->eventTimestamp = time();
        $params->orderId = '234-1234-1234-12345';
        $params->subscriptionId = 'monthly001';
        $params->token = 'ofjkingojelmkmedpgfkfelj';
        $params->subscriptionPeriod = 'P1M';

        $client->request($googlePlaySubscriptionToken);

        // cleanup method params before next call
        $params->reset();

        // send our next transaction
        $params->customUserId = '100500';
        $params->eventTimestamp = time();
        $params->orderId = '234-1234-1234-12345';
        $params->subscriptionId = 'monthly001';
        $params->token = 'jlefkfgpdemkmlejognikjfo';
        $params->subscriptionPeriod = 'P1M';

        $client->request($googlePlaySubscriptionToken);
    }

    /**
     * Google play subscription token batch exapmle
     *
     * @param int                  $appId        Your app ID in myTracker
     * @param string               $accountToken Your account token in myTracker
     * @param ClientInterface|null $client
     *
     * @return void
     * @throws Exception\ExceptionInterface
     */
    public static function sendGooglePlaySubscriptionTokenBatch(int $appId, string $accountToken, ClientInterface $client = null): void
    {
        $client ??= Client::getDefault();

        // prepare google play subscription token method instance for specified application
        $accountCredentials = new Credentials($accountToken);
        $googlePlaySubscriptionToken = new GooglePlaySubscriptionTokenBatchMethod($accountCredentials, $appId);

        // prepare our first event
        $params = $googlePlaySubscriptionToken->addParams();
        $params->customUserId = '100500';
        $params->eventTimestamp = time();
        $params->orderId = '234-1234-1234-12345';
        $params->subscriptionId = 'monthly001';
        $params->token = 'ofjkingojelmkmedpgfkfelj';
        $params->subscriptionPeriod = 'P1M';

        // prepare our second event
        $params = $googlePlaySubscriptionToken->addParams();
        $params->customUserId = '100500';
        $params->eventTimestamp = time();
        $params->orderId = '234-1234-1234-12345';
        $params->subscriptionId = 'monthly001';
        $params->token = 'jlefkfgpdemkmlejognikjfo';
        $params->subscriptionPeriod = 'P1M';

        $client->request($googlePlaySubscriptionToken);
    }
}
