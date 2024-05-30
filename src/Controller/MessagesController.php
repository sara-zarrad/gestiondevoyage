<?php
namespace App\Controller;
use App\Entity\Messages;
use App\Form\MessagesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[IsGranted('ROLE_USER')]
class MessagesController extends AbstractController
{
    #[Route('/messages/new', name: 'messages_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $message = new Messages();
        $form = $this->createForm(MessagesType::class, $message);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $message->setUser($user);

            $entityManager->persist($message);
            $entityManager->flush();

            return $this->redirectToRoute('app_success');
        }

        return $this->render('messages/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/success', name: 'app_success')]
    public function success(): Response
    {
        return $this->render('messages/success.html.twig');
        
    }
}
