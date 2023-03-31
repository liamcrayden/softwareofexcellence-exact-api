<?php 

require_once('../vendor/autoload.php');

use Crayden\SoftwareOfExcellenceExactAPI\ExactAPIClient;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\SubscriptionAPI;

use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\InvalidAPIResponseException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\OutsideScopeAccessException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\AuthorizationException;

$client_id = '';
$client_secret = '';

$exact = new ExactAPIClient( $client_id, $client_secret );
$exact->setEnvironment('qa');
$subscriptionAPI = new SubscriptionAPI( $exact );

try 
{ 
    $subscriptions = $subscriptionAPI->getActiveSubscriptions();
    echo "Number of subscribers: {$subscriptions->count()}" . PHP_EOL;
    echo "WFEVAL subcribes?: {$subscriptions->hasSubscriber('WFEVAL')}" . PHP_EOL;
    echo "List of subscribers:" . PHP_EOL . PHP_EOL;

    foreach( $subscriptions->getSubscribers() as $subscriber )
    {
        echo "\t{$subscriber}" . PHP_EOL;
    }
} catch ( OutsideScopeAccessException $e ) { 
    echo "OutsideScopeAccessException: " . $e->getMessage() . PHP_EOL;
} catch ( PracticeInaccessibleException $e ) { 
    echo "PracticeInaccessibleException: " . $e->getMessage() . PHP_EOL;
} catch ( InvalidAPIResponseException $e ) { 
    echo "InvalidAPIResponseException: " . $e->getMessage() . PHP_EOL;
} catch ( AuthorizationException $e ) { 
    echo "AuthorizationException: " . $e->getMessage() . PHP_EOL;
} catch ( \Exception $e ) { 
    echo "Exception: " . $e->getMessage() . PHP_EOL;
}