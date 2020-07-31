<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function before($user, $ability)
	{
	    // if ($user->isSuperAdmin()) {
	    // 		return true;
	    // }
	}
}
