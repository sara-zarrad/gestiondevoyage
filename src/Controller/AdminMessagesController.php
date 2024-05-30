<?php

namespace App\Controller;

use App\Entity\Messages;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[IsGranted('ROLE_ADMIN')]

class AdminMessagesController extends AbstractController
{
    #[Route('/admin/messages', name: 'app_admin_messages')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $messages = $entityManager->getRepository(Messages::class)->findAll();

        return $this->render('admin_messages/index.html.twig', [
            'messages' => $messages,
        ]);
    }

    #[Route('/admin/messages/delete/{id}', name: 'app_admin_message_delete')]
    public function delete(
        Request $request,
        EntityManagerInterface $entityManager,
        int $id
    ): Response {
        $message = $entityManager->getRepository(Messages::class)->find($id);

        if (!$message) {
            throw $this->createNotFoundException('Message not found');
        }

        // Vérifiez que le token CSRF est valide
        if (
            $this->isCsrfTokenValid(
                'delete' . $message->getId(),
                $request->request->get('_token')
            )
        ) {
            // Supprimez le message
            $entityManager->remove($message);
            $entityManager->flush();

            // Redirigez avec un message flash
            $this->addFlash('success', 'Message deleted successfully.');
        }

        // Redirigez vers la page d'index
        return $this->redirectToRoute('app_admin_messages');
    }
}
