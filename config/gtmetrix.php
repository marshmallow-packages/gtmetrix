<?php

return [

    /**
     * Create an account on GTmetrix.com. Enter you email address
     * here of use the env file to do this.
     */
	'email_address' => env('GTMETRIX_EMAIL_ADDRESS', null),

    /**
     * Once you've created your account you can request an API key,
     * once you have one, add it here of in the .env.
     */
    'api_key'       => env('GTMETRIX_API_KEY', null),

    /**
     * We store information about the credits in a json
     * file on your server. You can change the location fot
     * this file here.
     */
    'account_status_storage' => storage_path('gtmetrix.status.json'),


    /**
     * The options that are used in the Nova fields
     */
    'field' => [

        /**
         * What do you concider to be a perfect score?
         */
        'perfect' => [
            'pagespeed_score'   => 100,
            'yslow_score'       => 100,
        ],

        /**
         * Here you can update the values on with you want to be red, orange or green.
         * By default eveything below 60 is red, everyting between 60 and 90 is orange
         * and everything from 90 is markes green.
         */
        'badges' => [

            /**
             * All scores below 60 will be red. Everything from 60 to 89 will be orange.
             */
            'warning'   => 60,

            /**
             * All scores from 90 till 100 will be shown in green.
             */
            'success'   => 90,
        ]
    ],

    /**
     * Endpoint to GT metrix api toe get the test data.
     */
    'api_endpoint'  => 'https://gtmetrix.com/api/0.1/',
];
