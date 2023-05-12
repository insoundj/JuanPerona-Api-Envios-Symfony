<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/registro", name="api_registro", methods="post")
     */
    public function registro(UserPasswordHasherInterface $passHasher, UserRepository $userRepository, Request $request)
    {
        $user = new User();
        $user->setEmail('juan@gmail.com');
        $passTextPlain = "123456";
        $passHashed = $passHasher->hashPassword($user, $passTextPlain);
        $user->setPassword($passHashed);
        $userRepository->add($user,true);

        return $this->json(["respuesta"=>$user]);
    }   
}
