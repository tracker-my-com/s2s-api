# myTracker S2S API

This library provides tracker.my.com S2S api functionality.


## Documentation

You can read api documentation here - https://tracker.my.com/docs/api/about


## Examples

For quick start you can see some examples in `Example` class:

```php
<?php declare(strict_types=1);

// Check s2s api accessible without any credentials:
$v = Mycom\Tracker\S2S\Api\Example::getActualVersion();
echo $v, PHP_EOL;

// Check your account token:
$yourAppId = 1;
$yourAccountToken = '';
$responseCode = Mycom\Tracker\S2S\Api\Example::testAppAccess($yourAppId, $yourAccountToken);
echo $responseCode, PHP_EOL;

// See how you can send events inside this methods:
Mycom\Tracker\S2S\Api\Example::sendRegistrationEvent($yourAppId, $yourAccountToken);
Mycom\Tracker\S2S\Api\Example::sendLoginEvent($yourAppId, $yourAccountToken);
Mycom\Tracker\S2S\Api\Example::sendCustomEvent($yourAppId, $yourAccountToken);
Mycom\Tracker\S2S\Api\Example::sendCustomRevenue($yourAppId, $yourAccountToken);
```
