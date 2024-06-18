<?php

namespace App\Controller;

use App\Entity\Lid;
use App\Form\LidType;
use App\Repository\LidRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function new(Request $request, LidRepository $lidRepository, SessionInterface $session): Response
    {
        $lid = new Lid();
        $form = $this->createForm(LidType::class, $lid);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Check if geboortedatum and lidnummer match in the database
            $existingLid = $lidRepository->findOneBy([
                'lidnummer' => $lid->getLidnummer(),
                'geboortedatum' => $lid->getGeboortedatum(),
            ]);

            if ($existingLid) {
                $session->set('existingLid', true);
                // Perform any additional actions if needed, e.g., login or redirect
                return $this->redirectToRoute('lid_success');
            } else {
                $this->addFlash('error', 'Lidnummer of geboortedatum is onjuist');
                return $this->redirectToRoute('login');
            }
        }

        return $this->render('form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
