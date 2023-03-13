# ExactAPI
## A simple PHP Library for interacting with Software Of Excellence eXact API

This library is based on the published documentation available at https://api.ex.softwareofexcellence.com/docs/ and utlises version 1.0 of the API.


### Installation
The preferred method of installation is via Composer.
```bash
$ composer require liamcrayden/softwareofexcellence-exact-api
```


### Basic Usage
Access tokens are managed for you. Simply initialise a new instance of `ExactAPIClient` with your client ID and secret, and add any required scopes.
```php
use Crayden\SoftwareOfExcellenceExactAPI\ExactAPIClient;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\SubscriptionAPI;

$exact = new ExactAPIClient( $client_id, $client_secret );
$exact->addScopes(['productsubscription.get', 'practice.get']);
$subscriptionAPI = new SubscriptionAPI( $exact );
print_r( $subscriptionAPI->getActiveSubscriptions() );
```

```
Array
(
    [0] => UKTEST1
    [1] => UKTEST2
)
```


### Use with Laravel
This package includes a Service Provider for Laravel. Simply install via composer as normal and package discovery will run automatically. You can 
configure the Client ID and Client Secret in your .env file or by publishing and editing the configuration file.

```bash
$ php artisan vendor:publish --tag=soe_exact
```

```env
SOE_EXACT_CLIENT_ID="your-client-id-here"
SOE_EXACT_CLIENT_SECRET="your-client-secret-here"
SOE_EXACT_ENVIRONMENT="qa or production"
```

A facade is included so that you can access a singleton instance of ExactAPIClient with your configuration loaded.

```php
$subscriptionAPI = ExactAPIClient::subscriptionAPI();
print_r( $subscriptionAPI->getActiveSubscriptions() );
```

You are of course free to create a new instance of ExactAPIClient manually by specifying the client ID, client secret and environment manually.


### License
This library is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).