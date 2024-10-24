<?php

namespace App\Controller;

use App\Service\UserProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function __construct(private readonly UserProvider $userProvider)
    {
    }

    #[Route('/account', name: 'app_account')]
    public function account(): Response
    {
        $user = $this->getUser();

        if (empty($user)) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render(
            'account.html.twig',
            [
                'user' => $user,
                'userIsLoggedIn' => $this->userProvider->userIsLoggedIn($user)
            ]
        );
    }

    #[Route('/account/save', name: 'app_account_save')]
    public function save(): Response
    {
        return new Response('git');
    }
}
