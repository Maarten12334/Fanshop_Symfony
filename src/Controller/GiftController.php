<?php

namespace App\Controller;

use App\Form\gift\GiftType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class GiftController extends AbstractController
{

    #[Route('/login/success', name: 'lid_success')]
    public function success(SessionInterface $session, Request $request): Response
    {
        // Check if the session variable exists and is true
        if (!$session->get('existingLid')) {
            return $this->redirectToRoute('login');
        }

        $form = $this->createForm(GiftType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // Handle form submission
            $data = $form->getData();

            return $this->redirectToRoute('thanks');
        }

        return $this->render('gift/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
