<?php

// src/Controller/EditeurController.php

namespace App\Controller;

use App\Entity\Editeur;
use App\Form\EditeurType;
use App\Service\CrudService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/editeur')]
class EditeurController extends AbstractController
{
    private CrudService $crudService;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
    }

    #[Route('/', name: 'editeur_index', methods: ['GET'])]
    public function index(): Response
    {
        $editeurs = $this->crudService->getRepository(Editeur::class)->findAll();
        return $this->render('editeur/index.html.twig', [
            'editeurs' => $editeurs,
        ]);
    }

    #[Route('/new', name: 'editeur_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $editeur = new Editeur();
        $form = $this->createForm(EditeurType::class, $editeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->crudService->create($editeur);
            return $this->redirectToRoute('editeur_index');
        }

        return $this->render('editeur/new.html.twig', [
            'editeur' => $editeur,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'editeur_show', methods: ['GET'])]
    public function show(Editeur $editeur): Response
    {
        return $this->render('editeur/show.html.twig', [
            'editeur' => $editeur,
        ]);
    }

    #[Route('/{id}/edit', name: 'editeur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Editeur $editeur): Response
    {
        $form = $this->createForm(EditeurType::class, $editeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->crudService->update();
            return $this->redirectToRoute('editeur_index');
        }

        return $this->render('editeur/edit.html.twig', [
            'editeur' => $editeur,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'editeur_delete', methods: ['POST'])]
    public function delete(Request $request, Editeur $editeur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$editeur->getId(), $request->request->get('_token'))) {
            $this->crudService->delete($editeur);
        }

        return $this->redirectToRoute('editeur_index');
    }
}
