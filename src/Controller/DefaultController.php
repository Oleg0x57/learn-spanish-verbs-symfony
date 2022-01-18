<?php

namespace App\Controller;

use App\Entity\Verb;
use App\Repository\VerbRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{   
    /**
     * @Route("/default", name="default")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $verbsList = $entityManager->getRepository(Verb::class)->findAll();
        dd($verbsList);
        
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/verb-add", name="verb_add")
     */
    public function verbAdd(Request $request, EntityManagerInterface $entityManager): Response
    {
        $verb = new Verb();
        $verb->setInfinitivo('tomar');
        $verb->setModoIndicativo('tomo');
        $verb->setPreteritoSimple('tome');

        $entityManager->persist($verb);
        $entityManager->flush();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
