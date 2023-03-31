<?php 

require_once('../vendor/autoload.php');

use Crayden\SoftwareOfExcellenceExactAPI\ExactAPIClient;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\PracticeAPI;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\PatientAPI;

use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\InvalidAPIResponseException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\OutsideScopeAccessException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\PracticeInaccessibleException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\AuthorizationException;

$client_id = '';
$client_secret = '';

$exact = new ExactAPIClient( $client_id, $client_secret );
$exact->setEnvironment('qa');
$exact->addScopes(['practice.get', 'patient.list', 'patient.get']);
$practiceAPI = new PracticeAPI( $exact );
$patientAPI = new PatientAPI( $exact );

try 
{ 
    $practice = $practiceAPI->getPractice('WFEVAL');
    echo "Practice response:" . PHP_EOL;
    print_r( $practice );

    $patients = $patientAPI->getPatientsForPractice($practice);
    echo "Patients response:" . PHP_EOL;    
    print_r( $patients );
    
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