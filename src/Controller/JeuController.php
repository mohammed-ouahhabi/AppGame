<?php

// src/Controller/JeuController.php

namespace App\Controller;

use App\Service\CrudService;
use App\Entity\Jeux;
use App\Entity\Offre;
use App\Entity\UserWishlist;
use App\Form\JeuxType;
use App\Repository\JeuxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class JeuController extends AbstractController
{
    private $crudService;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
    }

    #[Route('/jeu/{id}', name: 'jeu_afficher')]
    public function afficher(int $id, JeuxRepository $jeuxRepository): Response
    {
        $jeu = $jeuxRepository->find($id);

        if (!$jeu) {
            throw $this->createNotFoundException('Le jeu demandé n\'existe pas.');
        }

        $offres = $jeu->getOffres();

        return $this->render('jeu/index.html.twig', [
            'jeu' => $jeu,
            'offres' => $offres,
        ]);
    }

    #[Route('/', name: 'home_index')]
    public function home(JeuxRepository $jeuxRepository): Response
    {
        $jeux = $jeuxRepository->findAll();
        return $this->render('jeu/home.html.twig', [
            'jeux' => $jeux,
        ]);
    }

    #[Route('/jeux/new', name: 'jeux_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $jeu = new Jeux();
        $form = $this->createForm(JeuxType::class, $jeu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->crudService->create($jeu);
            return $this->redirectToRoute('home_index');
        }

        return $this->render('jeu/new.html.twig', [
            'jeu' => $jeu,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/jeux/delete/{id}', name: 'jeux_delete', methods: ['POST'])]
    public function delete(Request $request, Jeux $jeu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $jeu->getId(), $request->request->get('_token'))) {
            $this->crudService->delete($jeu);
        }

        return $this->redirectToRoute('home_index');
    }

    #[Route('/add/{id}', name: 'add_cart')]
    public function add(int $id, SessionInterface $session, JeuxRepository $jeuxRepository): Response
    {
        $jeu = $jeuxRepository->find($id);
        if (!$jeu) {
            $this->addFlash('error', 'Game not found.');
            return $this->redirectToRoute('home_index');
        }

        $panier = $session->get('panier', []);
        if (isset($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }
        $session->set('panier', $panier);

        $this->addFlash('success', 'Product added to cart successfully!');
        return $this->redirectToRoute('panier');
    }

    #[Route('/panier', name: 'panier', methods: ['GET'])]
    public function panier(SessionInterface $session, JeuxRepository $jeuxRepository): Response
    {
        $panier = $session->get('panier', []);
        $jeux = [];
        $offres = [];

        foreach ($panier as $jeuId => $quantity) {
            $jeu = $jeuxRepository->find($jeuId);
            if ($jeu) {
                $jeux[] = $jeu;
                $offres = array_merge($offres, $jeu->getOffres()->toArray());
            }
        }

        return $this->render('panier/panier.html.twig', [
            'jeux' => $jeux,
            'offres' => $offres,
        ]);
    }

    #[Route('/panier/clear', name: 'clear_cart', methods: ['POST'])]
    public function clearCart(SessionInterface $session): Response
    {
        $session->remove('panier');
        $this->addFlash('success', 'Panier vidé avec succès!');
        return $this->redirectToRoute('panier');
    }
}
