<?php

namespace App\Controller;

use App\Entity\Verb;
use App\Form\VerbType;
use App\Repository\VerbRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/verb")
 */
class VerbController extends AbstractController
{
    /**
     * @Route("/", name="verb_index", methods={"GET"})
     */
    public function index(VerbRepository $verbRepository): Response
    {
        return $this->render('verb/index.html.twig', [
            'verbs' => $verbRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="verb_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $verb = new Verb();
        $form = $this->createForm(VerbType::class, $verb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($verb);
            $entityManager->flush();

            return $this->redirectToRoute('verb_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('verb/new.html.twig', [
            'verb' => $verb,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="verb_show", methods={"GET"})
     */
    public function show(Verb $verb): Response
    {
        return $this->render('verb/show.html.twig', [
            'verb' => $verb,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="verb_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Verb $verb, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VerbType::class, $verb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('verb_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('verb/edit.html.twig', [
            'verb' => $verb,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="verb_delete", methods={"POST"})
     */
    public function delete(Request $request, Verb $verb, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$verb->getId(), $request->request->get('_token'))) {
            $entityManager->remove($verb);
            $entityManager->flush();
        }

        return $this->redirectToRoute('verb_index', [], Response::HTTP_SEE_OTHER);
    }
}
