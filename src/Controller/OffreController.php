<?php


namespace App\Controller;

use App\Form\OffreFilterType;
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
    private $entityManager;

    public function __construct(CrudService $crudService, EntityManagerInterface $entityManager)
    {
        $this->crudService = $crudService;
        $this->entityManager = $entityManager;
    }

    #[Route('/offre', name: 'offres_index', methods: ['GET', 'POST'])]
    public function index(Request $request, OffreRepository $offreRepository): Response
    {
        $form = $this->createForm(OffreFilterType::class);
        $form->handleRequest($request);

        $criteria = $form->isSubmitted() && $form->isValid() ? $form->getData() : [];
        $offres = $offreRepository->findByCriteria($criteria);

        // Calculate final price for each offer
        foreach ($offres as $offre) {
            $prixFinal = $offreRepository->findPrixFinal($offre->getId());
            if ($prixFinal !== null && array_key_exists('prix_final', $prixFinal)) {
                $offre->prix_final = $prixFinal['prix_final'];
            } else {
                $offre->prix_final = $offre->getPrix(); // Set to original price if final price not found
            }
        }


        return $this->render('offre/offre.html.twig', [
            'offres' => $offres,
            'form' => $form->createView(),
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
            return $this->redirectToRoute('offres_index');
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
            return $this->redirectToRoute('offres_index');
        }

        return $this->render('offre/edit.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/offre/{id}', name: 'offre_delete', methods: ['POST'])]
    public function delete(Request $request, Offre $offre): Response
    {
        if ($this->isCsrfTokenValid('delete' . $offre->getId(), $request->request->get('_token'))) {
            $this->crudService->delete($offre);
        }

        return $this->redirectToRoute('offres_index');
    }

    #[Route('/offre/prix/{id}', name: 'offre_show_prix', methods: ['GET'])]
    public function showPrix(int $id, OffreRepository $offreRepository): Response
    {
        $prixDetails = $offreRepository->findPrixFinal($id);

        if (!$prixDetails) {
            throw $this->createNotFoundException('Offre non trouvée.');
        }

        return $this->render('offre/prix.html.twig', [
            'prixDetails' => $prixDetails,
        ]);
    }
}
