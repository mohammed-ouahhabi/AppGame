<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Form\OffreType;
use App\Repository\OffreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffreController extends AbstractController
{
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
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offre);
            $entityManager->flush();

            return $this->redirectToRoute('offre');
        }

        return $this->render('offre/new.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/offre/{id}/edit', name: 'offre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Offre $offre, EntityManagerInterface $entityManager): Response    {
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('offre');
        }

        return $this->render('offre/edit.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/offre/{id}', name: 'offre_delete', methods: ['POST'])]
    public function delete(Request $request, Offre $offre, EntityManagerInterface $entityManager): Response {
        $this->logger->info('Delete method called.');
        if (!$this->isCsrfTokenValid('delete' . $offre->getId(), $request->request->get('_token'))) {
            $this->logger->error('CSRF token is invalid.');
            throw new InvalidCsrfTokenException('Invalid CSRF token.');
        }

        $entityManager->remove($offre);
        $entityManager->flush();
        $this->logger->info('Offer deleted successfully.');

        return $this->redirectToRoute('offre');
    }
}
