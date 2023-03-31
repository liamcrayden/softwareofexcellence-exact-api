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

$practice_id = 'WFEVAL';
$patient_id = '00000dff-1300-0000-0000-008034ec7256';

$exact = new ExactAPIClient( $client_id, $client_secret );
$exact->setEnvironment('qa');
$exact->addScopes(['patient.get', 'patient.get.contactdetails.phone', 'patient.get.contactdetails.email']);
$patientAPI = new PatientAPI( $exact );

try 
{ 
    $details = $patientAPI->getPatientContactDetails($practice_id, $patient_id);

    echo "Number of email addresses: " . count( $details->getEmailAddresses() ) . PHP_EOL;
    echo "Number of phone numbers: " . count( $details->getPhoneNumbers() ) . PHP_EOL;
    echo "First email: {$details->getPrimaryEmailAddress()}" . PHP_EOL;
    echo "First number: {$details->getPrimaryPhoneNumber()}" . PHP_EOL . PHP_EOL;         // This is cast as a string

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