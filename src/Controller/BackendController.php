<?php

namespace App\Controller;

use App\Repository\ParticipationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/backend')]
class BackendController extends AbstractController
{
	
	#[Route('/', name: 'app_backend')]
    public function index(ParticipationRepository $participationRepository): Response
    {
        return $this->render('backend/index.html.twig', [
            'participations' => $participationRepository->findAll(),
	        'nombrePlaces' => $participationRepository->getNombrePlaces(),
	        'montantTotal' => $participationRepository->getMontantTotal()
        ]);
    }
}
