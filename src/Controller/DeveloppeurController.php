<?php

// src/Controller/DeveloppeurController.php

namespace App\Controller;

use App\Entity\Developpeur;
use App\Form\DeveloppeurType;
use App\Service\CrudService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/developpeur')]
class DeveloppeurController extends AbstractController
{
    private CrudService $crudService;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
    }

    #[Route('/', name: 'developpeur_index', methods: ['GET'])]
    public function index(): Response
    {
        $developpeurs = $this->crudService->getRepository(Developpeur::class)->findAll();
        return $this->render('developpeur/index.html.twig', [
            'developpeurs' => $developpeurs,
        ]);
    }

    #[Route('/new', name: 'developpeur_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $developpeur = new Developpeur();
        $form = $this->createForm(DeveloppeurType::class, $developpeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->crudService->create($developpeur);
            return $this->redirectToRoute('developpeur_index');
        }

        return $this->render('developpeur/new.html.twig', [
            'developpeur' => $developpeur,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'developpeur_show', methods: ['GET'])]
    public function show(Developpeur $developpeur): Response
    {
        return $this->render('developpeur/show.html.twig', [
            'developpeur' => $developpeur,
        ]);
    }

    #[Route('/{id}/edit', name: 'developpeur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Developpeur $developpeur): Response
    {
        $form = $this->createForm(DeveloppeurType::class, $developpeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->crudService->update();
            return $this->redirectToRoute('developpeur_index');
        }

        return $this->render('developpeur/edit.html.twig', [
            'developpeur' => $developpeur,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'developpeur_delete', methods: ['POST'])]
    public function delete(Request $request, Developpeur $developpeur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$developpeur->getId(), $request->request->get('_token'))) {
            $this->crudService->delete($developpeur);
        }

        return $this->redirectToRoute('developpeur_index');
    }
}
