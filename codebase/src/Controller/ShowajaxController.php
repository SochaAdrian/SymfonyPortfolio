<?php

namespace App\Controller;

use App\Entity\Asynchform;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowajaxController extends AbstractController
{
    #[Route('/showajax', name: 'app_showajax')]
    public function index(ManagerRegistry $doctrine): Response
    {
        if($this->isGranted('IS_AUTHENTICATED_FULLY')){
            $entityManager = $doctrine->getManager();
            $objects = $entityManager->getRepository(Asynchform::class)->findAll();
            return $this->render('showajax/index.html.twig', [
                'objects' => $objects,
            ]);
        } else {
            return $this->redirectToRoute('app_login');
        }

    }
}
