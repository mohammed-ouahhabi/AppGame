<?php

namespace App\Controller;

use App\Service\CrudService;
use App\Entity\Offre;
use App\Form\OffreType;
use App\Repository\OffreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffreController extends AbstractController
{
    private $crudService;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
    }
    #[Route('/offre', name: 'offre', methods: ['GET'])]
    public function index(OffreRepository $offreRepository): Response
    {
        return $this->render('offre/offre.html.twig', [
            'offres' => $offreRepository->findAll(),
        ]);
    }

    #[Route('/offre/new', name: 'offre_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $offre = new Offre();
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->crudService->create($offre);
            return $this->redirectToRoute('offre');
        }

        return $this->render('offre/new.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/offre/{id}/edit', name: 'offre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Offre $offre): Response
    {
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->crudService->update();
            return $this->redirectToRoute('offre');
        }

        return $this->render('offre/edit.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/offre/{id}', name: 'offre_delete', methods: ['POST'])]
    public function delete(Offre $offre): Response
    {

        $this->crudService->delete($offre);
        return $this->redirectToRoute('offre');

    }
}
