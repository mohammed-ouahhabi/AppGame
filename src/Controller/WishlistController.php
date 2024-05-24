<?php

namespace App\Controller;

use App\Entity\UserWishlist;
use App\Entity\Jeux;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/wishlist')]
class WishlistController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/add', name: 'wishlist_add', methods: ['POST'])]
    public function addToWishlist(Request $request): Response
    {
        $user = $this->getUser();
        $jeuId = $request->request->get('jeu_id');

        // Retrieve the Jeux entity by ID
        $jeu = $this->entityManager->getRepository(Jeux::class)->find($jeuId);

        // Create a new UserWishlist entity
        $wishlistItem = new UserWishlist();
        $wishlistItem->setUser($user);
        $wishlistItem->setJeux($jeu);
        $wishlistItem->setEstPublique(true); // Set to true by default, adjust as needed

        // Persist and flush the new wishlist item
        $this->entityManager->persist($wishlistItem);
        $this->entityManager->flush();

        // Redirect back to the games page after adding to wishlist
        return $this->redirectToRoute('home_index');
    }
    #[Route('/', name: 'wishlist_index')]
    public function index(): Response
    {
        // Get the current user's wishlist items
        $user = $this->getUser();
        $wishlistItems = $this->entityManager->getRepository(UserWishlist::class)->findBy(['user' => $user]);
    
        return $this->render('panier/panier.html.twig', [
            'wishlistItems' => $wishlistItems,
        ]);
    }
    #[Route('/clear', name: 'wishlist_clear')]
    public function clearWishlist(): Response
    {
        $user = $this->getUser();
        $wishlistItems = $this->entityManager->getRepository(UserWishlist::class)->findBy(['user' => $user]);

        foreach ($wishlistItems as $wishlistItem) {
            $this->entityManager->remove($wishlistItem);
        }

        $this->entityManager->flush();

        $this->addFlash('success', 'Votre wishlist a été vidée avec succès.');

        return $this->redirectToRoute('wishlist_index');
    }

}

?>
