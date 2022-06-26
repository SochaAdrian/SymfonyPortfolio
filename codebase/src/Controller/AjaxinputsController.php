<?php

namespace App\Controller;

use App\Entity\Asynchform;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class AjaxinputsController extends AbstractController
{
    #[Route('/ajaxinputs', name: 'app_ajaxinputs')]
    public function ajax(Request $request, ManagerRegistry $doctrine, LoggerInterface $logger, SluggerInterface $slugger, EntityManagerInterface $entityManager): Response {

        if($request->isMethod('POST')) {
            $input = new Asynchform();
            $input->setName($_POST['asynchtobase']['Name']);
            $input->setSurname($_POST['asynchtobase']['Surname']);
            try {
                /** @var UploadedFile $file */
                $file = $request->files->get('asynchtobase')['image'];
                if($file->guessExtension() !== 'jpeg' && $file->guessExtension() !== 'png') {
                    die('Invalid file type');
                }
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = $slugger->slug($originalFilename);
                $newFilename = $fileName.'.'.$file->guessExtension();
                $file->move(
                    'uploads/task_meta',
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
                die($e->getMessage());
            }

            $input->setImage($newFilename);
            $entityManager->persist($input);
            $entityManager->flush();
        }

        return new Response('Ok');
    }

}
