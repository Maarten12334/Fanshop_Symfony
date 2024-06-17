<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class GiftController extends AbstractController
{

    #[Route('/login/success', name: 'lid_success')]
    public function success(SessionInterface $session): Response
    {
        // Check if the session variable exists and is true
        if ($session->get('existingLid')) {
            // Optionally, clear the session variable if you only want to allow one-time access
            $session->remove('existingLid');

            return $this->render('gift/index.html.twig', ['existingLid' => true]);
        } else {
            return $this->redirectToRoute('login');
        }
    }
}
