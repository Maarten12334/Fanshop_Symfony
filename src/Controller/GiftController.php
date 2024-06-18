<?php

namespace App\Controller;

use App\Entity\Lid;
use App\Form\gift\GiftType;
use App\Repository\LidRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class GiftController extends AbstractController
{

    #[Route('/login/success', name: 'login_success')]
    public function success(SessionInterface $session, Request $request, EntityManagerInterface $entityManager): Response
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
            $lidId = $session->get('lidId');
            $lid = $entityManager->getRepository(Lid::class)->find($lidId);
            if ($lid) {
                $lid->setKeuze($data['choice']);
                $entityManager->persist($lid);
                $entityManager->flush();
            }

            return $this->redirectToRoute('thanks');
        }

        return $this->render('gift/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
