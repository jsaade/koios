<?php


return array(

    'laf_IOS'     => array(
        'environment' =>'production',
        'certificate' => uploads_path().'547ed69a2ebd5/certificates/apns-prod-cert.pem',
        'passPhrase'  =>'laf_push@123',
        'service'     =>'apns'
    ),
    'laf_ANDROID' => array(
        'environment' =>'production',
        'apiKey'      =>'yourAPIKey',
        'service'     =>'gcm'
    )
);