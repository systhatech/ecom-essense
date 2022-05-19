<?php

use App\Services\CurlFetchService;

if (!function_exists('getLoggedInUser')) {

    function getLoggedInUser()
    {
           if (session('user_id')) {
            $user = (new CurlFetchService())->getLoggedInUser(session('user_id'));
          
            return $user;
        }
        return null;
        // $user = (new CurlFetchService())->getAuthenticatedClient(request());
        // if (isset($user['status']) && !$user['status']) {
        //     return false;
        // }
        // return $user;
    }
}
