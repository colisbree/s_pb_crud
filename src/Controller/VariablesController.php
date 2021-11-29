<?php

namespace App\Controller;

use App\Entity\Variables;
use App\Form\VariablesType;
use App\Repository\VariablesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/variables")
 */
class VariablesController extends AbstractController
{
    /**
     * @Route("/", name="variables_index", methods={"GET"})
     */
    public function index(VariablesRepository $variablesRepository): Response
    {
        return $this->render('variables/index.html.twig', [
            'variables' => $variablesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="variables_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $variable = new Variables();
        $form = $this->createForm(VariablesType::class, $variable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($variable);
            $entityManager->flush();

            return $this->redirectToRoute('variables_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('variables/new.html.twig', [
            'variable' => $variable,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="variables_show", methods={"GET"})
     */
    public function show(Variables $variable): Response
    {
        return $this->render('variables/show.html.twig', [
            'variable' => $variable,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="variables_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Variables $variable, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VariablesType::class, $variable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('variables_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('variables/edit.html.twig', [
            'variable' => $variable,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="variables_delete", methods={"POST"})
     */
    public function delete(Request $request, Variables $variable, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$variable->getId(), $request->request->get('_token'))) {
            $entityManager->remove($variable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('variables_index', [], Response::HTTP_SEE_OTHER);
    }
}
