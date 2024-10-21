<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\UserProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    public function __construct(private readonly UserProvider $userProvider)
    {
    }

    #[Route('/', name: 'main')]
    public function index(): Response
    {
        $user = $this->getUser();
        $params['user'] = $user;
        $params['userIsLoggedIn'] = $this->userProvider->userIsLoggedIn($user);

        return $this->render("main.html.twig",$params);
    }
}
