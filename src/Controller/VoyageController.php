<?php
namespace App\Controller;

use App\Entity\Voyage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoyageController extends AbstractController
{
    #[Route('/voyage', name: 'app_voyage')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $voyages = $entityManager->getRepository(Voyage::class)->findAll();
        
        return $this->render('voyage/index.html.twig', [
            'voyages' => $voyages,
        ]);
    }
    #[Route('/inscrit', name: 'app_inscrit')]
    public function inscrit(): Response
    {
        return $this->render('voyage/inscrit.html.twig');
    }
}
