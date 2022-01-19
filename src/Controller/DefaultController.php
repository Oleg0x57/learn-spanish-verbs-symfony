<?php

namespace App\Controller;

use App\Entity\Verb as VerbEntity;
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
        $verbsList = $entityManager->getRepository(VerbEntity\AbstractTimeForm::class)->findAll();
        dd($verbsList);
        
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    public function tomarModo(Request $request, EntityManagerInterface $entityManager): Response
    {
        $infinitivo = $entityManager->getRepository(VerbEntity\Infinitivo::class)->findOneBy(['title' => 'tomar']);
        
        if (!$infinitivo) {
            $infinitivo = new VerbEntity\Infinitivo();
            $infinitivo->setTitle('tomar');
            $entityManager->persist($infinitivo);
        }

        $modoIndicativo = new VerbEntity\ModoIndicativo();
        $modoIndicativo->setYo('tomo');
        $modoIndicativo->setTu('tomas');
        $modoIndicativo->setEl('toma');
        $modoIndicativo->setElla('toma');
        $modoIndicativo->setUsted('toma');
        $modoIndicativo->setNosotros('tomamos');
        $modoIndicativo->setVosotros('tomais');
        $modoIndicativo->setEllos('toman');
        $modoIndicativo->setInfinitivo($infinitivo);

        $entityManager->persist($modoIndicativo);

        $entityManager->flush();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    public function tomarPreterio(Request $request, EntityManagerInterface $entityManager): Response
    {
        $infinitivo = $entityManager->getRepository(VerbEntity\Infinitivo::class)->findOneBy(['title' => 'tomar']);
        
        if (!$infinitivo) {
            $infinitivo = new VerbEntity\Infinitivo();
            $infinitivo->setTitle('tomar');
            $entityManager->persist($infinitivo);
        }

        $preterioSimple = new VerbEntity\PreterioSimple();
        $preterioSimple->setYo('tome');
        $preterioSimple->setTu('tomaste');
        $preterioSimple->setEl('tomo');
        $preterioSimple->setElla('tomo');
        $preterioSimple->setUsted('tomo');
        $preterioSimple->setNosotros('tomamos');
        $preterioSimple->setVosotros('tomasteis');
        $preterioSimple->setEllos('tomaron');
        $preterioSimple->setInfinitivo($infinitivo);

        $entityManager->persist($preterioSimple);

        $entityManager->flush();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
