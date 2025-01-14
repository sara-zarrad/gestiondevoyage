<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    #[Route('/acceuil', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('acceuil/index.html.twig');
    }
}
