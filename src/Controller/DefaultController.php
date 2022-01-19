<?php

namespace App\Controller;

use App\Entity\Verb as VerbEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{   
    /**
     * @Route("/", name="verbs_list")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $verbsList = $entityManager->getRepository(VerbEntity\Infinitivo::class)->findAll();
        
        return $this->render('default/index.html.twig', [
            'verbsList' => $verbsList,
        ]);
    }

    /**
     * @Route("/add-tomar-modo", name="add_tomar_modo")
     */
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

    /**
     * @Route("/add-tomar-preterio", name="add_tomar_preterio")
     */
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

    /**
     * @Route("/edit-verb/{id}", methods="GET|POST", name="edit_verb", requirements={"id"="\d+"})
     * @Route("/add-verb", methods="GET|POST", name="add_verb")
     */
    public function editVerb(Request $request, EntityManagerInterface $entityManager, int $id = null): Response
    {
        if ($id) {
            $infinitivo = $entityManager->getRepository(VerbEntity\Infinitivo::class)->find($id);
        } else {
            $infinitivo = new VerbEntity\Infinitivo();
        }

        $form = $this->createFormBuilder($infinitivo)->add('title', TextType::class)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $entityManager->flush();

            $this->redirectToRoute('edit_verb', ['id' => $infinitivo->getId()]);
        }
        
        return $this->render('default/edit_verb.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
