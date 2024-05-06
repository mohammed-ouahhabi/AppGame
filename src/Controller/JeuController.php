<?php

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

        // Récupérer les offres liées au jeu
        $offres = $jeu->getOffres();

        return $this->render('jeu/index.html.twig', [
            'jeu' => $jeu,
            'offres' => $offres  // Passer les offres au template
        ]);
    }

    #[Route('/', name: 'home_index')]
    public function home(JeuxRepository $jeuxRepository): Response
    {
        $jeux = $jeuxRepository->findAll();
        return $this->render('jeu/home.html.twig', [
            'jeux' => $jeux
        ]);
    }

    #[Route('/jeux/new', name: 'jeux_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
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

    #[Route('/jeux/{id}', name: 'jeux_delete', methods: ['POST'])]
    public function delete(Request $request, Jeux $jeu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $jeu->getId(), $request->request->get('_token'))) {
            $this->crudService->delete($jeu);
        }

        return $this->redirectToRoute('home_index');
    }

    #[Route('/add/{id}', name: 'add_cart')]
    public function add(int $id, SessionInterface $session, Jeux $jeux, JeuxRepository $jeuxRepository)
    {
        $panier = $session->get('panier', []);
        $offres = $jeux->getOffres();

        if (isset($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }
        $session->set('panier', $panier);

        $this->addFlash('success', 'Product added to cart successfully!');
        $jeux = $jeuxRepository->findAll();
        return $this->render('Panier/panier.html.twig', [
            'jeux' => $jeux,
            'offres' => $offres,
            // Ensure 'offres' and any other necessary data are also passed if needed
        ]);
    }



    #[Route('/purchase', name: 'purchase', methods: ['POST'])]
    public function validatePurchase(SessionInterface $session, EntityManagerInterface $entityManager, Security $security): Response
    {
        // Check if the cart exists and is not empty
        $panier = $session->get('panier', []);
        if (empty($panier)) {
            $this->addFlash('error', 'Your cart is empty!');
            return $this->redirectToRoute('jeu_afficher'); // Adjust this route if necessary
        }

        // Ensure the user is logged in
        $user = $security->getUser();
        if (!$user) {
            $this->addFlash('error', 'You must be logged in to complete the purchase.');
            return $this->redirectToRoute('login'); // Make sure you have a login route set up
        }

        // Process each item in the cart
        foreach ($panier as $jeuId => $details) {
            $jeu = $entityManager->getRepository(Jeux::class)->find($jeuId);
            if (!$jeu) {
                $this->addFlash('error', "A game in your cart couldn't be found.");
                continue; // Skip this item and continue with the next
            }

            // Create and set up the new wishlist entry
            $wishlist = new UserWishlist();
            $wishlist->setUser($user);
            $wishlist->setJeux($jeu);
            $wishlist->setEstPublique(false); // Default to false, or set based on user input

            $entityManager->persist($wishlist);
        }

        // Save all changes to the database
        $entityManager->flush();

        // Clear the session cart after processing
        $session->remove('panier');
        $this->addFlash('success', 'Your purchase has been saved to your wishlist!');

        // Redirect to a confirmation or home page
        return $this->redirectToRoute('home_index');
    }

}
