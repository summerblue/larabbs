<?php
<<<<<<< HEAD
namespace Tests\Traits;

=======

namespace Tests\Traits;
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531

use App\Models\User;

trait ActingJWTUser
{
    public function JWTActingAs(User $user)
    {
        $token = auth('api')->fromUser($user);
<<<<<<< HEAD
        $this->withHeaders(['Authorization'=>'Bearer '.$token]);
=======
        $this->withHeaders(['Authorization' => 'Bearer '.$token]);

>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
        return $this;
    }
}
