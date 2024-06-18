<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ThanksController extends AbstractController
{
    #[Route('/thanks', name: 'thanks')]
    public function index(SessionInterface $session): Response
    {
        //check if user is logged in
        if (!$session->get('existingLid')) {
            return $this->redirectToRoute('login');
        }

        // Allow one-time access
        $session->remove('existingLid');

        return $this->render('thanks/index.html.twig', [
            'controller_name' => 'ThanksController',
        ]);
    }
}
