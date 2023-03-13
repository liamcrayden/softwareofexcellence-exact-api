<?php 

require_once('../vendor/autoload.php');

use Crayden\SoftwareOfExcellenceExactAPI\ExactAPIClient;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\PracticeAPI;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\PatientAPI;

use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\InvalidAPIResponseException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\OutsideScopeAccessException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\PracticeInaccessibleException;

$client_id = '';
$client_secret = '';

$practice_id = 'WFEVAL';
$patient_id = '000005ff-1300-0000-0000-008034ec7256';

$exact = new ExactAPIClient( $client_id, $client_secret );
$exact->addScopes(['patient.get']);
$patientAPI = new PatientAPI( $exact );

try 
{ 
    $patient = $patientAPI->getPatient($practice_id, $patient_id);
    print_r( $patient->toArray() );
} catch ( OutsideScopeAccessException $e ) { 
    echo "OutsideScopeAccessException: " . $e->getMessage() . PHP_EOL;
} catch ( PracticeInaccessibleException $e ) { 
    echo "PracticeInaccessibleException: " . $e->getMessage() . PHP_EOL;
} catch ( InvalidAPIResponseException $e ) { 
    echo "InvalidAPIResponseException: " . $e->getMessage() . PHP_EOL;
} catch ( \Exception $e ) { 
    echo "Exception: " . $e->getMessage() . PHP_EOL;
}