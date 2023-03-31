<?php 

require_once('../vendor/autoload.php');

use Crayden\SoftwareOfExcellenceExactAPI\ExactAPIClient;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\PracticeAPI;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\PatientAPI;
use Crayden\SoftwareOfExcellenceExactAPI\Models\PatientContactRequest;
use Crayden\SoftwareOfExcellenceExactAPI\Models\PatientMessageType;

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
$exact->addScopes(['patient.contact']);
$patientAPI = new PatientAPI( $exact );

try 
{ 
    $contact = new PatientContactRequest;
    $contact->setType( new PatientMessageType('Email') );
    $contact->setSubject('Test Email');
    $contact->setBody('This is a test email. I could also use HTML here.');

    echo (string)$contact;
    // exit;
    
    $request = $patientAPI->sendContact($practice_id, $patient_id, $contact);
    echo "Email queued successfully." . PHP_EOL;

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