<?php

namespace App\Controller;

use App\Entity\Verb as VerbEntity;
use App\Enum\Verb\TimeTypes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{   
    private const ROUTE_TO_FORM_MAP = [
        'add_modo_indicativo' => TimeTypes::MODO_INDICATIVO,
        'add_preterio_simple' => TimeTypes::PRETERIO_SIMPLE,
        'add_futuro_simple'   => TimeTypes::FUTURO_SIMPLE,
    ];
    
    /**
     * @Route("/", name="list_verbs")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $verbsList = $entityManager->getRepository(VerbEntity\Infinitivo::class)->findAll();
        
        return $this->render('default/index.html.twig', [
            'verbsList' => $verbsList,
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

            $entityManager->persist($infinitivo);
            $entityManager->flush();

            return $this->redirectToRoute('list_verbs');
        }
        
        return $this->render('default/edit_verb.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit-verb-form/{id}", methods="GET|POST", name="edit_verb_form", requirements={"id"="\d+"})
     */
    public function editVerbForm(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        
        if ($id) {
            $verbForm = $entityManager->getRepository(VerbEntity\AbstractTimeForm::class)->find($id);
        } else {
            throw new \RuntimeException('Verb form doesn\'t exists');
        }

        $form = $this->createFormBuilder($verbForm)
            ->add('yo', TextType::class)
            ->add('tu', TextType::class)
            ->add('el', TextType::class)
            ->add('ella', TextType::class)
            ->add('usted', TextType::class)
            ->add('nosotros', TextType::class)
            ->add('vosotros', TextType::class)
            ->add('ellos', TextType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $entityManager->flush();

            return $this->redirectToRoute('list_verbs');
        }
        
        return $this->render('default/edit_verb_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/add-modo-indicativo/{id}", methods="GET|POST", name="add_modo_indicativo", requirements={"id"="\d+"})
     * @Route("/add-preterio-simple/{id}", methods="GET|POST", name="add_preterio_simple", requirements={"id"="\d+"})
     * @Route("/add-futuro-simple/{id}",   methods="GET|POST", name="add_futuro_simple", requirements={"id"="\d+"})
     */
    public function addNewTimeForm(Request $request, EntityManagerInterface $entityManager, int $id = null): Response
    {
        $meta = $entityManager->getMetadataFactory()->getMetadataFor(VerbEntity\AbstractTimeForm::class);
        $discriminatorMap = $meta->discriminatorMap;
        $verbClassName = $discriminatorMap[self::ROUTE_TO_FORM_MAP[$request->attributes->get('_route')]];
        
        if ($id) {
            $infinitivo = $entityManager->getRepository(VerbEntity\Infinitivo::class)->find($id);
        } else {
            throw new \RuntimeException('Verb doesn\'t exists');
        }

        $verbForm = new $verbClassName();

        $form = $this->createFormBuilder($verbForm)
            ->add('yo', TextType::class)
            ->add('tu', TextType::class)
            ->add('el', TextType::class)
            ->add('ella', TextType::class)
            ->add('usted', TextType::class)
            ->add('nosotros', TextType::class)
            ->add('vosotros', TextType::class)
            ->add('ellos', TextType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $verbForm->setInfinitivo($infinitivo);

            $entityManager->persist($verbForm);
            $entityManager->flush();

            return $this->redirectToRoute('list_verbs');
        }
        
        return $this->render('default/edit_verb_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
