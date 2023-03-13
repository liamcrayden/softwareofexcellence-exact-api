<?php 

require_once('../vendor/autoload.php');

use Crayden\SoftwareOfExcellenceExactAPI\ExactAPIClient;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\PracticeAPI;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\AppointmentAPI;

use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\InvalidAPIResponseException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\OutsideScopeAccessException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\PracticeInaccessibleException;

$client_id = '';
$client_secret = '';

$exact = new ExactAPIClient( $client_id, $client_secret );
$exact->addScopes(['practice.get', 'appointment.list']);
$practiceAPI = new PracticeAPI( $exact );
$appointmentAPI = new AppointmentAPI( $exact );

try 
{ 
    $practice = $practiceAPI->getPractice('WFEVAL');
    $from = new \DateTime('-2 months', new \DateTimeZone('Europe/London'));
    $to = new \DateTime('now', new \DateTimeZone('Europe/London'));

    $appointments = $appointmentAPI->getAppointmentsBetween(
        $practice->getPracticeId(), 
        $from, 
        $to
    );

    print_r( $appointments );
} catch ( OutsideScopeAccessException $e ) { 
    echo "OutsideScopeAccessException: " . $e->getMessage() . PHP_EOL;
} catch ( PracticeInaccessibleException $e ) { 
    echo "PracticeInaccessibleException: " . $e->getMessage() . PHP_EOL;
} catch ( InvalidAPIResponseException $e ) { 
    echo "InvalidAPIResponseException: " . $e->getMessage() . PHP_EOL;
} catch ( \Exception $e ) { 
    echo "Exception: " . $e->getMessage() . PHP_EOL;
}