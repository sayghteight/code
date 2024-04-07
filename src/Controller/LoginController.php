<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class LoginController extends AbstractController
{
    public function login(Request $request, JWTTokenManagerInterface $jwtManager)
    {
        $user = $this->getUser();

        if (!$user instanceof UserInterface) {
            throw new BadCredentialsException('Invalid credentials');
        }

        $token = $jwtManager->create($user);

        return new JsonResponse(['token' => $token]);
    }

}