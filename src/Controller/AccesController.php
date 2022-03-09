<?php

namespace App\Controller;

use App\Entity\Acces;
use App\Form\AccesType;
use App\Repository\AccesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/acces')]
class AccesController extends AbstractController
{
    #[Route('/', name: 'acces_index', methods: ['GET'])]
    public function index(AccesRepository $accesRepository): Response
    {
        return $this->render('acces/index.html.twig', [
            'acces' => $accesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'acces_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $acce = new Acces();
        $form = $this->createForm(AccesType::class, $acce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($acce);
            $entityManager->flush();

            return $this->redirectToRoute('acces_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('acces/new.html.twig', [
            'acce' => $acce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'acces_show', methods: ['GET'])]
    public function show(Acces $acce): Response
    {
        return $this->render('acces/show.html.twig', [
            'acce' => $acce,
        ]);
    }

    #[Route('/{id}/edit', name: 'acces_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Acces $acce, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AccesType::class, $acce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('acces_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('acces/edit.html.twig', [
            'acce' => $acce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'acces_delete', methods: ['POST'])]
    public function delete(Request $request, Acces $acce, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$acce->getId(), $request->request->get('_token'))) {
            $entityManager->remove($acce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('acces_index', [], Response::HTTP_SEE_OTHER);
    }
}
