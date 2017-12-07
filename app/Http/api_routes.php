<?php

$api = app('Dingo\Api\Routing\Router');
//$dispatcher = app('Dingo\Api\Dispatcher');

$api->version('v1', function ($api) {
    $api->post('auth/login', 'App\Api\V1\Controllers\AuthController@login');
    $api->post('auth/signup', 'App\Api\V1\Controllers\AuthController@signup');
    $api->post('auth/recovery', 'App\Api\V1\Controllers\AuthController@recovery');
    $api->post('auth/reset', 'App\Api\V1\Controllers\AuthController@reset');

    // example of protected route
    $api->get('protected', ['middleware' => ['api.auth'], function () {
        return \App\User::all();
        //return $currentUser = JWTAuth::parseToken()->authenticate();
    }]);

    $api->group(['middleware' => 'api.auth'], function ($api) {
        //
        $api->resources([
            'bouncers' => 'App\Api\V1\Controllers\BouncerController',
        ]);

        // $api->get('status/{buid}', 'App\Api\V1\Controllers\PoolController@status');
        $api->get('status/databases', 'App\Api\V1\Controllers\PoolController@action');
        $api->get('status/stats', 'App\Api\V1\Controllers\PoolController@action');
        $api->get('status/pools', 'App\Api\V1\Controllers\PoolController@action');
        $api->get('status/clients', 'App\Api\V1\Controllers\PoolController@action');
        $api->get('status/conf', 'App\Api\V1\Controllers\PoolController@action');

        $api->get('status/databases/{buid}', 'App\Api\V1\Controllers\PoolController@action');
        $api->get('status/stats/{buid}', 'App\Api\V1\Controllers\PoolController@action');
        $api->get('status/pools/{buid}', 'App\Api\V1\Controllers\PoolController@action');
        $api->get('status/clients/{buid}', 'App\Api\V1\Controllers\PoolController@action');
        $api->get('status/conf/{buid}', 'App\Api\V1\Controllers\PoolController@action');
    });

    // This route seems to throw an error inside, probably this format is not expected by a parser
    /*
    $api->get('free', function() {
        return array('status'=> 'free route works');
    });
    */

    /*
    $api->get('status', ['middleware' => ['api.auth'], function () {
        // We need to trap this as cli stuff does not have JWT token inside. weird framework behavior
        $sapi_type = php_sapi_name();
        if (substr($sapi_type, 0, 3) == 'cli') {
            //return \App\User::all();
            return null;
        } else {
            return $currentUser = JWTAuth::parseToken()->authenticate();
        }
    }]);
    */
});
