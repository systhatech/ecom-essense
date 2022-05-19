<?php

namespace Systha\EssencesSite\Traits;


trait HandlesLoginSession
{
    public function setLoggedInUser(array $data)
    {
        session([
            'user_id' => $data['id']
        ]);
    }

    public function getLoggedInUser()
    {
        return session('user_id') ?? null;
    }


    public function logoutUserSession()
    {
        session()->forget('user_id');
    }
}
