<?php

namespace App\Controller;

use App\Entity\Lid;
use App\Form\login\LidType;
use App\Repository\LidRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class LoginController extends AbstractController
{
    #[Route('/{path}', name: 'login', requirements: ['path' => '.*'], defaults: ['path' => null])]
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

            if (!$existingLid) {
                $this->addFlash('error', 'Lidnummer of geboortedatum is onjuist');
                return $this->redirectToRoute('login');
            } else {
                $session->set('existingLid', true);
                $session->set('lidId', $existingLid->getId());
                $keuze = $existingLid->getKeuze();
                if ($keuze) {
                    $this->addFlash('error', 'U hebt al een geschenk geselecteerd');
                    return $this->redirectToRoute('login');
                }
                return $this->redirectToRoute('login_success');
            }
        }


        return $this->render('login/login.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
