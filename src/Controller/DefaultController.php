<?php

namespace App\Controller;

use App\Entity\Verb as VerbEntity;
use App\Entity\Verb\VerbManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    // TODO: + 1) make migration ADD COLUMN is_irregular BOOLEAN DEFAULT FALSE;
    // TODO: + 2) add this field to form of infinitivo
    // TODO: + 3) make Factories for -ar, -er -ir regular verbs for 3 forms
    // TODO: + 4) make VerbManager with generateFormsFromInfinitivo and regenerateFormsFromInfinitivo and deeleteAllForms
    // TODO: 5) disable buttons to add form if already exists
    // TODO: 6) add unique index (infinitivo_id, type) on table of verbs form

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
     * @Route("/add-verb", methods="GET|POST", name="add_verb")
     */
    public function addVerb(Request $request, EntityManagerInterface $entityManager): Response
    {
        $infinitivo = new VerbEntity\Infinitivo();

        $form = $this->createFormBuilder($infinitivo)
            ->add('title', TextType::class)
            ->add('isRegular', CheckboxType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = new VerbManager($entityManager);
            $manager->createVerb($infinitivo);

            return $this->redirectToRoute('list_verbs');
        }

        return $this->render('default/edit_verb.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit-verb/{id}", methods="GET|POST", name="edit_verb", requirements={"id"="\d+"})
     */
    public function editVerb(Request $request, EntityManagerInterface $entityManager, int $id = null): Response
    {
        if ($id) {
            $infinitivo = $entityManager->getRepository(VerbEntity\Infinitivo::class)->find($id);
        } else {
            throw new \RuntimeException('Verb doesn\'t exists');
        }

        $form = $this->createFormBuilder($infinitivo)
            ->add('title', TextType::class)
            ->add('isRegular', CheckboxType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('list_verbs');
        }

        return $this->render('default/edit_verb.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete-verb/{id}", methods="GET|POST", name="delete_verb", requirements={"id"="\d+"})
     */
    public function deleteVerb(Request $request, EntityManagerInterface $entityManager, int $id = null): Response
    {
        if ($id) {
            $infinitivo = $entityManager->getRepository(VerbEntity\Infinitivo::class)->find($id);
        } else {
            throw new \RuntimeException('Verb doesn\'t exists');
        }

        $manager = new VerbManager($entityManager);
        $manager->deleteVerb($infinitivo);

        return $this->redirectToRoute('list_verbs');
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
     * @Route("/add-futuro-simple/{id}",   methods="GET|POST", name="add_futuro_simple",   requirements={"id"="\d+"})
     * @Route("/add-futuro-proximo/{id}",  methods="GET|POST", name="add_futuro_proximo",  requirements={"id"="\d+"})
     */
    public function addNewTimeForm(Request $request, EntityManagerInterface $entityManager, int $id = null): Response
    {
        if ($id) {
            $infinitivo = $entityManager->getRepository(VerbEntity\Infinitivo::class)->find($id);
        } else {
            throw new \RuntimeException('Verb doesn\'t exists');
        }

        $verbForm = (new VerbEntity\VerbFactory($entityManager))->createFromRequest($request);

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
