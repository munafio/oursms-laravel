<?php

return [

    /*
    |-------------------------------------
    | OurSMS service credentials
    |-------------------------------------
    */
    'user_id' => env('OURSMS_USER_ID', null),
    'secret_key' => env('OURSMS_SECRET_KEY', null),

    /*
    |-------------------------------------
    | OurSMS service API base_uri
    |-------------------------------------
    */
    'base_uri' => 'https://oursms.app/api​/v1​/SMS'
];
