<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\UserProvider;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'error' =>
                !empty($authenticationUtils->getLastAuthenticationError()) ? 'Niepoprawny email lub hasło' : '',
            'last_username' => $lastUsername,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher,
        UserProvider $userProvider
    ): Response
    {
        if (!$request->isMethod('POST')) {
            return $this->render('security/register.html.twig');
        }

        $userIsRegistered = $userProvider->register($request, $passwordHasher, $entityManager);

        if ($userIsRegistered === false) {
            $this->addFlash('error', 'Hasła nie są takie same.');
            return $this->redirectToRoute('app_register');
        } else{
            return $this->redirectToRoute('app_login');
        }
    }
}
