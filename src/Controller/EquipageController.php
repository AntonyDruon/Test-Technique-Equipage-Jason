<?php

namespace App\Controller;

use App\Entity\Equipagejason;
use App\Form\EquipageformType;
use App\Repository\EquipagejasonRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipageController extends AbstractController
{
    #[Route('/equipage', name: 'app_equipage')]
    public function index(Request $request, EntityManagerInterface $manager,EquipagejasonRepository $repo): Response
    {
        $equipage = new Equipagejason;
        $form = $this->createForm(EquipageformType::class, $equipage);
            $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            
            $manager->persist($equipage);
            $manager->flush();
        }

        $equipages = $repo->findAll();

        return $this->render('equipage/index.html.twig', [
            'formEquipage' => $form->createView(),
            'equipages' => $equipages
        ]);
    }
}
