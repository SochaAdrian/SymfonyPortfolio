<?php

namespace App\Controller;

use App\Entity\Asynchform;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\UX\Dropzone\Form\DropzoneType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\AsynchtobaseType;

class AjaxformController extends AbstractController
{
    #[Route('/ajaxform', name: 'app_ajaxform')]
    public function index(ManagerRegistry $doctrine, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AsynchtobaseType::class);
        $form->handleRequest($request);

        return $this->render('ajaxinputs/index.html.twig',[
            'form' => $form->createView(),
        ]);
    }
}
