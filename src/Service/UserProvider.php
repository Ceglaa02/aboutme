<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class UserProvider
{
    public function userIsLoggedIn(?UserInterface $user): bool{
        return !is_null($user);
    }

    public function register($request, $passwordHasher, $entityManager): bool{
        $email = $request->request->get('email');
        $plainPassword = $request->request->get('plainPassword');
        $passwordRepeat = $request->request->get('passwordRepeat');

        if ($plainPassword !== $passwordRepeat) {
            return false;
        }

        $user = new User();
        $user->setEmail($email);

        $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
        $user->setPassword($hashedPassword);

        $entityManager->persist($user);
        $entityManager->flush();

        return true;
    }
}
