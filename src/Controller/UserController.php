<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function profile(): Response
    {
        $user = $this->getUser();
        if(empty($user)){
            return $this->redirectToRoute('app_login');
        }
        dd($user);
        return new Response('profile');
    }
}
