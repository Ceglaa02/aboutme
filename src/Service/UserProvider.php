<?php

namespace App\Service;

use Symfony\Component\Security\Core\User\UserInterface;

class UserProvider
{
    public function userIsLoggedIn(?UserInterface $user): bool{
        return !is_null($user);
    }
}
