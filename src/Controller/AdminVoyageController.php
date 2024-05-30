<?php

namespace App\Controller;

use App\Entity\Voyage;
use App\Form\AdminVoyageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class AdminVoyageController extends AbstractController
{
    private $entityManager; 

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/voyage', name: 'app_admin_voyage')]
    public function index(Request $request): Response
    {
        $voyage = new Voyage();
        $form = $this->createForm(AdminVoyageType::class, $voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($voyage);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_voyage');
        }

        return $this->render('admin_voyage/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
