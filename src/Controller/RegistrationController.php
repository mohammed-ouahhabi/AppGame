<?php

// src/Controller/RegistrationController.php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Service\CrudService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/register')]
class RegistrationController extends AbstractController
{
    private UserPasswordHasherInterface $passwordHasher;
    private CrudService $crudService;

    public function __construct(UserPasswordHasherInterface $passwordHasher, CrudService $crudService)
    {
        $this->passwordHasher = $passwordHasher;
        $this->crudService = $crudService;
    }

    #[Route('/', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(Request $request): Response
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $user->getPassword()
            );
            $user->setPassword($hashedPassword);
            $this->crudService->create($user);

            // Redirect to login page or any other route after successful registration
            return $this->redirectToRoute('home_index');
        }

        return $this->renderForm('security/register.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
